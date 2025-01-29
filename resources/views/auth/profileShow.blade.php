@extends(@env('TEMPLATE_NAME') . '.App')
@section('twitter:title'){{ $company->name ?? 'comapny' }}@endsection
@section('twitter:description'){{ clearHtml($company->description) }}@endsection
@section('og:type'){{ 'Comapny' }}@endsection
@section('og:title'){{ $company->name ?? 'Company' }}@endsection
@section('og:description'){{ clearHtml($company->description) }}@endsection
@if (isset($company->logo['medium']))
    @section('twitter:image'){{ url($company->logo['medium']) }}@endsection
    @section('og:image'){{ url($company->logo['medium']) }}@endsection
    @section('og:image:type'){{ 'image/jpeg' }}@endsection
    @section('og:image:width'){{ env('COMPANY_MEDIUM_W') }}@endsection
    @section('og:image:height'){{ env('COMPANY_MEDIUM_H') }}@endsection
    @section('og:image:alt'){{ $company->name ?? 'Company' }}@endsection
@endif

@section('Content')
@auth
    @if (Auth::user()->id == 1)
        <div class="btn btn-info edit-button" onclick="window.open('{{ url('/admin/company/edit/' . $company->id) }}')">
            ویرایش</div>
    @endif
@endauth

<section class="breadcrumb my-0" style="padding:10px">
    <div class="flex one  ">
        <div class="p-0">
            <a href="/">خانه </a>
            @if (count($breadcrumb))
                @foreach ($breadcrumb as $key => $item)
                    <span>></span>
                    <a href="{{ url($item['slug']) }}">{{ $item['title'] }}</a>
                @endforeach
                <span>></span> <a href="">{{ $company->name }}</a>
            @endif
        </div>
    </div>
</section>
<section class="profile-show">
    <div class="flex ">
        <h1 class="full">{{ $company->name ?? '' }}</h1>
        <div class="sm:grid sm:grid-cols-12 sm:gap-4 ">
            <div class=" flex gap-4 content-start mb-4  justify-center text-center col-span-12 sm:col-span-3">
                <img class=" shadow rounded-lg "
                    src="{{ image_or_placeholder($company->logo['large'] ?? '', 'company') }}">
                @if ($company->location)
                    <div class="shadow rounded-lg map-area   overflow-hidden"
                        style="display: block; width: 100%;z-index:1">
                        <div id="mapid" style="width: 100%; height: 200px;"></div>
                    </div>
                @endif
            </div>
            <div class="shadow rounded-lg sm:col-span-9 [&>div]:mt-4">

                <div class="">
                    <span class="bold">نام مدیر:</span>
                    <span class="text-editor infobox-data agent" data-field="manager"
                        data-label="@lang('messages.name')">{{ $company->manager ?? '-' }}</span>
                </div>
                @if ($company->sale_manager != '')
                    <div class="">@lang('messages.sale manager'):
                        <span class="text-editor" data-field="sale_manager"
                            data-label="@lang('messages.sale manager')">{{ $company->sale_manager ?? '' }}</span>
                    </div>
                @endif


                @if ($company->phone != '')
                    <div class="bold">
                        @lang('messages.phone'):

                        @foreach (explode(',', $company->phone) as $phone)
                            <a class="company-phone" href="tel:{{ Str::replace('-', '', $phone) }}">
                                {{ Str::replace('-', '', $phone) }}</a>
                        @endforeach

                    </div>
                @endif
                <div class="bold">@lang('messages.site'):
                    <span class="text-editor" data-field="site" data-label="@lang('messages.site')">
                        @if ($company->site)
                            <a href="{{ $company->site }}" rel="nofollow"
                                target="_blank">{{ str_replace(['http://', 'https://'], '', $company->site ?? '') }}</a>
                        @else
                            -
                        @endif

                    </span>
                </div>


                <div class="bold">@lang('messages.email'): <span class="text-editor" data-field="email"
                        data-label="@lang('messages.email')">{{ $company->email ?? '-' }}</span>
                </div>


                <div class="bold">@lang('messages.city'): <span class="text-editor" data-field="city"
                        data-label="@lang('messages.city')">{{ $company->city ?? '-' }}</span>
                </div>

                <div class="">
                    <span class="bold">
                        @lang('messages.address'):
                    </span>
                    <span class="text-editor" data-field="address"
                        data-label="@lang('messages.address')">{{ $company->city ?? '' }}
                        {{ $company->address ?? '' }}</span>
                </div>

                <div class="">
                    <span class="bold">@lang('messages.category'):</span>
                    @foreach ($company->categories as $item)
                        <a class="border whitespace-nowrap px-2 rounded-md"
                            href="{{ url($item->slug) }}">{{ $item->title }}</a>
                    @endforeach
                </div>

                <div><span class="bold">@lang('messages.whatsapp'):</span>
                    {{ $company->whatsapp ?? '-' }}
                </div>

                <div class=""><span class="bold">@lang('messages.telegram'): </span>
                    <a href="{{ $company->telegram }}" rel="nofollow" target="_blank">
                        {{ str_replace(['https://telegram.me/'], '', $company->telegram ?? '-') }}

                    </a>
                </div>

                <div class="">
                    <span class="bold"> @lang('messages.instagram'):</span>
                    @if ($company->instagram)
                        <br>
                        <a href="https://www.instagram.com/{{ $company->instagram ?? '' }}" rel="nofollow" target="_blank">
                            مشاهده در وب
                        </a>

                        <br>
                        <a href="instagram://user?username={{ $company->instagram ?? '' }}" rel="nofollow" target="_blank">

                            مشاهده در اپلیکیشن
                        </a>
                    @else
                        -
                    @endif
                </div>

                <div class="">@lang('messages.register date'):
                    <span>{{ convertGToJ($company->created_at ?? '') }}</span>
                </div>


            </div>
        </div>

        @if ($company->description != '')
            <div class="shadow rounded-lg mt-5 w-full">
                <div class="bold">
                    @lang('messages.description')
                </div>
                <span class="text-editor" data-field="description"
                    data-label="@lang('messages.description')">{!! $company->description ?? '' !!}</span>
            </div>
        @endif

    </div>
</section>

{{-- all contents --}}
@if (isset($company->contents))


    <section class="index-items home-top-view">
        <div class="flex one">
            <div>
                <div class="flex two two-500  six-800  ">
                    @foreach ($company->contents()->paginate(12) as $content)
                            <div>
                                <a class="hover shadow2" href="{{ url($content->slug) }}">

                                    @if (isset($content->images['images']['small']))
                                        <div><img alt="{{ $content->title }}" src="{{ $content->images['images']['small'] }}">
                                        </div>
                                    @endif
                                    <footer>
                                        <h3> {{ $content->title }}</h3>
                                        <div>
                                            <div class="rate">
                                                @if (count($content->comments))
                                                                            @php
                                                                                $rateAvrage = $rateSum = 0;
                                                                            @endphp
                                                                            @foreach ($content->comments as $comment)
                                                                                                    @php
                                                                                                        $rateSum = $rateSum + $comment['rate'];
                                                                                                    @endphp
                                                                            @endforeach
                                                                            @for ($i = $rateSum / count($content->comments); $i >= 1; $i--)
                                                                                <img width="20" height="20"
                                                                                    srcset="{{ url(env('TEMPLATE_NAME') . '/img/star2x.png') }} 2x , {{ url(env('TEMPLATE_NAME') . '/img/star1x.png') }} 1x"
                                                                                    src="{{ url(env('TEMPLATE_NAME') . '/img/star1x.png') }}"
                                                                                    alt="{{ 'star for rating' }}">
                                                                            @endfor
                                                @endif
                                            </div>
                                            @if (isset($content->attr['price']))
                                                @convertCurrency($content->attr['price'] ?? 0) تومان
                                            @endif
                                        </div>
                                    </footer>
                                </a>
                            </div>
                    @endforeach

                </div>
                {{ $company->contents()->paginate(12)->links() }}
            </div>
        </div>
    </section>
@endif



<section class="comments bg-gray mt-0 mb-0">
    <div class="flex one">
        <div>

            @include('corepo.Comment')

        </div>
    </div>
</section>

@endsection


@section('footer')
@if ($company->location)

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="anonymous" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <script>
        var map = L.map('mapid')
            .setView([{{ $company->location ?? '31.5,51.2' }}], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://tarhoweb.com">Tarhoweb</a> contributors',
            // zoomOffset: -1
            // maxZoom: 18,
            // tileSize: 512
        }).addTo(map);


        //marker
        var marker = L.marker([{{ $company->location ?? '31.5,51.2' }}])
            .addTo(map)
            .bindPopup(`{{ $company->name }}`)
            .openPopup();



        //meghyas
        L.control.scale().addTo(map);

        //scroll disable zoom
        map.scrollWheelZoom.disable();
    </script>
@endif


@endsection

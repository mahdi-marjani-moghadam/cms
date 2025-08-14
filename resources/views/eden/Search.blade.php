@extends(@env('TEMPLATE_NAME') . '.App')



@section('meta-title', $detail->title)
@section('meta_description', $detail->title)

@section('twitter:title', $detail->title)
@section('twitter:description', clearHtml($detail->description))

@section('og:title', $detail->title)
@section('og:description', clearHtml($detail->description))
@section('canonical', url($detail->slug))


@if (isset($detail->images['images']['medium']))
@section('twitter:image', url($detail->images['images']['medium']))

@section('og:image', url($detail->images['images']['medium']))
@section('og:image:type', 'image/jpeg')
@section('og:image:width', $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W'))
@section('og:image:height', $detail->attr_type == 'article' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H'))
@section('og:image:alt', $detail->title)
@endif



@section('Content')

    @include('jsonLdWebsite')





    @if (count($breadcrumb))
        <section class="breadcrumb my-0 py-0">
            <div class="flex one  ">
                <div class="p-0">
                    <a href="/">خانه </a>
                    @foreach ($breadcrumb as $key => $item)
                        <span>></span>
                        <a title="{{ $item['title'] }}" href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    <section class=" ">
        <div class="flex one two-500 three-800 center">

            <form action="{{ route('search') }}" class=" ">

                <div class="w-full flex gap-1 items-center">
                    موجود
                    <input type="checkbox" class="p-0 m-0 h-5 w-5"  name="in_stock"  {{ app('request')->in_stock == 'on'? 'checked':'' }}>
                </div>

                <div class="flex center items-center">


                    <input name="q" class="px-4 m-1 h-11" alt="جستجو" type="text" value="{{ app('request')->q }}"
                        placeholder="جستجوی محصول / محتوا / کمپانی" required>


                    <button class="bg-gray-700  !rounded-r-none !m-0 text-white h-full"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            width="24" height="24" viewBox="0 0 32 32" style=" fill:#fff;">
                            <path
                                d="M 19 3 C 13.488281 3 9 7.488281 9 13 C 9 15.394531 9.839844 17.589844 11.25 19.3125 L 3.28125 27.28125 L 4.71875 28.71875 L 12.6875 20.75 C 14.410156 22.160156 16.605469 23 19 23 C 24.511719 23 29 18.511719 29 13 C 29 7.488281 24.511719 3 19 3 Z M 19 5 C 23.429688 5 27 8.570313 27 13 C 27 17.429688 23.429688 21 19 21 C 14.570313 21 11 17.429688 11 13 C 11 8.570313 14.570313 5 19 5 Z">
                            </path>
                        </svg></button>
                </div>
            </form>
        </div>
    </section>

    <section class="bg-gray search-items mb-0">
        <div class="flex one ">
            <h2>محصولات</h2>
            <div>
                @if (count($products))
                    <div class="grid grid-cols-2 gap-2 md:grid-cols-5  ">

                        {{-- $data['newPost'] --}}
                        @foreach ($products as $content)
                            <a href="{{ $content->slug }}" class="">
                                <div class="shadow hover p-0 border-radius-5">

                                    <img src="{{ image_or_placeholder($content->images['images']['large'] ?? '') }}"
                                        alt="{{ $content->title }}" title="{{ $content->title }}" class="w-full" width="150">

                                    <div class="py-0 px-1 m-0 ">
                                        <div>{{ $content->title }}</div>
                                        <div class=" text-green font-09 ">
                                            @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 1)
                                                @isset($content->attr['weight'])
                                                    @convertCurrency($content->GoldPrice()['totalPrice']) تومان
                                                @endisset
                                            @endif
                                        </div>
                                        <div>
                                            <span class="">بازدید: {{ $content->viewCount }}</span>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-5">
                        {{ $products->appends(Request::except('page'))->links('vendor.pagination.default') }}
                    </div>
                @else
                    موردی یافت نشد.
                @endif
            </div>
        </div>
    </section>



@endsection

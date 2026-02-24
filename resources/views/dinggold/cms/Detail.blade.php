@extends(@env('TEMPLATE_NAME') . '.App')

@section('twitter:title', $detail->title)
@section('twitter:description', clearHtml($detail->brief_description))

@section('og:title', $detail->title)
@section('og:description', clearHtml($detail->brief_description))
@section('canonical', url($detail->slug))

@if (isset($detail->images['images']['medium']))
@section('twitter:image', url($detail->images['images']['medium']))

@section('og:image', url($detail->images['images']['medium']))
@section('og:image:type', 'image/jpeg')
@section('og:image:width', $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W'))
@section('og:image:height', $detail->attr_type == 'article' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H'))
@section('og:image:alt', $detail->title)
@endif


@push('head')
@endpush
@push('scripts')
    <script type="text/javascript">
        function zoom(e) {
            var zoomer = e.currentTarget;
            e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
            e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
            x = offsetX / zoomer.offsetWidth * 100
            y = offsetY / zoomer.offsetHeight * 100
            zoomer.style.backgroundPosition = x + '% ' + y + '%';
        }

        function clickOnGallery(imgs) {
            var Img = document.getElementById("main-image");
            var figure = document.getElementById("figure-main-image");

            Img.src = imgs.dataset.large;
            Img.parentElement.style.display = "block";
            figure.style = 'background-image: url(' + imgs.dataset.xlarge + ')';
            $('#main-image').data('xlarge', imgs.dataset.xlarge);
        }
    </script>

    <script>
        $(window).ready(function (e) {

            var zoomer = e.currentTarget;


            // $('.zoom').css({
            //     position: 'absolute',
            //     top: '1em',
            //     left: '1em',
            //     'background-color': 'white',
            // })

            // $('.zoom').click(function () {

            //     xlarge = $('#main-image').data('xlarge')
            //     $('#main-image').attr('src', xlarge)
            //     $('#main-image').toggleClass('zoom2x')

            //     // $(this).toggleClass('fa-magnifying-glass-plus')
            //     // $(this).toggleClass('fa-magnifying-glass-minus')
            // })


        });
    </script>
    <style>
        figure.zoom2 {
            background-position: 50% 50%;
            position: relative;
            /* width: 400px; */
            overflow: hidden;
            cursor: zoom-in;
        }

        figure.zoom2 img:hover {
            opacity: 0;
        }

        figure.zoom2 img {
            transition: opacity .5s;
            display: block;
            width: 100%;
        }
    </style>
@endpush

@section('footer')
    @auth
        @if (Auth::user()->id == 1)
            <div class="btn btn-info edit-button" onclick="window.open('{{ url('/admin/contents/' . $detail->id . '/edit/') }}')">
                ویرایش</div>
        @endif
    @endauth
@endsection

@section('Content')

    @php
        $tableOfImages = tableOfImages($detail->description);
        $append = '';
    @endphp

    @if ($detail->attr_type == 'product')
        @php
            $price = $detail->GoldPrice();
        @endphp
        @include('jsonLdProduct')
    @endif
    @include('jsonLdFaq')

    @if ($detail->attr_type == 'article')
        @include('jsonLdArticle')
    @endif

    @if (count($breadcrumb) > 0)
        @include('jsonLdBreadcrumb')
    @endif

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

    <section class="product-detail mt-0 pt-0" id="">
        <div class="flex one ">
            <div class="bg-white border-radius-5">
                <div class="top-page">

                    <div>
                        <div class="flex  ">




                            <div id="product-image" class=" w-full sm:w-1/2 lg:w-1/3  p-5  relative">
                                @if (isset($detail->images['images']['large']))

                                    <div class="">
                                        <figure class="image zoom2 rounded" id="figure-main-image" onmousemove="zoom(event)"
                                            style="background-image: url({{ $detail->images['images']['xlarge'] ?? $detail->images['images']['large'] }})">
                                            {{-- @if (isset($detail->attr['in-stock']) && $detail->attr['in-stock'] == 0)
                                            <div class="not-in-stock">قابل سفارش</div>
                                            @endif --}}
                                            <div class="overflow-hidden">
                                                <img id="main-image" loading="lazy" class="zoom-img touch-pan-y select-none transition-transform duration-150 ease-out"
                                                    src="{{ image_or_placeholder($detail->images['images']['xlarge'] ?? $detail->images['images']['large']) }}"
                                                    alt="{{ $detail->title }}"
                                                    width="{{ env(Str::upper($detail->attr_type) . '_LARGE_W') }}"
                                                    height="{{ env(Str::upper($detail->attr_type) . '_LARGE_H') }}">
                                            </div>

                                        </figure>
                                    </div>

                                    @if ($detail->gallery->count())
                                        <div class="gallery">
                                            <img onclick="clickOnGallery(this);" class="m-1 max-h-24"
                                                data-large="{{ $detail->images['images']['large'] }}"
                                                data-xlarge="{{ $detail->images['images']['xlarge'] ?? $detail->images['images']['large'] }}"
                                                src="{{ image_or_placeholder($detail->images['images']['small']) }}" height="100">
                                            @foreach ($detail->gallery as $item)
                                                <img onclick="clickOnGallery(this);" class="m-1 max-h-24"
                                                    data-large="{{  $item->images['images']['large'] }}"
                                                    data-xlarge="{{ $item->images['images']['xlarge'] ?? $item->images['images']['large'] }}"
                                                    src="{{ image_or_placeholder($item->images['images']['small']) }}" height="100">
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    <picture>
                                        <img class="m-auto p-4" width="" height=""
                                            src="https://img.icons8.com/ios/100/cccccc/no-image.png" alt="company-no-image" />
                                    </picture>
                                @endif
                            </div>




                            <div class="  !w-full sm:!w-1/2 lg:!w-1/3 p-0 flex">
                                <div>
                                    <h1 id="product-name font-bold" class="">{{ $detail->title }}</h1>
                                    <span id="product-rate" class="rate  mt-1">
                                        @if (count($detail->comments))
                                            @php
                                                $rateAvrage = $rateSum = 0;
                                            @endphp
                                            @foreach ($detail->comments as $comment)
                                                @php
                                                    $rateSum = $rateSum + $comment['rate'];
                                                @endphp
                                            @endforeach
                                            @for ($i = $rateSum / count($detail->comments); $i >= 1; $i--)
                                                <label></label>
                                            @endfor
                                            <span class="font-07">({{ count($detail->comments) }} نفر) </span>
                                        @endif
                                    </span>
                                    <div id="product-categories" class=" my-1 font-09">
                                        دسته بندی :
                                        @foreach ($detail->categories as $key => $item)
                                            {{-- <a href="{{ $item['slug'] }}"> {{ $item['title'] }} </a> --}}
                                            @if ($loop->last)
                                                <a href="{{ $item['slug'] }}"> {{ $item['title'] }} </a>
                                                {{-- <span> | </span> --}}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div><i class="fa-solid fa-square-check text-green font-13 pl-1"></i> ضمانت طلای ۱۸ عیار
                                    </div>
                                    <div><i class="fa-solid fa-certificate font-13 pl-1 text-gold"></i> تضمین به روز بودن
                                        قیمت
                                        طلا</div>
                                    <div><i class="fa-solid fa-gift text-blue  font-13 pl-1"></i> فاکتور + پکیج هدیه</div>

                                    @if (isset($detail->attr['in-stock']) && $detail->attr['in-stock'] == 0)
                                        <div class="bg-red-600 text-white p-1 rounded-md border-red-600 border mt-1">
                                            ناموجود:
                                            ساخت و ارسال ۱۰ روز کاری</div>
                                    @endif


                                    <div>
                                        {!! $detail->brief_description !!}
                                    </div>
                                </div>
                                <section class="col-span-4 w-full mb-0 inline-block">
                                    <div class="grid gap-x-4 gap-y-4 grid-cols-3 lg:grid-cols-3  mb-0">
                                        <article class="col-span-1">
                                            <div
                                                class="p-1 lg:p-3 hover:drop-shadow-sm hover:-translate-y-2   transition duration-300 border border-gray-200 flex bg-white shadow rounded-lg flex-col items-center justify-center">
                                                <div
                                                    class="size-10 flex items-center justify-center rounded-lg bg-gray-200  !text-gray-600 !w-10 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="size-6"
                                                        aria-label="ارسال سریع سفارشات">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                                                    </svg>
                                                </div>
                                                <div class="space-y-1 text-center mt-4">
                                                    <div class="text-xs !text-gray-600 font-bold ">ارسال سریع </div>
                                                    <span class="text-xs !text-gray-500 ">فردای ثبت سفارش</span>
                                                </div>
                                            </div>
                                        </article>

                                        <article class="col-span-1">
                                            <div
                                                class="p-1 lg:p-3 hover:drop-shadow-lg hover:-translate-y-2   transition duration-300 border border-gray-200 flex bg-white shadow rounded-lg flex-col items-center justify-center">
                                                <div
                                                    class="size-10 flex items-center justify-center rounded-lg bg-gray-200 !text-gray-600 !w-10  ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="size-6"
                                                        aria-label="تضمین کیفیت و اصالت">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="space-y-1 text-center mt-4">
                                                    <div class="text-xs !text-gray-600 font-bold dark:text-white">تضمین اصالت</div>
                                                    <span class="text-xs !text-gray-500 dark:!text-gray-400"> طلای ۱۸ اعیار</span>
                                                </div>
                                            </div>
                                        </article>

                                        <article  class="col-span-1">
                                            <div
                                                class="p-1 lg:p-3 border border-gray-200 flex  bg-white shadow rounded-lg flex-col items-center justify-center hover:shadow-lg hover:-translate-y-2 transition duration-300 ">
                                                <div
                                                    class="size-10 flex items-center justify-center rounded-lg bg-gray-200 !text-gray-600  !w-10">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="size-6"
                                                        aria-label="ارسال به سراسر کشور">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="space-y-1 text-center mt-4">
                                                    <div class="text-xs !text-gray-600 font-bold dark:text-white">ارسال به </div>
                                                    <span class="text-xs !text-gray-500 dark:!text-gray-400">سراسر کشور</span>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </section>




                            </div>
                            <div class="  w-full  lg:w-1/3 p-2 lg:p-5">
                                <div class="bg-gray border  p-2 border-radius-5">


                                    @isset($detail->attr['weight'])
                                        <div class="flex one">
                                            @if (isset($detail->attr['in-stock']) && $detail->attr['in-stock'] > 0)
                                                <div class="flex p-3  justify-between">
                                                    <span class="text-slate-500 text-sm">وزن: </span>
                                                    <span class="text-left bold">{{ $detail->attr['weight'] ?? 0 }} گرم</span>
                                                </div>
                                                <div class="flex border-t py-2 px-3 justify-between">
                                                    <span class="text-slate-500 text-sm items-center flex !w-auto">قیمت روز طلا (هر
                                                        گرم):</span>
                                                    <span class="text-left">@convertCurrency($detail->GoldPrice()['goldprice'])
                                                    <span class="text-xs">تومان</span>
                                                </span>
                                                </div>
                                                <div class="flex border-t py-2 px-3 justify-between">
                                                    <span class="text-slate-500 text-sm items-center flex !w-auto">اجرت ساخت
                                                        ({{ $detail->attr['ojrat'] ?? 13 }}٪):</span> <span
                                                        class="text-left">@convertCurrency($detail->GoldPrice()['ojrat'])
                                                        <span class="text-xs">تومان</span></span>
                                                </div>
                                                <div class="flex border-t px-3 py-2 justify-between"><span
                                                        class="text-slate-500 text-sm items-center flex !w-auto">سود دینگ
                                                        (7٪):</span><span class="text-left">
                                                        @convertCurrency($detail->GoldPrice()['sood']) <span class="text-xs">تومان</span></span></div>
                                                <div class="flex border-t px-3 py-2 justify-between"><span
                                                        class="text-slate-500 text-sm items-center flex !w-auto">مالیات (10% بر روی
                                                        سود و اجرت):</span><span
                                                        class="text-left">@convertCurrency($detail->GoldPrice()['tax']) <span class="text-xs">تومان</span></span>
                                                </div>
                                                <div class="flex border-t px-3 py-2 justify-between"><span
                                                        class="text-slate-500 text-sm items-center flex !w-auto">خرج
                                                        کار:</span><spanca
                                                        class="text-left">@convertCurrency($detail->attr['additionalprice'])
                                                        <span class="text-xs">تومان</span></span></div>

                                                <div class="font-15 px-3 py-2 text-center bold text-green">قیمت
                                                    @convertCurrency($detail->GoldPrice()['totalPrice'])
                                                    <span class="text-xs">تومان</span></div>
                                            @else
                                                <div class="text-center"> سفارش بالای ۱ گرم پذیرفته می شود</div>
                                            @endif
                                        </div>
                                    @endisset

                                    @include('dinggold.AddToCart')
                                </div>

                            </div>
                        </div>

                        <ul class="sm:p-1">
                            @foreach ($table_of_content as $key => $item)
                                <li class="toc1">
                                    <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                                </li>
                            @endforeach

                        </ul>

                        <div class="p-1">
                            @include(@env('TEMPLATE_NAME') . '.DescriptionModule')
                        </div>


                    </div>
                </div>




            </div>
        </div>
    </section>

    @if (count($relatedProduct))
        <section class="products    m-0 pt-1 pb-1" id="index-best-view">
            <div class="flex one ">
                <div>
                    <h2>محصولات مرتبط {{ $detail->title }}</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3  ">
                        @foreach ($relatedProduct as $content)
                            <a href="{{ url($content->slug) }}">
                                <div class=" p-0 border-radius-5">
                                    @if (isset($content->images['images']['small']))
                                        <figure class="image">
                                            @if (isset($content->attr['in-stock']) && $content->attr['in-stock'] == 0)
                                                <div class="not-in-stock">قابل سفارش</div>
                                            @endif
                                            <img loading="lazy" src="{{ image_or_placeholder($content->images['images']['large']) }}"
                                                alt="{{ $content->title }}" title="{{ $content->title }}" width="300" height="300">
                                            <figcaption>
                                                <h3 class="p-3 m-0 text-center text-sm"> {{ $content->title }}</h3>
                                            </figcaption>
                                        </figure>
                                    @else
                                        <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                                    @endif
                                    <div class="  text-center bold text-green">قیمت
                                        @convertCurrency($content->GoldPrice()['totalPrice'])
                                        تومان</div>

                                </div>
                            </a>
                        @endforeach

                    </div>

                </div>
            </div>
        </section>
    @endif



    <section class="comments bg-gray mt-0 mb-0">
        <div class="flex one">
            <div>

                @include('dinggold.Comment')

            </div>
        </div>
    </section>

@endsection

@extends(@env('TEMPLATE_NAME') . '.App')


@section('twitter:title', $detail->title)
@section('twitter:description', clearHtml($detail->brief_description))

@section('og:title', $detail->title)
@section('og:description', clearHtml($detail->brief_description))

@if (isset($detail->images['images']['medium']))
@section('twitter:image', url($detail->images['images']['medium']))

@section('og:image', url($detail->images['images']['medium']))
@section('og:image:type', 'image/jpeg')
@section('og:image:width', $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W'))
@section('og:image:height', $detail->attr_type == 'article' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H'))
@section('og:image:alt', $detail->title)
@endif



@section('footer')
    @auth
        @if (Auth::user()->id == 1)
            <div class="fixed top-0 right-0 z-50 bg-blue-500 py-2 px-3 rounded-bl text-white"
                onclick="window.open('{{ url('/admin/contents/' . $detail->id . '/edit/') }}')">
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
        @include('jsonLdProduct')
    @endif
    @include('jsonLdFaq')

    @if ($detail->attr_type == 'article')
        @include('jsonLdArticle')
    @endif

    @if (count($breadcrumb) > 0)
        @include('jsonLdBreadcrumb')
    @endif




    <!-- ================= start content section ================= -->
    <section class="py-5" itemscope itemtype="https://schema.org/Product">
        <div class="container">
            <!-- breadcrumb -->
            <nav class="flex mt-2 mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse" itemscope
                    itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="/"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white"
                            itemprop="item">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            <span itemprop="name">خانه</span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>

                    @foreach ($breadcrumb as $key => $item)
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 9 4-4-4-4" />
                                </svg>
                                <a href="{{ $item['slug'] }}"
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
                                    itemprop="item">
                                    <span itemprop="name">{{ $item['title'] }}</span>
                                </a>
                            </div>
                            <meta itemprop="position" content="2">
                        </li>
                    @endforeach


                </ol>
            </nav>
            <!-- main -->
            <div
                class="dark:bg-background-dark dark:text-white bg-white rounded-lg drop-shadow-lg border-gray-300 border-1 p-4">
                <div class="grid grid-cols-4 gap-4 place-items-start">
                    <!-- gallery -->
                    <section class="lg:col-span-1 my-7 col-span-4 w-full" itemprop="image" itemscope
                        itemtype="https://schema.org/ImageGallery">

                        <div class="swiper" id="productGalleryTwo">
                            <div class="swiper-wrapper" style="padding-bottom: 20px !important;">



                                <div class="swiper-slide !pl-1" itemprop="image" itemscope
                                    itemtype="https://schema.org/ImageObject">
                                    <img src="{{ image_or_placeholder($detail->images['images']['large']) }}"
                                        alt="{{ $detail->title }}" class="rounded-lg border border-gray-300 p-2"
                                        itemprop="contentUrl">
                                    <meta itemprop="caption" content="{{ $detail->title }}">
                                </div>

                                @foreach ($detail->gallery as $item)
                                    <div class="swiper-slide !pl-1" itemprop="image" itemscope
                                        itemtype="https://schema.org/ImageObject">
                                        <img src="{{ $item->images['images']['small'] }}"
                                            class="rounded-lg border border-gray-300 p-2" itemprop="contentUrl">
                                        <meta itemprop="caption" content="{{ $detail->title }} - گالری">
                                    </div>
                                @endforeach

                            </div>
                            <div class="swiper-button-next swiper-button-next bg-white rounded-full dark:bg-zinc-800 border border-gray-200 !size-12 after:!text-xl px-3 after:text-primary"
                                aria-label="اسلاید بعدی"></div>
                            <div class="swiper-button-prev swiper-button-next bg-white rounded-full dark:bg-zinc-800 border border-gray-200 !size-12 after:!text-xl px-3 after:text-primary"
                                aria-label="اسلاید قبلی"></div>
                        </div>
                        <div id="productGalleryOne" class="swiper" style="padding-left: 10px!important;">
                            <div class="swiper-wrapper" style="padding-bottom: 0px !important;">



                                <div class="swiper-slide !pl-1" itemprop="image" itemscope
                                    itemtype="https://schema.org/ImageObject">
                                    <img src="{{ image_or_placeholder($detail->images['images']['large']) }}"
                                        alt="گوشی موبایل اپل مدل iPhone 13 Pro Max"
                                        class="rounded-lg cursor-pointer border border-gray-300 p-2" itemprop="contentUrl">
                                    <meta itemprop="caption" content="گوشی موبایل اپل مدل iPhone 13 Pro Max">
                                </div>

                                @foreach ($detail->gallery as $item)
                                    <div class="swiper-slide !pl-1" itemprop="image" itemscope
                                        itemtype="https://schema.org/ImageObject">
                                        <img src="{{ image_or_placeholder($item->images['images']['small']) }}"
                                            alt="گوشی موبایل اپل مدل iPhone 13 Pro Max"
                                            class="rounded-lg cursor-pointer border border-gray-300 p-2" itemprop="contentUrl">
                                        <meta itemprop="caption" content="گوشی موبایل اپل مدل iPhone 13 Pro Max">
                                    </div>

                                @endforeach


                            </div>
                        </div>
                    </section>



                    <!-- meta -->
                    <section class="lg:col-span-3 col-span-4 w-full my-7">
                        <!-- title -->
                        <div class="space-y-5 border-b border-b-gray-300 pb-3">
                            <h1 class="font-bold text-xl" itemprop="name">{{ $detail->title }}</h1>
                            <div class="flex items-center space-x-7 w-full">
                                <h2 class="text-zinc-500 text-base" itemprop="model">{{ $detail->viewCount }} بازدید</h2>

                                <div class="flex items-center" itemprop="aggregateRating" itemscope
                                    itemtype="https://schema.org/AggregateRating">
                                    <!-- <meta itemprop="ratingValue" content="3">
                                                                                <meta itemprop="reviewCount" content="128"> -->
                                    <div class="flex items-center">
                                        @php
                                            $rateAvrage = $rateSum = $gold = 0;
                                            $silver = 5;
                                        @endphp
                                        @foreach ($detail->comments as $comment)
                                            @php
                                                $rateSum = $rateSum + $comment['rate'];
                                            @endphp
                                        @endforeach
                                        @php
                                            if (isset($detail->comments) && count($detail->comments))
                                                $gold = $rateSum / count($detail->comments);
                                        @endphp
                                        @for ($i = ceil($gold); $i >= 1; $i--)
                                            <svg class="w-4 h-4 text-orange-300 ms-1" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path
                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                        @endfor
                                        @for($i = 1; $i <= $silver - ceil($gold); $i++)
                                            <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path
                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                        @endfor
                                        <span class="px-2">({{ count($detail->comments) }} نفر)</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- feature -->
                        <div class="space-y-5 mt-4 border-gray-300 border-b pb-3">
                            {!! $detail->brief_description !!}
                        </div>


                    </section>
                    <!-- shop feature -->
                    <section class="col-span-4 w-full">
                        <div class="grid gap-x-4 gap-y-4 grid-cols-6">
                            <article itemscope itemtype="https://schema.org/Service" class="lg:col-span-1 col-span-3">
                                <meta itemprop="name" content="ارسال سریع سفارشات">
                                <meta itemprop="description" content="تحویل سفارشات در سریع‌ترین زمان ممکن">
                                <div
                                    class="p-3 hover:drop-shadow-sm hover:-translate-y-2 dark:bg-background-dark cursor-pointer transition duration-300 border border-gray-200 flex bg-white shadow rounded-lg flex-col items-center justify-center">
                                    <div
                                        class="size-10 flex items-center justify-center rounded-lg bg-gray-200 text-gray-600 dark:bg-background-dark dark:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6"
                                            aria-label="ارسال سریع سفارشات">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>
                                    <div class="space-y-1 text-center mt-4">
                                        <h3 class="text-sm text-gray-600 font-bold dark:text-white">ارسال سریع سفارشات</h3>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">فردای ثبت سفارش</span>
                                    </div>
                                </div>
                            </article>
                            <article itemscope itemtype="https://schema.org/Service" class="lg:col-span-1 col-span-3">
                                <meta itemprop="name" content="پرداخت در محل">
                                <meta itemprop="description" content="پرداخت وجه پس از تحویل کالا">
                                <div
                                    class="p-3 hover:drop-shadow-lg hover:-translate-y-2 dark:bg-background-dark cursor-pointer transition duration-300 border border-gray-200 flex bg-white shadow rounded-lg flex-col items-center justify-center">
                                    <div
                                        class="size-10 flex items-center justify-center rounded-lg bg-gray-200 text-gray-600 dark:bg-background-dark dark:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6"
                                            aria-label="پرداخت در محل">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                        </svg>
                                    </div>
                                    <div class="space-y-1 text-center mt-4">
                                        <h3 class="text-sm text-gray-600 font-bold dark:text-white">پرداخت در محل</h3>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">پس از تحویل کالا</span>
                                    </div>
                                </div>
                            </article>
                            <article itemscope itemtype="https://schema.org/Service" class="lg:col-span-1 col-span-3">
                                <meta itemprop="name" content="تضمین کیفیت و اصالت">
                                <meta itemprop="description" content="ضمانت مرجوعی کالا در صورت نارضایتی">
                                <div
                                    class="p-3 hover:drop-shadow-lg hover:-translate-y-2 dark:bg-background-dark cursor-pointer transition duration-300 border border-gray-200 flex bg-white shadow rounded-lg flex-col items-center justify-center">
                                    <div
                                        class="size-10 flex items-center justify-center rounded-lg bg-gray-200 text-gray-600 dark:bg-background-dark dark:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6"
                                            aria-label="تضمین کیفیت و اصالت">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                        </svg>
                                    </div>
                                    <div class="space-y-1 text-center mt-4">
                                        <h3 class="text-sm text-gray-600 font-bold dark:text-white">تضمین کیفیت و اصالت</h3>
                                        <span class="text-xs text-gray-500 dark:text-gray-400"> ضمانت مرجوعی</span>
                                    </div>
                                </div>
                            </article>
                            <article itemscope itemtype="https://schema.org/Service" class="lg:col-span-1 col-span-3">
                                <meta itemprop="name" content="پشتیبانی ۲۴ ساعته">
                                <meta itemprop="description" content="پشتیبانی آنلاین و تلفنی در هر ساعت از شبانه‌روز">
                                <div
                                    class="p-3 border border-gray-200 flex dark:bg-background-dark bg-white shadow rounded-lg flex-col items-center justify-center hover:shadow-lg hover:-translate-y-2 transition duration-300 cursor-pointer">
                                    <div
                                        class="size-10 flex items-center justify-center rounded-lg bg-gray-200 text-gray-600 dark:bg-background-dark dark:text-white">
                                        <svg aria-label="پشتیبانی ۲۴ ساعته" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                        </svg>
                                    </div>
                                    <div class="space-y-1 text-center mt-4">
                                        <h3 class="text-sm text-gray-600 font-bold dark:text-white">پشتیبانی ۲۴ ساعته</h3>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">پاسخگویی در هر زمان</span>
                                    </div>
                                </div>
                            </article>
                            <article itemscope itemtype="https://schema.org/Service" class="lg:col-span-1 col-span-3">
                                <meta itemprop="name" content="خرید آسان و سریع">
                                <meta itemprop="description" content="فرآیند خرید راحت و بی‌دردسر با چند کلیک">
                                <div
                                    class="p-3 border border-gray-200 flex dark:bg-background-dark bg-white shadow rounded-lg flex-col items-center justify-center hover:shadow-lg hover:-translate-y-2 transition duration-300 cursor-pointer">
                                    <div
                                        class="size-10 flex items-center justify-center rounded-lg bg-gray-200 text-gray-600 dark:bg-background-dark dark:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6"
                                            aria-label="خرید آسان و سریع">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 9h16.5m-8.25-6h-6a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3h-6" />
                                        </svg>
                                    </div>
                                    <div class="space-y-1 text-center mt-4">
                                        <h3 class="text-sm text-gray-600 font-bold dark:text-white">خرید آسان و سریع</h3>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">چند کلیک تا خرید</span>
                                    </div>
                                </div>
                            </article>
                            <article itemscope itemtype="https://schema.org/DeliveryChargeSpecification"
                                class="lg:col-span-1 col-span-3">
                                <meta itemprop="name" content="ارسال به سراسر کشور">
                                <meta itemprop="description"
                                    content="ارسال محصولات به تمام نقاط کشور با استفاده از پست پیشتاز">
                                <meta itemprop="shippingMethod" content="پست پیشتاز">
                                <meta itemprop="shippingDestination" content="تمام نقاط کشور">
                                <div
                                    class="p-3 border border-gray-200 flex dark:bg-background-dark bg-white shadow rounded-lg flex-col items-center justify-center hover:shadow-lg hover:-translate-y-2 transition duration-300 cursor-pointer">
                                    <div
                                        class="size-10 flex items-center justify-center rounded-lg bg-gray-200 text-gray-600 dark:bg-background-dark dark:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6"
                                            aria-label="ارسال به سراسر کشور">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                        </svg>
                                    </div>
                                    <div class="space-y-1 text-center mt-4">
                                        <h3 class="text-sm text-gray-600 font-bold dark:text-white">ارسال به سراسر کشور</h3>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">با پست پیشتاز</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <!-- ================= end content section ================= -->



    <!-- ================= start section product review ================= -->
    <section class="py-5">
        <div class="container">
            <!-- navbar -->
            <nav class="px-5 rounded-xl dark:bg-zinc-800 bg-gray-300" itemscope itemtype="https://schema.org/Product">
                <ul class="flex space-x-1 md:overflow-x-auto overflow-x-scroll text-nowrap py-4" role="tablist">
                    <li role="presentation">
                        <button
                            class="bg-white tab-button px-15 py-5 rounded-xl transition-colors tab-button dark:bg-zinc-400 active"
                            role="tab" data-tab="Intro" aria-controls="description" aria-selected="true"
                            itemprop="description">
                            توضیحات کالا
                        </button>
                    </li>

                    <li role="presentation">
                        <button
                            class="bg-white tab-button px-15 py-5 rounded-xl transition-colors tab-button dark:bg-zinc-400"
                            role="tab" data-tab="Comments" aria-controls="reviews" itemprop="aggregateRating" itemscope
                            itemtype="https://schema.org/AggregateRating">
                            نظرات <span
                                class="bg-secondary-500 size-5 text-sm text-center inline-block rounded text-white ms-1"
                                itemprop="reviewCount">{{ count($detail->comments) }}</span>
                        </button>
                    </li>

                </ul>
            </nav>

            <!-- content -->
            <div class="tab-contents mt-4">
                <!-- Intro -->
                <div id="Intro"
                    class="p-5 bg-white dark:bg-zinc-800 dark:text-white rounded-xl hidden tab-content border border-gray-300 drop-shadow tab-content">
                    <div class="space-y-5">
                        <h2
                            class="text-2xl pb-3 font-black text-zinc-800 relative before:absolute before:bottom-0 before:right-0 before:h-1 before:w-22 before:bg-primary-500 before:rounded dark:text-white">
                            معرفی محصول</h2>
                        <p class="text-neutral-700 leading-9 text-justify text-lg dark:text-white">
                        <ul class="">
                            @foreach ($table_of_content as $key => $item)
                                <li class="toc1 ">
                                    <a class="" id="test" href="#{{ $item['anchor'] }}">✅ {{ $item['label'] }}</a>
                                </li>
                            @endforeach

                        </ul>
                        @include(@env('TEMPLATE_NAME') . '.DescriptionModule')
                        </p>
                    </div>
                </div>




                <!-- Comments -->
                <div id="Comments"
                    class="p-5 bg-white dark:bg-zinc-800 dark:text-white rounded-xl hidden tab-content border border-gray-300 drop-shadow tab-content"
                    data-content="4">
                    <div class="space-y-4">
                        <h2
                            class="text-2xl pb-3 font-black text-zinc-800 relative before:absolute before:bottom-0 before:right-0 before:h-1 before:w-22 before:bg-primary-500 before:rounded dark:text-white">
                            نظرت در مورد این محصول چیه؟
                        </h2>
                        <p class="text-neutral-700 text-sm dark:text-white">
                            برای ثبت نظر، از طریق دکمه افزودن دیدگاه جدید نمایید. اگر این محصول را قبلا خریده باشید، نظر شما
                            به عنوان خریدار ثبت خواهد شد.
                        </p>
                    </div>
                    <div class="grid grid-cols-4 relative gap-6 mt-8">
                        <!-- rating -->
                        <div class="lg:col-span-1 col-span-4">
                            <div class="sticky top-0">
                                <div class="space-y-8 border border-gray-200 p-2 rounded text-center">
                                    <h4 class="text-3xl">متوسط امتیاز ها</h4>
                                    <h5 class="text-3xl">{{ number_format($gold, 1) }}</h5>
                                    <div
                                        class="flex rounded items-center p-2 bg-gray-100 dark:bg-transparent justify-center">

                                        @for ($i = ceil($gold); $i >= 1; $i--)
                                            <svg class="w-4 h-4 text-orange-400 ms-1" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path
                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z">
                                                </path>
                                            </svg>
                                        @endfor
                                        @for($i = 1; $i <= $silver - ceil($gold); $i++)
                                            <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path
                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z">
                                                </path>
                                            </svg>
                                        @endfor


                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- form and comment -->
                        <div class="lg:col-span-3 col-span-4">
                            <!-- form -->
                            <div class="w-full pb-4 border-b border-b-gray-300">
                                <form action="{{ route('comment.client.store') }}#comment" method="post" id="comment">
                                    <input type="hidden" name="content_id" value="{{ $detail->id }}">
                                    @csrf
                                    @if ($errors->comment_error->has('rate'))
                                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-3 rounded">
                                            {{ $errors->comment_error->first('rate') }}
                                        </div>
                                    @endif
                                    @if (\Session::has('comment_success'))
                                        <div class="bg-lime-100 border border-lime-400 text-lime-700 px-4 py-3 mb-3 rounded">
                                            {!! \Session::get('comment_success') !!}
                                        </div>
                                    @endif


                                    @if (\Session::has('comment_error'))
                                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                            {!! \Session::get('comment_error') !!}
                                        </div>
                                    @endif
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label value="{{ old('name') }}" for="name" class="mb-3 inline-block">نام و نام
                                                خانوادگی:</label>
                                            <input id="name" name="name" value="{{ old('name') }}" type="text"
                                                placeholder="نام خود را وارد کنید"
                                                class="w-full px-3 py-4 border-gray-300 border rounded-lg">
                                        </div>

                                    </div>

                                    <div class="mb-4">
                                        <label class="block mb-4">امتیاز شما:</label>
                                        <div class="flex space-x-2">
                                            <input type="radio" id="star1" name="rate" class="hidden" value="1" {{ old('rate') == '1' ? 'checked' : '' }}>
                                            <label for="star1" class="cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-6 text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03z" />
                                                </svg>
                                            </label>

                                            <input type="radio" id="star2" name="rate" class="hidden" value="2" {{ old('rate') == '2' ? 'checked' : '' }}>
                                            <label for="star2" class="cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-6 text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03z" />
                                                </svg>
                                            </label>

                                            <input type="radio" id="star3" name="rate" class="hidden" value="3" {{ old('rate') == '3' ? 'checked' : '' }}>
                                            <label for="star3" class="cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-6 text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03z" />
                                                </svg>
                                            </label>

                                            <input type="radio" id="star4" name="rate" class="hidden" value="4" {{ old('rate') == '4' ? 'checked' : '' }}>
                                            <label for="star4" class="cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-6 text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03z" />
                                                </svg>
                                            </label>

                                            <input type="radio" id="star5" name="rate" class="hidden" value="5" {{ old('rate') == '5' ? 'checked' : '' }}>
                                            <label for="star5" class="cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-6 text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03z" />
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="comment" class="mb-3 inline-block">نظر:</label>
                                        <textarea id="comment" name="comment" placeholder="متن نظر!"
                                            class="w-full px-3 py-4 border-gray-300 border rounded-lg h-32 mb-4">{{ old('comment') }}</textarea>
                                    </div>

                                    <button class="bg-primary-grad text-white py-3 px-20 rounded-lg">ثبت نظر</button>
                                </form>
                            </div>
                            <!-- comment -->
                            <div class="space-y-5">
                                <div class="grid py-5 gap-4 grid-cols-4">
                                    <div class="md:col-span-3 col-span-4">
                                        <div class="flex space-x-3 items-center">


                                        </div>
                                    </div>
                                    <div class="md:col-span-1 col-span-4">
                                        <div class="md:text-left">
                                            <span class="text-neutral-600 text-sm dark:text-white">{{ $detail->comments->filter(fn($c) => $c->name && $c->comment)->count() }} نظر تایید شده</span>
                                        </div>
                                    </div>
                                </div>


                                @foreach ($detail->comments as $comment)
                                    @if ($comment['name'] != '' && $comment['comment'] != '')
                                        <div class="border border-gray-300 rounded-lg p-4">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-gray-700  dark:text-white">{{ $comment['name'] }}</span>
                                                    <span
                                                        class="text-gray-500 text-sm">{{ convertGToJ($comment['created_at']) }}</span>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-start justify-start mt-2">
                                                <div class="flex ml-2 text-orange-300">
                                                    @for ($i = 0; $i <= $comment['rate']; $i++)
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M12 .587l3.668 7.432 8.332 1.151-6.001 5.856 1.417 8.283-7.416-3.897-7.416 3.897 1.417-8.283-6.001-5.856 8.332-1.151z" />
                                                        </svg>
                                                    @endfor

                                                </div>
                                            </div>
                                            <p class="text-gray-700 my-4 leading-9 text-sm dark:text-white">
                                                {!! $comment['comment'] !!}
                                            </p>

                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- ================= end section product review ================= -->



@endsection

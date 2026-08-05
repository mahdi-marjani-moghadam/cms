@extends(@env('TEMPLATE_NAME') . '.App')

@push('scripts')

@endpush

@section('Content')





    <!-- ================= start slider section ================= -->
    <section class="py-5">
        <h2 class="sr-only">اسلایدر فروشگاه</h2>
        <!-- for seo -->
        <div class="w-full overflow-hidden">
            <div class="swiper max-w-[1920px] mx-auto !relative default-carousel swiper-container"
                aria-label="اسلایدر فروشگاه">
                <div class="swiper-wrapper" style="padding-bottom: 0 !important;">


                    {{--images&label=banner&var=banners&count=1 --}}
                    @foreach ($banners['images'] as $content)
                        <div class="swiper-slide max-w-[1920px]" role="group" aria-roledescription="slide">
                            <a href="#">
                                <div class="lg:h-90 flex justify-center items-center">
                                    <img src="{{ image_or_placeholder($content) }}"
                                        class="h-full w-full object-cover rounded-lg" loading="lazy">
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
                @if (isset($banners) && isset($banners['images']) && count($banners['images']) > 1)
                    <div class="swiper-button-next bg-white rounded-full dark:bg-zinc-800 border border-gray-200 !size-12 after:!text-xl px-3 after:text-primary"
                        aria-label="اسلاید بعدی"></div>
                    <div class="swiper-button-prev bg-white rounded-full dark:bg-zinc-800 border border-gray-200 !size-12 after:!text-xl px-3 after:text-primary"
                        aria-label="اسلاید قبلی"></div>

                    <div class="swiper-pagination !z-30 !bottom-0" aria-label="صفحه بندی اسلایدر"></div>
                    <div class="slider-pagination-bg absolute w-40 h-10 -translate-x-1/2 -mb-3 pt-1 left-1/2 bottom-0 z-10">
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- ================= end slider section ================= -->





    <!-- ================= start feature section ================= -->
    <section class="py-5">
        <h2 class="sr-only">ویژگی های فروشگاه</h2>
        <!-- برای سئو -->
        <div class="container">
            <div class="grid grid-cols-4 gap-4 place-items-center">
                <div class="xl:!col-span-1 col-span-4 w-full">
                    <div class="flex justify-start flex-col items-start">
                        <div class="flex items-center w-full justify-start">
                            <div
                                class="w-12 flex items-center justify-center h-10 dark:bg-secondary-300 dark:text-white dark:border-transparent bg-gray-200  text-gray-600 border border-gray-200 rounded-lg rounded-l-none">
                                چرا
                            </div>
                            <div
                                class="w-23 text-white flex items-center bg-primary-grad rounded-r-none justify-center rounded-lg h-10">
                                عصر آی تی؟
                            </div>
                        </div>
                        <p class="text-gray-600 text-start dark:text-white leading-9 mt-5">
                            خرید مستقیم از تولید کننده داخلی </p>
                    </div>
                </div>
                <div class="xl:!col-span-3 col-span-4 w-full">
                    <div class="grid gap-x-4 lg:mt-0 mt-4 gap-y-4 grid-cols-6">
                        <article itemscope itemtype="https://schema.org/Service" class="lg:col-span-1 col-span-3">
                            <meta itemprop="name" content="ارسال سریع سفارشات">
                            <meta itemprop="description" content="تحویل سفارشات در سریع‌ترین زمان ممکن">
                            <div
                                class="p-3 hover:drop-shadow-lg hover:-translate-y-2 dark:bg-background-dark  transition duration-300 border border-gray-200 flex bg-white shadow-md rounded-lg flex-col items-center justify-center">
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
                                class="p-3 hover:drop-shadow-lg hover:-translate-y-2 dark:bg-background-dark  transition duration-300 border border-gray-200 flex bg-white shadow-md rounded-lg flex-col items-center justify-center">
                                <div
                                    class="size-10 flex items-center justify-center rounded-lg bg-gray-200 text-gray-600 dark:bg-background-dark dark:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6" aria-label="پرداخت در محل">
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
                                class="p-3 hover:drop-shadow-lg hover:-translate-y-2 dark:bg-background-dark  transition duration-300 border border-gray-200 flex bg-white shadow-md rounded-lg flex-col items-center justify-center">
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
                                class="p-3 border border-gray-200 flex dark:bg-background-dark bg-white shadow-md rounded-lg flex-col items-center justify-center hover:shadow-lg hover:-translate-y-2 transition duration-300 ">
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
                                class="p-3 border border-gray-200 flex dark:bg-background-dark bg-white shadow-md rounded-lg flex-col items-center justify-center hover:shadow-lg hover:-translate-y-2 transition duration-300 ">
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
                            <meta itemprop="description" content="ارسال محصولات به تمام نقاط کشور با استفاده از پست پیشتاز">
                            <meta itemprop="shippingMethod" content="پست پیشتاز">
                            <meta itemprop="shippingDestination" content="تمام نقاط کشور">
                            <div
                                class="p-3 border border-gray-200 flex dark:bg-background-dark bg-white shadow-md rounded-lg flex-col items-center justify-center hover:shadow-lg hover:-translate-y-2 transition duration-300 ">
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
                </div>
            </div>
        </div>
    </section>
    <!-- ================= end feature section ================= -->






    <!-- ================= start amazing section ================= -->
    <section class="py-5" itemscope itemtype="http://schema.org/ItemList">
        <h2 class="sr-only" itemprop="name">محصولات شگفت انگیز</h2>
        <div class="container">
            <div class="bg-primary dark:bg-zinc-700 bg-contain bg-[url(/it-times-store/assets/images/slider/patterns.png)] p-5 rounded-lg">
                <div class="swiper amazing-carousel">
                    <div class="swiper-wrapper items-center" style="padding-bottom: 0 !important;">
                        <div class="swiper-slide !ml-0 !w-40 p-1">
                            <article class="flex flex-col space-y-3 items-center justify-center">
                                <img class="size-35" src="/it-times-store/assets/images/slider/Amazing.svg"
                                    alt="آیکن محصولات شگفت انگیز" loading="lazy">
                                <div class="flex text-white items-center" aria-label="مشاهده همه محصولات">
                                    محصولات جدید
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4 ms-1" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 19.5 8.25 12l7.5-7.5" />
                                    </svg>
                                </div>
                            </article>
                        </div>
                        {{--product&label=product&var=product&count=20 --}}
                        @isset($product['data'])
                            @foreach ($product['data'] as $content)
                                <div class="swiper-slide !w-auto p-1">
                                    <article
                                        class="bg-white w-75 product-box-item drop-shadow-lg shadow-lg rounded-xl p-4 dark:bg-background-dark dark:bg-background-dark dark:border-white dark:border-1"
                                        >


                                        <figure class="flex image justify-center my-4">
                                            <a href="{{ $content->slug }}" itemprop="url">
                                                <img class="one-image"
                                                    src="{{ image_or_placeholder($content->images['images']['small']) }}"
                                                    loading="lazy" alt="{{ $content->title }}" >
                                                @if(count($content->gallery)>0)
                                                    @foreach ($content->gallery as $gallery)
                                                        <img class="two-image"
                                                            src="{{ image_or_placeholder($gallery->images['images']['small']) }}"
                                                            loading="lazy" >
                                                    @endforeach
                                                @else
                                                <img class="two-image"
                                                    src="{{ image_or_placeholder($content->images['images']['small']) }}"
                                                    loading="lazy" alt="{{ $content->title }}">
                                                @endif
                                            </a>
                                        </figure>
                                        <h3 class="text-base leading-8  line-clamp-2 mb-2">
                                            <a href="{{ $content->slug }}" class="text-gray-800 dark:text-white"
                                                >{{ $content->title }}</a>
                                        </h3>

                                    </article>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================= end amazing section ================= -->





    <!-- ================= start category section ================= -->
    <section class="py-5">
        <div class="container">
            <div class="mb-10">
                <header class="grid place-items-center grid-cols-6 gap-y-10" itemscope
                    itemtype="https://schema.org/CollectionPage">
                    <div class="ps-15 section-heading sm:col-span-4 w-full col-span-6 relative space-y-3">
                        <h2 class="font-black text-2xl">
                            <span itemprop="name" class="dark:text-white">دسته بندی</span>
                            <span class="text-primary font-bold">فروشگاه</span>
                        </h2>
                        <p class="text-neutral-600 dark:text-white" itemprop="description">محصولات عمده</p>
                    </div>


                </header>
            </div>
            <div class="grid grid-cols-12 gap-4">

                {{--category&label=cat&var=category&count=8 --}}
                @isset($category['data'])
                    @foreach ($category['data'] as $content)
                        <a href="{{ $content->slug }}" class="lg:col-span-3 sm:col-span-6 col-span-12 w-full block">
                            <article itemscope itemtype="https://schema.org/CategoryCode"
                                class="flex py-2 px-3 rounded-xl border border-gray-200 bg-white drop-shadow-md items-center justify-between dark:bg-background-dark">
                                <section class="space-y-2">
                                    <h3 itemprop="name" class="text-lg font-bold dark:text-white">{{ $content->title }}</h3>
                                    <span class="text-xs font-light text-neutral-500"
                                        itemprop="description">{{ $content->category['title'] ?? ''}}</span>
                                </section>
                                <figure>
                                    <img src="{{ image_or_placeholder($content->images['images']['small'] ?? '') }}" class="size-20"
                                        loading="lazy" alt="{{ $content->title }}" itemprop="image">
                                </figure>
                            </article>
                        </a>
                    @endforeach
                @endisset
            </div>
        </div>
    </section>
    <!-- ================= end category section ================= -->








    <!-- ================= start banner section ================= -->
    <section class="py-5" aria-label="تبلیغات ویژه" itemscope itemtype="https://schema.org/ItemList" id="advertisements">
        <h2 class="sr-only" itemprop="name">تبلیغات و پیشنهادات ویژه</h2>
        <div class="container">
            <div class="grid grid-cols-2 gap-4 place-items-center">
                <div class="lg:col-span-1 col-span-2" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/Promotion" itemid="#summer-promo">
                    <a href="/سیم-ها" aria-label="مشاهده پیشنهادات تابستانی" itemprop="url">
                        <img src="/it-times-store/assets/images/advert/banner-2.jpg"
                            class="rounded-lg transition block duration-300 hover:-translate-y-2"
                            alt="تابستانه ویژه - تا ۵۰% تخفیف روی محصولات منتخب" loading="lazy" itemprop="image">
                        <meta itemprop="name" content="تخفیف تابستانی">
                        <meta itemprop="description" content="تا ۵۰% تخفیف روی محصولات منتخب فصل تابستان">
                        <div itemprop="validFrom" content="2024-06-01T00:00:00+03:30"></div>
                        <div itemprop="validThrough" content="2024-09-22T23:59:59+03:30"></div>
                        <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                            <meta itemprop="name" content="نام سایت شما">
                            <meta itemprop="url" content="https://example.com">
                        </div>
                    </a>
                </div>
                <div class="lg:col-span-1 col-span-2" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/Promotion" itemid="#autumn-promo">
                    <a href="/کانکتور-و-تبدیل" aria-label="مشاهده مجموعه جدید" itemprop="url">
                        <img src="/it-times-store/assets/images/advert/banner-1.jpg"
                            class="rounded-lg transition block duration-300 hover:-translate-y-2"
                            alt="مجموعه جدید پاییزه - آخرین مدل‌های روز دنیا" loading="lazy" itemprop="image">
                        <meta itemprop="name" content="مجموعه پاییزه">
                        <meta itemprop="description" content="آخرین مدل‌های روز دنیا برای فصل پاییز">
                        <div itemprop="validFrom" content="2024-09-23T00:00:00+03:30"></div>
                        <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                            <meta itemprop="name" content="نام سایت شما">
                            <meta itemprop="url" content="https://example.com">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ================= end banner section ================= -->





    <!-- ================= start product section ================= -->
    <section class="py-5">
        <div class="container">
            <div class="mb-5">
                <header class="grid place-items-center grid-cols-6 gap-y-10" itemscope
                    itemtype="https://schema.org/CollectionPage">
                    <div class="ps-15 section-heading sm:col-span-4 w-full col-span-6 relative space-y-3">
                        <h2 class="font-black text-2xl">
                            <span itemprop="name" class="dark:text-white">جدیدترین</span>
                            <span class="text-primary font-bold">محصولات</span>
                        </h2>
                        <p class="text-neutral-600 dark:text-white" itemprop="description">پربازدیدترین محصولات</p>
                    </div>


                </header>
            </div>
        </div>
        <div
            class="relative before:absolute before:w-full before:top-20 before:h-[320px] before:bg-gradient-to-b before:from-secondary-500 before:to-transparent before:right-0 before:left-0">
            <div class="container">
                <div class="swiper !px-2.3 product-carousel">
                    <div class="swiper-wrapper items-center" style="padding-bottom: 0 !important;">
                        {{--product&label=product&var=product&count=10 --}}
                        @isset($product['data'])
                            @foreach ($product['data'] as $content)
                                <div class="swiper-slide px-1.5 py-2">
                                    <article
                                        class="bg-white product-box-item drop-shadow-md rounded-xl p-4 dark:bg-card-dark dark:border-white dark:border-1"
                                        >

                                        <figure class="flex image justify-center my-4">
                                            <a href="{{ $content->slug }}" >
                                                <img class="one-image"
                                                    src="{{ image_or_placeholder($content->images['images']['small']) }}"
                                                    loading="lazy" alt="{{ $content->title }}" >
                                                @foreach ($content->gallery as $gallery)

                                                    <img class="two-image"
                                                        src="{{ image_or_placeholder($gallery->images['images']['small']) }}"
                                                        loading="lazy">
                                                @endforeach
                                            </a>
                                        </figure>
                                        <h3 class="text-base leading-8  line-clamp-2 mb-2">
                                            <a href="{{ $content->slug }}" class="text-gray-800 dark:text-white"  >{{ $content->title }}</a>
                                        </h3>

                                    </article>
                                </div>
                            @endforeach
                        @endisset

                    </div>
                    <div class="swiper-button-next bg-white rounded-full dark:bg-zinc-800 border border-gray-200 !size-12 after:!text-xl px-3 after:text-primary"
                        aria-label="اسلاید بعدی"></div>
                    <div class="swiper-button-prev bg-white rounded-full dark:bg-zinc-800 border border-gray-200 !size-12 after:!text-xl px-3 after:text-primary"
                        aria-label="اسلاید قبلی"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================= end product section ================= -->



    <!-- ================= start product group section ================= -->
    <section class="py-5 mt-6" itemscope itemtype="https://schema.org/ItemList">
        <div class="container">
            <div class="mb-5">
                <header class="grid place-items-center grid-cols-6 gap-y-10">
                    <div class="ps-15 section-heading sm:col-span-4 w-full col-span-6 relative space-y-3">
                        <h2 class="font-black text-2xl">
                            <span itemprop="name" class="dark:text-white">آخرین</span>
                            <span class="text-primary font-bold">بازید ها</span>
                        </h2>
                        <p class="text-neutral-600 dark:text-white" itemprop="description">بر اساس آخرین فعالیت های شما</p>
                    </div>

                </header>
            </div>
        </div>
        <div class="container">
            <section>
                <div class="grid grid-cols-12 gap-4 place-items-center">

                    <section class="sm:col-span-6 xl:col-span-3 col-span-12 w-full" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ProductCategory">
                        <div class="grid gap-4 grid-cols-2 place-items-center">
                            <div
                                class="col-span-1 border-gray-200 border h-42 space-y-2 text-center shadow-md w-full rounded-lg bg-gray-200 py-4 p-3 dark:bg-zinc-800">
                                <h3 class="font-bold text-lg line-clamp-1 dark:text-white" itemprop="name">انواع سیم</h3>
                                <p class="text-neutral-600 text-xs line-clamp-1 dark:text-neutral-400">بر اساس بازید های شما
                                </p>
                                <img src="/it-times-store/assets/images/product/انواع-سیم.png" class="size-20 block mx-auto"
                                    alt=" انواع سیم" itemprop="image">
                            </div>

                            {{--product&label=sim&var=sim&count=3 --}}
                            @isset($sim['data'])
                                @foreach ($sim['data'] as $content)
                                    <div
                                        class="col-span-1 border-gray-200 border group relative flex items-center justify-center h-42 space-y-2 text-center shadow-md w-full rounded-lg bg-white py-4 p-3 dark:bg-background-dark">
                                        <a href="{{ $content->slug }}" itemprop="url">
                                            <img src="{{ image_or_placeholder($content->images['images']['small']) }}"
                                                class="size-25 block mx-auto" alt="{{ $content->title }}" itemprop="image">
                                            <span
                                                class="absolute text-nowrap z-10 left-1/2 mr-2 -top-3 -translate-x-1/2
                                                                                                                        hidden group-hover:block bg-gray-900 text-white text-sm py-1 px-2 rounded-md shadow-lg">
                                                <span
                                                    class="absolute left-1/2 -bottom-[10px] rotate-[90deg]
                                                                                                                        -translate-y-1/2 w-0 h-0 border-y-4 border-y-transparent border-l-4
                                                                                                                        border-l-gray-900"></span>
                                                {{ $content->title }}
                                            </span>
                                            </span>
                                        </a>
                                    </div>
                                @endforeach
                            @endisset

                            <div class="col-span-2 w-full">
                                <a href="/سیم-ها"
                                    class="flex items-center bg-white shadow-md p-3 rounded-lg justify-between w-full dark:bg-zinc-700"
                                    itemprop="url">
                                    <span class="dark:text-white">مشاهده همه</span>
                                    <span class="bg-primary rounded-lg p-1 rounded-tl-3xl rounded-bl-3xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 19.5 8.25 12l7.5-7.5" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </section>

                    <section class="sm:col-span-6 xl:col-span-3 col-span-12 w-full" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ProductCategory">
                        <div class="grid gap-4 grid-cols-2 place-items-center">
                            <div
                                class="col-span-1 border-gray-200 border h-42 space-y-2 text-center shadow-md w-full rounded-lg bg-gray-200 py-4 p-3 dark:bg-zinc-800">
                                <h3 class="font-bold text-lg line-clamp-1 dark:text-white" itemprop="name">انواع کانکتور
                                </h3>
                                <p class="text-neutral-600 text-xs line-clamp-1 dark:text-neutral-400">بر اساس بازید های شما
                                </p>
                                <img src="/it-times-store/assets/images/product/انواع-کانکتور.png"
                                    class="size-20 block mx-auto" alt="انواع کانکتور" itemprop="image">
                            </div>
                            {{--product&label=kanektor&var=kanektor&count=3 --}}
                            @isset($kanektor['data'])
                                @foreach ($kanektor['data'] as $content)
                                    <div
                                        class="col-span-1 border-gray-200 border group relative flex items-center justify-center h-42 space-y-2 text-center shadow-md w-full rounded-lg bg-white py-4 p-3 dark:bg-background-dark">
                                        <a href="{{ $content->slug }}" itemprop="url">
                                            <img src="{{ image_or_placeholder($content->images['images']['small']) }}"
                                                class="size-25 block mx-auto" alt="{{ $content->title }}" itemprop="image">
                                            <span
                                                class="absolute text-nowrap z-10 left-1/2 mr-2 -top-3 -translate-x-1/2
                                                                                                                        hidden group-hover:block bg-gray-900 text-white text-sm py-1 px-2 rounded-md shadow-lg">
                                                <span
                                                    class="absolute left-1/2 -bottom-[10px] rotate-[90deg]
                                                                                                                        -translate-y-1/2 w-0 h-0 border-y-4 border-y-transparent border-l-4
                                                                                                                        border-l-gray-900"></span>
                                                {{ $content->title }}
                                            </span>
                                            </span>
                                        </a>
                                    </div>
                                @endforeach
                            @endisset
                            <div class="col-span-2 w-full">
                                <a href="/کانکتور-و-تبدیل"
                                    class="flex items-center bg-white shadow-md p-3 rounded-lg justify-between w-full dark:bg-zinc-700"
                                    itemprop="url">
                                    <span class="dark:text-white">مشاهده همه</span>
                                    <span class="bg-primary rounded-lg p-1 rounded-tl-3xl rounded-bl-3xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 19.5 8.25 12l7.5-7.5" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </section>

                    <section class="sm:col-span-6 xl:col-span-3 col-span-12 w-full" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ProductCategory">
                        <div class="grid gap-4 grid-cols-2 place-items-center">
                            <div
                                class="col-span-1 border-gray-200 border h-42 space-y-2 text-center shadow-md w-full rounded-lg bg-gray-200 py-4 p-3 dark:bg-zinc-800">
                                <h3 class="font-bold text-lg line-clamp-1 dark:text-white" itemprop="name">انواع کابل</h3>
                                <p class="text-neutral-600 text-xs line-clamp-1 dark:text-neutral-400">بر اساس بازید های شما
                                </p>
                                <img src="/it-times-store/assets/images/product/انواع-کابل.png"
                                    class="size-20 block mx-auto" alt=" انواع کابل" itemprop="image">
                            </div>
                            {{--product&label=cable&var=cable&count=3 --}}
                            @isset($cable['data'])
                                @foreach ($cable['data'] as $content)
                                    <div
                                        class="col-span-1 border-gray-200 border group relative flex items-center justify-center h-42 space-y-2 text-center shadow-md w-full rounded-lg bg-white py-4 p-3 dark:bg-background-dark">
                                        <a href="{{ $content->slug }}" itemprop="url">
                                            <img src="{{ image_or_placeholder($content->images['images']['small']) }}"
                                                class="size-25 block mx-auto" alt="{{ $content->title }}" itemprop="image">
                                            <span
                                                class="absolute text-nowrap z-10 left-1/2 mr-2 -top-3 -translate-x-1/2
                                                                                                                        hidden group-hover:block bg-gray-900 text-white text-sm py-1 px-2 rounded-md shadow-lg">
                                                <span
                                                    class="absolute left-1/2 -bottom-[10px] rotate-[90deg]
                                                                                                                        -translate-y-1/2 w-0 h-0 border-y-4 border-y-transparent border-l-4
                                                                                                                        border-l-gray-900"></span>
                                                {{ $content->title }}
                                            </span>
                                            </span>
                                        </a>
                                    </div>
                                @endforeach
                            @endisset
                            <div class="col-span-2 w-full">
                                <a href="/کابل"
                                    class="flex items-center bg-white shadow-md p-3 rounded-lg justify-between w-full dark:bg-zinc-700"
                                    itemprop="url">
                                    <span class="dark:text-white">مشاهده همه</span>
                                    <span class="bg-primary rounded-lg p-1 rounded-tl-3xl rounded-bl-3xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 19.5 8.25 12l7.5-7.5" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </section>

                    <section class="sm:col-span-6 xl:col-span-3 col-span-12 w-full" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ProductCategory">
                        <div class="grid gap-4 grid-cols-2 place-items-center">
                            <div
                                class="col-span-1 border-gray-200 border h-42 space-y-2 text-center shadow-md w-full rounded-lg bg-gray-200 py-4 p-3 dark:bg-zinc-800">
                                <h3 class="font-bold text-lg line-clamp-1 dark:text-white" itemprop="name">کانکتور
                                    نظامی</h3>
                                <p class="text-neutral-600 text-xs line-clamp-1 dark:text-neutral-400">بر اساس بازید های شما
                                </p>
                                <img src="/it-times-store/assets/images/product/تجهیزات-الکترونیکی.png"
                                    class="size-20 block mx-auto" alt="تجهیزات الکترونیکی " itemprop="image">
                            </div>
                            {{--product&label=electronic&var=electronic&count=3 --}}
                            @isset($electronic['data'])
                                @foreach ($electronic['data'] as $content)
                                    <div
                                        class="col-span-1 border-gray-200 border group relative flex items-center justify-center h-42 space-y-2 text-center shadow-md w-full rounded-lg bg-white py-4 p-3 dark:bg-background-dark">
                                        <a href="{{ $content->slug }}" itemprop="url">
                                            <img src="{{ image_or_placeholder($content->images['images']['small']) }}"
                                                class="size-25 block mx-auto" alt="{{ $content->title }}" itemprop="image">
                                            <span
                                                class="absolute text-nowrap z-10 left-1/2 mr-2 -top-3 -translate-x-1/2
                                                                                                                        hidden group-hover:block bg-gray-900 text-white text-sm py-1 px-2 rounded-md shadow-lg">
                                                <span
                                                    class="absolute left-1/2 -bottom-[10px] rotate-[90deg]
                                                                                                                        -translate-y-1/2 w-0 h-0 border-y-4 border-y-transparent border-l-4
                                                                                                                        border-l-gray-900"></span>
                                                {{ $content->title }}
                                            </span>
                                            </span>
                                        </a>
                                    </div>
                                @endforeach
                            @endisset
                            <div class="col-span-2 w-full">
                                <a href="/کانکتور-نظامی"
                                    class="flex items-center bg-white shadow-md p-3 rounded-lg justify-between w-full dark:bg-zinc-700"
                                    itemprop="url">
                                    <span class="dark:text-white">مشاهده همه</span>
                                    <span class="bg-primary rounded-lg p-1 rounded-tl-3xl rounded-bl-3xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 19.5 8.25 12l7.5-7.5" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </section>
    <!-- ================= end product group section ================= -->





    <!-- ================= start product list section ================= -->
    <section class="py-5" itemscope itemtype="https://schema.org/ItemList">
        <div class="container">
            <div class="mb-5">
                <header class="grid place-items-center grid-cols-6 gap-y-10">
                    <div class="ps-15 section-heading sm:col-span-4 w-full col-span-6 relative space-y-3">
                        <h2 class="font-black text-2xl">
                            <span itemprop="name" class="dark:text-white">پرپازدید ترین</span>
                            <span class="text-primary font-bold">محصولات</span>
                        </h2>
                        <p class="text-neutral-600 dark:text-white" itemprop="description">آخرین محصولات پر بازدید هفته</p>
                    </div>

                </header>
            </div>
            <div class="swiper !px-2.3 product-list-carousel">
                <div class="swiper-wrapper items-center" style="padding-bottom: 0 !important;">
                    <div class="swiper-slide space-y-3 px-1.5 py-2" >

                        {{--product&label=popular&var=popular&count=15 --}}
                        @isset($popular['data'])
                            @foreach ($popular['data'] as $content)

                                <a href="{{ $content->slug }}" class="w-full block" >
                                    <article
                                        class="flex py-2 px-3 rounded-xl hover:bg-gray-200 transition border border-gray-200 bg-white drop-shadow-md items-center justify-between dark:bg-background-dark dark:hover:bg-zinc-600">
                                        <section class="w-1/6 border-l-2 border-gray-300">
                                            <div class="text-center">
                                                <span class="font-bold text-3xl text-primary ">{{ $content->viewCount }}</span>
                                            </div>
                                        </section>
                                        <section class="w-3/6 space-y-2 pr-3">
                                            <h3
                                                class="font-bold leading-loose line-clamp-2 h-13 text-xs dark:text-white">{{ $content->title }}</h3>
                                        </section>
                                        <figure class="w-2/6"  itemscope itemtype="https://schema.org/ImageObject">
                                            <div class="text-end flex justify-end">
                                                <img src="{{ image_or_placeholder($content->images['images']['small']) }}" class="size-20"
                                                    loading="lazy" alt="{{ $content->title }}"
                                                    >
                                                <meta content="{{ $content->title }}">
                                            </div>
                                        </figure>
                                    </article>
                                </a>

                                @if($loop->iteration % 3 == 0 && !$loop->last)
                                    </div>
                                    <div class="swiper-slide space-y-3 px-1.5 py-2" >
                                @endif
                            @endforeach
                        @endisset


                </div>
            </div>
            <div class="swiper-button-next bg-white rounded-full dark:bg-zinc-800 border border-gray-200 !size-12 after:!text-xl px-3 after:text-primary"
                aria-label="اسلاید بعدی"></div>
            <div class="swiper-button-prev bg-white rounded-full dark:bg-zinc-800 border border-gray-200 !size-12 after:!text-xl px-3 after:text-primary"
                aria-label="اسلاید قبلی"></div>
        </div>
        </div>
    </section>
    <!-- ================= end product list section ================= -->








    <!-- ================= start banner section ================= -->
    <section class="py-5" aria-label="تبلیغات ویژه" itemscope itemtype="https://schema.org/ItemList" id="advertisementsTwo">
        <h2 class="sr-only" >تبلیغات و پیشنهادات ویژه</h2>
        <div class="container">
            <div class="lg:col-span-1 col-span-2"  itemscope
                itemtype="https://schema.org/Promotion" itemid="#summer-promo">
                <a href="https://it-times-store.com/" aria-label="مشاهده پیشنهادات تابستانی" >
                    <img src="/it-times-store/assets/images/slider/slider-2-3.jpg"
                        class="rounded-lg transition block duration-300 hover:-translate-y-2"
                        alt="تابستانه ویژه - تا ۵۰% تخفیف روی محصولات منتخب" loading="lazy" >
                    </div>
                </a>
            </div>
        </div>
    </section>
    <!-- ================= end banner section ================= -->





    <!-- ================= start blog section ================= -->
    <section class="py-5" itemscope itemtype="https://schema.org/ItemList">
        <div class="container">
            <div class="mb-5">
                <header class="grid place-items-center grid-cols-6 gap-y-10">
                    <div class="ps-15 section-heading sm:col-span-4 w-full col-span-6 relative space-y-3">
                        <h2 class="font-black text-2xl">
                            <span itemprop="name" class="dark:text-white">آخرین</span>
                            <span class="text-primary font-bold">مقالات</span>
                        </h2>

                    </div>
                    <div class="w-full sm:col-span-2 col-span-6">
                        <div class="sm:text-end text-start">
                            <a href="/بلاگ"
                                class="btn bg-transparent border-secondary border-2 hover:bg-secondary hover:text-white dark:text-white dark:border-white"
                                title="مشاهده تمامی محصولات پر بازدید" itemprop="url">
                                مشاهده همه
                            </a>
                        </div>
                    </div>
                </header>
            </div>
            <div class="swiper !px-2.3 blog-carousel">
                <div class="swiper-wrapper items-center" style="padding-bottom: 0 !important;">

                    {{--post&label=articles&var=articles&count=5 --}}
                    @isset($articles['data'])
                        @foreach ($articles['data'] as $content)
                            <div class="swiper-slide space-y-3 px-1.5 py-2" itemprop="itemListElement" itemscope
                                itemtype="https://schema.org/BlogPosting">
                                <a href="{{ $content->slug }}" class="w-full block" itemprop="url">
                                    <article
                                        class="p-4 space-y-3 rounded-xl hover:-translate-y-2 transition border border-gray-200 bg-white drop-shadow-md dark:bg-background-dark">
                                        <figure class="text-center block py-4" itemprop="image" itemscope
                                            itemtype="https://schema.org/ImageObject">
                                            <img src="{{ image_or_placeholder($content->images['images']['medium']) }}"
                                                class="h-50 rounded-xl w-full block mx-auto object-cover"
                                                alt="تصویر راهنمای خرید موبایل" itemprop="contentUrl">
                                            <meta itemprop="caption" content="تصویر راهنمای خرید موبایل">
                                        </figure>
                                        <section class="space-y-5">
                                            <div class="space-y-4">
                                                <h4
                                                    class="relative before:right-0 before:z-[-1] before:rounded-lg before:bg-gray-300 before:absolute before:top-1/2 before:h-px before:w-full before:-translate-y-1/2">
                                                    <span class="bg-secondary text-sm rounded text-white px-3 dark:bg-secondary-300"
                                                        itemprop="articleSection">{{ $content->category['title'] }}</span>
                                                </h4>
                                                <h2 class="text-xl line-clamp-1 font-bold dark:text-white" itemprop="headline">
                                                    {{ $content->title }}
                                                </h2>
                                            </div>
                                            <div class="flex mt-8 flex-wrap justify-between items-center">
                                                <div class="flex items-center" itemprop="datePublished" content="2024-03-02">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <time
                                                        class="mr-2 dark:text-white">{{ convertGToJ($content->publish_date) }}</time>
                                                </div>
                                                <div class="flex items-center" itemprop="interactionStatistic" itemscope
                                                    itemtype="https://schema.org/InteractionCounter">
                                                    <meta itemprop="interactionType" content="https://schema.org/WatchAction">
                                                    <meta itemprop="userInteractionCount" content="128">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                    <time class="mr-2 dark:text-white">{{ $content->viewCount }} بازدید</time>
                                                </div>
                                            </div>
                                        </section>
                                    </article>
                                </a>
                            </div>

                        @endforeach
                    @endisset
                </div>
                <div class="swiper-button-next bg-white rounded-full dark:bg-zinc-800 border border-gray-200 !size-12 after:!text-xl px-3 after:text-primary"
                    aria-label="اسلاید بعدی"></div>
                <div class="swiper-button-prev bg-white rounded-full dark:bg-zinc-800 border border-gray-200 !size-12 after:!text-xl px-3 after:text-primary"
                    aria-label="اسلاید قبلی"></div>
            </div>
        </div>
    </section>
    <!-- ================= end blog section ================= -->






@endsection

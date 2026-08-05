<!-- ================= start footer section ================= -->
<section class="py-5 dark:text-white dark:bg-background-dark bg-white drop-shadow-md border-t border-gray-200" itemscope
    itemtype="http://schema.org/WPFooter">
    <div class="container">
        <!-- Logo and Back to Top -->
        <div class="grid gap-4 grid-cols-4 place-items-center" itemscope itemtype="http://schema.org/Organization">
            <div class="sm:col-span-3 col-span-2 w-full">
                <a href="/" itemprop="url">
                    <figure itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                        <img src="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }}" class="h-12"
                            alt="لوگوی  عصر آی تی" itemprop="contentUrl">
                        <meta itemprop="caption" content="لوگوی رسمی فروشگاه عصر آی تی">
                    </figure>
                </a>
            </div>
            <div class="sm:col-span-1 col-span-2 w-full">
                <div class="text-left">
                    <a href="#top" class="inline-flex border px-4 py-1.5 item-center justify-between rounded-lg"
                        aria-label="بازگشت به بالای صفحه">
                        <span>بازگشت بالا</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 ms-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <!-- Contact Information -->
        <div class="flex my-10 items-start flex-wrap space-y-4 space-x-4 divide-x-2  sm:divide-neutral-600 divide-transparent"
            itemscope itemtype="http://schema.org/ContactPoint">
            <div class="space-x-3 pl-2" itemprop="contactOption" itemscope itemtype="http://schema.org/ContactPoint">
                <span class="inline-block">شماره تماس:</span>
                <a class="inline-block" href="tel:02166740231" itemprop="telephone">021-66740231</a>
                <a class="inline-block" href="tel:02166740232" itemprop="telephone">021-66740232</a>
                <a class="inline-block" href="tel:02166740447" itemprop="telephone">021-66740447 </a>
                <a class="inline-block" href="tel:02166740172" itemprop="telephone">021-66740172 </a>
                <a class="inline-block" href="tel:09128210151" itemprop="telephone">09128210151</a>
            </div>
            <div class="space-x-3 pl-2">
                <meta itemprop="hoursAvailable" content="Mo-Su,00:00-23:59">
                <span class="inline-block">پاساژ امجد طبقه ۳ پلاک۱۶ فروشگاه عصر آی تی</span>
            </div>
        </div>
        <!-- Menu Columns -->
        <div class="grid gap-4 grid-cols-4 place-items-start">
            <div class="lg:col-span-1 sm:col-span-2 col-span-4 w-full">
                <h4 class="font-bold text-lg mb-5" aria-label="فروشگاه ">فروشگاه</h4>
                <ul class="space-y-4 mt-1" role="menu">
                    <li role="menuitem"><a href="/سیم-نسوز">سیم نسوز </a></li>
                    <li role="menuitem"><a href="/سیم-افشان-مس">سیم افشان </a></li>
                    <li role="menuitem"><a href="/سیم-AWG">سیم AWG </a></li>
                </ul>
            </div>
            <div class="lg:col-span-1 sm:col-span-2 col-span-4 w-full">
                <ul class="space-y-4 mt-1" role="menu">
                    <li><a href="/کابل-کواکسیال">کابل کواکسیال </a></li>
                    <li><a href="/کابل-فلت">کابل فلت </a></li>
                    <li><a href="/کابل-رابط">کابل رابط </a></li>
                    <li><a href="/کابل-فیبر-نوری">کابل فیبر نوری </a></li>
                </ul>
            </div>
            <div class="lg:col-span-1 sm:col-span-2 col-span-4 w-full">
                <ul class="space-y-4 mt-1" role="menu">
                    <li><a href="/کانکتور-کواکسیال">کانکتور کواکسیال </a></li>
                    <li><a href="/کانکتور-برق">کانکتور برق </a></li>
                    <li><a href="/کانکتور-شبکه">کانکتور شبکه</a></li>
                    <li><a href="/کانکتور-و-تبدیل">انواع سوکت و کانکتور</a></li>
                </ul>
            </div>
            <div class="lg:col-span-1 sm:col-span-2 col-span-4 w-full">
                <h4 class="font-bold text-lg mb-5" aria-label="شبکه‌های اجتماعی">رسانه های خبری ما</h4>
                <ul class="flex items-center space-x-4" role="list">
                    <li role="listitem"><a href="https://instagram.com/it_times_store" itemprop="sameAs"><img
                                src="{{ asset('assets/images/social/instagram.svg') }}" alt="اینستاگرام"
                                class="size-7"></a></li>
                    <li role="listitem"><a href="https://wa.me/qr/EUCOPSQ2AOEYH1" itemprop="sameAs"><img
                                src="{{ asset('assets/images/social/whatsapp.svg') }}" alt="آپارات" class="size-7"></a>
                    </li>

                </ul>
            </div>
        </div>
        <!-- Application Download -->
        <div class="grid gap-4 bg-primary-grad no-hover px-4 py-5 rounded-xl mt-5 grid-cols-4 place-items-center">
            <div class="lg:col-span-2 col-span-4 w-full">
                <h4 class="font-bold text-xl text-white">تضمین کیفیت محصولات توسط فروشگاه عصر آی تی</h4>
            </div>
            <div class="lg:col-span-2 col-span-4 w-full">
                <ul class="flex items-center justify-end space-x-3">
                    <li>
                        <a href="/محصولات" class="bg-white h-full block p-3 rounded-lg">
                            مشاهده محصولات
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Description & Trust Seals -->
        <div class="grid gap-4 grid-cols-4 mt-10">
            <div class="lg:col-span-3 col-span-4" itemprop="description">
                <h5 class="font-bold mb-5">فروشگاه اینترنتی عصر آی تی، بررسی، انتخاب و خرید آنلاین</h5>
                <p class="text-neutral-600 dark:text-white leading-9">
                    عصر آی تی با سال ها تجربه در زمینه واردات و تولید کالاهای الکترونیکی از جمله سیم ، کابل ، رابط و
                    تبدیل می باشد. این فروشگاه در پاساژ امجد مشغول به فعالیت بوده و عرضه کننده مستقیم و بدون واسط
                    کالای الکترونیکی به خریدار می باشد.
                </p>
            </div>

        </div>
        <!-- Copyright -->
        <div class="grid gap-4 grid-cols-4 mt-10">
            <div class="lg:col-span-3 col-span-4">
                <p class="text-neutral-500 dark:text-white leading-9" itemprop="copyrightNotice">
                    استفاده از مطالب فروشگاه اینترنتی عصر آی تی فقط با ذکر منبع بلامانع است.
                    <span itemprop="copyrightYear">2006-2025</span> کلیه حقوق این سایت متعلق به
                    <span itemprop="copyrightHolder" itemscope itemtype="http://schema.org/Organization">
                        <span itemprop="name">عصر آی تی</span>
                    </span> می‌باشد.
                </p>
            </div>
            <div class="lg:col-span-1 col-span-4">
                <p class="text-neutral-500 dark:text-white sm:text-end text-center leading-9">
                    طراحی و توسعه توسط
                    <a href="https://dingweb.ir" itemprop="author">DingWeb</a>
                </p>
            </div>
        </div>
    </div>
</section>
<!-- ================= end footer section ================= -->






<!-- ================= start filter modal ================= -->
<div id="filterModal" role="dialog" aria-modal="true" aria-labelledby="filterModalTitle" data-modal-id="filterModal"
    class="modal hidden fixed inset-0 z-50 overflow-auto backdrop-blur bg-opacity-50">
    <div class="relative p-4 w-full max-w-md m-auto flex items-center min-h-screen">
        <div class="relative dark:bg-background-dark border-gray-300 border bg-white rounded-lg shadow-lg w-full"
            itemscope itemtype="http://schema.org/Place">
            <!-- Header -->
            <div class="flex justify-between items-center p-4 dark:border-b-white border-b">
                <h3 id="filterModalTitle" class="text-xl  dark:text-white" itemprop="name">فیلتر بر اساس شهر</h3>
                <button data-modal-close class="text-gray-500 hover:text-gray-700 cursor-pointer text-3xl"
                    aria-label="بستن پنجره فیلتر">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 dark:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Content -->
            <div class="p-4">
                <!-- Cities Data -->
                <meta itemprop="address"
                    content="تهران,مشهد,اصفهان,تبریز,شیراز,اهواز,قم,کرج,کرمانشاه,ارومیه,زاهدان,رشت,همدان,یزد,اردبیل,بندرعباس,کیش,ساری,گرگان,بجنورد">
                <div id="citySelector"
                    data-cities="تهران,مشهد,اصفهان,تبریز,شیراز,اهواز,قم,کرج,کرمانشاه,ارومیه,زاهدان,رشت,همدان,یزد,اردبیل,بندرعباس,کیش,ساری,گرگان,بجنورد">
                </div>
                <!-- Search Form -->
                <form id="searchForm" class="mb-2" role="search">
                    <label for="search" class="mb-2 block text-sm font-medium dark:text-white text-gray-900">
                        جستجوی شهر
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" focusable="false"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="search"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary dark:bg-background-dark dark:text-white"
                            placeholder="نام شهر را وارد کنید" aria-describedby="searchDescription" required>
                    </div>
                    <p id="searchDescription" class="sr-only">برای جستجو در بین شهرهای موجود تایپ کنید</p>
                </form>
                <!-- Selected Cities -->
                <div id="selectedCities" class="flex my-3 flex-wrap gap-2" role="status" aria-live="polite"></div>
                <!-- Cities List -->
                <ul id="cityList"
                    class="w-full h-80 overflow-y-auto text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    role="listbox" aria-labelledby="filterModalTitle">
                    <template id="cityTemplate">
                        <li role="option" class="p-3 border-b cursor-pointer hover:bg-gray-100" tabindex="0"
                            itemprop="containsPlace" itemscope itemtype="http://schema.org/City">
                            <span itemprop="name"></span>
                        </li>
                    </template>
                </ul>
                <!-- Filter Button -->
                <div class="mt-4">
                    <button id="filterButton"
                        class="w-full px-4 py-3 cursor-pointer bg-primary text-white rounded-lg hover:bg-primary-600 transition-colors"
                        aria-label="اعمال فیلتر بر اساس شهرهای انتخاب شده">
                        فیلتر کن
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ================= end filter modal ================= -->





<!-- ================= start responsive menu offcanvas ================= -->
<div id="offcanvas-right"
    class="offcanvas invisible overflow-y-scroll fixed top-0 right-0 sm:w-100 w-[80%] h-full bg-white dark:bg-background-dark shadow-lg transform -translate-x-full transition-transform opacity-0 z-50"
    role="navigation" aria-labelledby="store-menu-title" aria-modal="true">
    <div class="border-b p-3 flex items-center justify-between border-gray-400">
        <h2 id="store-menu-title" class="font-bold text-base dark:text-white">فروشگاه عصر آی تی</h2>
        <button onclick="closeOffcanvas()" class="cursor-pointer" aria-label="بستن منوی فروشگاه">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <nav class="relative space-y-4 divide-y divide-gray-200 p-3 overflow-y-scroll h-full"
        style="padding-left: 0!important;" aria-label="منوی اصلی">
        <ul class="space-y-2 text-sm">
            <li class="bg-ul-f7 border border-gray-100 dark:bg-zinc-800 dark:text-white p-2" itemscope
                itemtype="http://schema.org/SiteNavigationElement">
                <a href="/" class="block" itemprop="url">صفحه اصلی</a>
            </li>


            <!-- 1 -->
            @if (isset($mainMenu))


                @foreach ($mainMenu as $menuItem)
                    <li class="bg-ul-f7 border border-gray-100 dark:bg-zinc-800 dark:text-white p-2" itemscope
                        itemtype="http://schema.org/SiteNavigationElement">



                        <button class="flex justify-between w-full text-right" aria-expanded="false" aria-controls="menu1"
                            id="menu{{ $loop->index }}-button" onclick="toggleDropdown('menu{{ $loop->index }}')">
                            <span itemprop="name">
                                <a href="{{ $menuItem['link'] }}">{{ $menuItem['label'] }}</a>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform transform"
                                id="icon-menu{{ $loop->index }}" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>




                        <ul id="menu{{ $loop->index }}" class="hidden bg-gray-200 dark:bg-background-dark dark:text-white"
                            role="menu" aria-labelledby="menu{{ $loop->index }}-button">


                            <!-- 2 -->
                            @foreach ($menuItem->children as $menuItem2)
                                <li class="border-b border-gray-300" itemscope itemtype="http://schema.org/SiteNavigationElement">
                                    <button class="flex justify-between w-full px-6 py-2 text-right" aria-expanded="false"
                                        aria-controls="submenu{{ $loop->index }}" id="submenu{{ $loop->index }}-button"
                                        onclick="toggleDropdown('submenu{{ $loop->index }}')">
                                        <span itemprop="name">
                                            <a href="{{ $menuItem2['link'] }}">{{ $menuItem2['label'] }}</a>

                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform transform"
                                            id="icon-submenu{{ $loop->index }}" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <ul id="submenu{{ $loop->index }}"
                                        class="hidden bg-gray-100 dark:bg-zinc-500 dark:text-gray-200" role="menu"
                                        aria-labelledby="submenu{{ $loop->index }}-button" itemscope
                                        itemtype="http://schema.org/Brand">

                                        <!-- 3 -->
                                        @foreach ($menuItem2->children as $menuItem3)
                                            <li class="px-8 py-2 border-b border-gray-200" itemprop="name">
                                                <a href="{{ $menuItem3['link'] }}">{{ $menuItem3['label'] }}</a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            @endif


        </ul>
    </nav>
</div>
<div class="overlay z-40 transition fixed inset-0 bg-black/70 hidden" onclick="closeOffcanvas()" role="presentation"
    aria-hidden="true"></div>
<!-- ================= end responsive menu offcanvas ================= -->

<!-- ================= start nav mobile menu ================= -->
<nav
    class="fixed shadow-xl border-t-zinc-300 dark:border-0 bottom-0 z-20 lg:hidden left-0 right-0 dark:bg-background-dark dark:text-white bg-white border-t border-gray-200">
    <div class="flex justify-around items-center flex-row py-3 px-4">
        <!-- Home -->
        <a href="/" class="flex flex-col items-center text-primary space-y-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 dark:text-primary">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="text-xs font-bold">خانه</span>
        </a>
        <!-- cart -->
        <a href="/بلاگ" class="flex flex-col items-center text-gray-500 hover:text-gray-700 space-y-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z">
                </path>
            </svg>
            <span class="text-xs dark:text-white">بلاگ</span>
        </a>
        <!-- Profile -->
        <a href="/درباره-ما" class="flex flex-col items-center text-gray-500 hover:text-gray-700 space-y-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z">
                </path>
            </svg>
            <span class="text-xs dark:text-white">درباره ما</span>
        </a>
        <!-- Profile -->
        <a href="/تماس-با-ما" class="flex flex-col items-center text-gray-500 hover:text-gray-700 space-y-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z">
                </path>
            </svg>
            <span class="text-xs dark:text-white">تماس با ما</span>
        </a>
        <!-- Top -->
        <a href="#" class="flex flex-col items-center text-gray-500 hover:text-gray-700 space-y-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
            </svg>
            <span class="text-xs dark:text-white">رفتن به بالا</span>
        </a>
    </div>
</nav>
<!-- ================= end nav mobile menu ================= -->





@stack('scripts')

@yield('footer')

<script>
    var TEMPLATE_NAME = `{{ env('TEMPLATE_NAME') }}`;
</script>
{{--
<script src="{{ url('/main.js') }}"></script> --}}
@if (WebsiteSetting::where('variable', '=', 'phone')->first()?->value != '')
    <a href="tel:{{ WebsiteSetting::where('variable', '=', 'phone')->first()->value }}" id="callnowbutton"></a>
    <script>
        document.getElementById('callnowbutton').addEventListener('click', function () {
            gtag('event', 'call_button', {
                event_category: 'Contact',
                event_label: 'Call Button',
                value: 1
            });
        });
    </script>
@endif



<script src="{{ asset('assets/js/plugin/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/dependencies/swiper-script.js')}}"></script>
<script src="{{ asset('assets/js/dependencies/app.js')}}"></script>

</body>

</html>

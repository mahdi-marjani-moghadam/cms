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
                </ul>
            </div>
            <div class="lg:col-span-1 sm:col-span-2 col-span-4 w-full">
            <ul class="space-y-4 mt-1" role="menu">
                    <li role="menuitem"><a href="/سیم-نسوز">سیم نسوز </a></li>
                    <li role="menuitem"><a href="/سیم-سیلیکونی">سیم سیلیکونی </a></li>
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
                        <a href="" class="bg-white h-full block p-3 rounded-lg">
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



<!-- ================= start cart offcanvas ================= -->
<!-- Offcanvas Cart -->
<div id="offcanvas-left"
    class="offcanvas invisible dark:bg-background-dark dark:text-white fixed top-0 left-0 sm:w-100 w-[80%] h-full bg-white shadow-lg transform -translate-x-full transition-transform opacity-0 z-50"
    role="dialog" aria-labelledby="cart-title" aria-modal="true">
    <!-- Header -->
    <header class="border-b p-3 flex items-center justify-between border-gray-400">
        <h2 id="cart-title" class="font-bold text-base">سبد خرید شما</h2>
        <button onclick="closeOffcanvas()" class="cursor-pointer" aria-label="بستن سبد خرید">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </header>
    <!-- Cart Items -->
    <main class="relative space-y-4 divide-y divide-gray-200 p-3 overflow-y-scroll h-full">
        <!-- Product 1 -->
        <div class="py-3 last:mb-35" itemscope itemtype="http://schema.org/Product">
            <div class="flex flex-wrap items-center">
                <div class="text-right w-1/3">
                    <img class="max-w-full" src="/it-times-store/assets/images/product/wach-1.png"
                        alt="ساعت مچی عقربه‌ای مردانه اینویکتا مدل Automatico Ghost Reserve" itemprop="image"
                        loading="lazy">
                </div>
                <div class="w-2/3 space-y-4">
                    <h3 class="font-bold leading-7" itemprop="name">
                        ساعت مچی عقربه‌ای مردانه اینویکتا مدل Automatico Ghost Reserve
                    </h3>
                    <div class="flex items-center justify-between">
                        <del class="text-rose-600 dark:text-white line-through" itemprop="priceCurrency" content="IRR">
                            <span itemprop="highPrice">5,000,000</span>
                        </del>
                        <ins class="no-underline text-xl text-green-600 font-bold" itemprop="price" content="2500000">
                            2,500,000 <span class="text-sm font-normal text-gray-700 dark:text-white">تومان</span>
                        </ins>
                    </div>
                    <div class="flex items-end justify-between">
                        <span itemprop="quantity">تعداد: 3</span>
                        <a href="#"
                            class="bg-red-100 dark:border dark:bg-transparent dark:text-white text-red-950 p-2 rounded-lg"
                            role="button" aria-label="حذف محصول از سبد خرید">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer
        class="p-2 absolute bottom-0 right-0 left-0 bg-white dark:border-0  dark:bg-background-dark border border-gray-400">
        <div class="flex items-center justify-between">
            <div class="space-y-2">
                <span class="inline-block text-lg">جمع کل</span>
                <h3 class="font-bold text-xl" itemprop="totalPrice" content="11000000">
                    11,000,000 تومان
                </h3>
            </div>
            <div class="text-end">
                <a href="/checkout" class="bg-primary-grad hover:bg-primary-600 text-white py-2 px-4 rounded-lg"
                    role="button" aria-label="تکمیل فرایند خرید">
                    تکمیل خرید
                </a>
            </div>
        </div>
    </footer>
</div>
<!-- Overlay -->
<div class="overlay transition fixed inset-0 z-40 bg-black/70 hidden" onclick="closeOffcanvas()" role="presentation"
    aria-hidden="true"></div>
<!-- ================= end cart offcanvas ================= -->






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



        </ul>
    </nav>
</div>
<div class="overlay z-40 transition fixed inset-0 bg-black/70 hidden" onclick="closeOffcanvas()" role="presentation"
    aria-hidden="true"></div>
<!-- ================= end responsive menu offcanvas ================= -->

<!-- ================= start nav mobile menu ================= -->
<nav
    class="fixed shadow-xl border-t-zinc-300 dark:border-0 bottom-0 z-20 lg:hidden left-0 right-0 dark:bg-background-dark dark:text-white bg-white border-t border-gray-200">
    <div class="flex justify-around items-center flex-row-reverse py-3 px-4">
        <!-- Home -->
        <a href="#" class="flex flex-col items-center text-primary space-y-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 dark:text-primary">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="text-xs font-bold">خانه</span>
        </a>
        <!-- cart -->
        <a href="#" class="flex flex-col items-center text-gray-500 hover:text-gray-700 space-y-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
            <span class="text-xs dark:text-white">سبد خرید</span>
        </a>
        <!-- Profile -->
        <a href="#" class="flex flex-col items-center text-gray-500 hover:text-gray-700 space-y-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <span class="text-xs dark:text-white">پنل کاربری</span>
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

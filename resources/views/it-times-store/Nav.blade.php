<!-- ================= start header ================= -->
<header id="topHeader"
    class="py-3 dark:shadow-primary-600 dark:shadow dark:bg-background-dark sticky top-0 right-0 left-0 z-20 shadow-md bg-white">
    <div class="container">
        <!-- row top header -->
        <div class="grid place-items-center gap-3 grid-cols-12">
            <!-- respnsive menu -->
            <div class="lg:hidden col-span-4 w-full">
                <a href="javascript:void(0)" onclick="toggleOffcanvas('offcanvas-right')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 dark:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                    </svg>
                </a>
            </div>
            <!-- logo -->
            <div class="lg:col-span-2 lg:order-1 order-2 col-span-4 w-full">
                <a href="/">
                    <div class="lg:text-start text-center">
                        <img class="md:h-12" src="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }}" loading="lazy"
                            alt="">
                    </div>
                </a>
            </div>
            <!-- search and filter -->
            <div class="lg:col-span-6 lg:block lg:order-2 order-4 hidden col-span-4 w-full">
                <div class="flex items-center">
                    <!-- search -->
                    <form action="{{ route('search') }}" class="relative flex items-center w-full">
                        <input type="search" name="q" value="{{ app('request')->q }}"
                            class="w-full appearance-none dark:text-white rounded-3xl  border border-gray-300 py-3 pr-18 px-3 dark:placeholder-gray-400"
                            placeholder="جستجوی محصولات ....">
                        <button class="bg-primary-grad  p-2 text-white rounded-3xl absolute right-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </form>

                </div>
            </div>
            <!-- login and basket and call and darkmode -->
            <div class="lg:col-span-4 col-span-4 order-3 w-full">
                <div class="flex items-baseline justify-end">
                    <!-- basket and call and darkmode -->
                    <div class="flex items-baseline md:me-5 me-2">
                        <!-- call -->
                        <a href="tel:02166740231" class="lg:block hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                        </a>

                        <!-- dark mode -->
                        <div class="md:ms-5 ms-2">
                            <button id="dark-mode-toggle">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="lg:size-8 size-6 dark:block hidden dark:text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="lg:size-8 size-6 dark:hidden block dark:text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- mega menu -->
        <div id="megaMenu" class="xl:grid hidden relative grid-cols-12 place-items-center">
            <div class="col-span-10 place-self-start">
                <nav class="flex gap-x-9 mt-10 items-center">
                    <!-- menu -->
                    <ul class="flex dark:text-white items-center space-x-8 tracking-tight">
                        <li id="mega-menu-fire" class="py-2">
                            <a href="" class="flex font-bold hover:text-primary transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 me-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                فروشگاه
                            </a>
                            <div id="mega-menu-fire-target"
                                class="bg-white dark:bg-background-dark container z-50 hidden top-[90%] drop-shadow-sm absolute mt-1 ml-10 shadow-md rounded-b-md">
                                <div class="grid grid-cols-12">
                                    <div class="col-span-2 h-[400px] overflow-y-scroll border-l border-gray-400">
                                        <ul class="my-2 space-y-1">


                                            <!-- main menu -->
                                            @foreach ($mainMenu as $menuItem)

                                                <li data-mega-id="{{ $loop->index + 1 }}"
                                                    class="px-4 w-full hover:bg-opacity-70 border-opacity-0 hover:border-opacity-100 rounded-lg dark:hover:text-zinc-950 mega-menu-li">
                                                    <a href="{{ url($menuItem['link']) }}"
                                                        class="flex items-center justify-between py-3">
                                                        <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <div class="mr-1">
                                                                <p class="text-xs">{{ $menuItem['label'] }}</p>
                                                            </div>
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 19l-7-7 7-7" />
                                                        </svg>
                                                    </a>
                                                </li>

                                            @endforeach
                                            <!-- end main menu -->

                                        </ul>
                                    </div>
                                    <div class="col-span-10 bg-white dark:bg-background-dark">

                                        <!-- main menu -->
                                        @foreach ($mainMenu as $menuItem)
                                            <div data-mega-target="{{ $loop->index + 1 }}"
                                                class="grid {{ ($loop->first) ? '' : 'hidden' }} h-[400px] overflow-y-scroll grid-cols-8 gap-10 m-3">

                                                <!-- sub menu 1 -->
                                                @foreach ($menuItem->children as $subMenuItem)

                                                    <div class="col-span-2">
                                                        <div class="mb-4">
                                                            <p class="text-sm font-bold">
                                                                <a
                                                                    href="{{ in_array($subMenuItem['type'], ['internal', 'external']) ? url($subMenuItem['link']) : '/#' . $subMenuItem['link'] }}">{{ $subMenuItem['label'] }}</a>
                                                            </p>


                                                            <div class="mt-3 space-y-4">

                                                                <!-- sub menu 2 -->
                                                                @foreach ($subMenuItem->children as $subMenuItem2)
                                                                    <a href="{{ $subMenuItem2['link'] }}"
                                                                        class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">
                                                                        {{ $subMenuItem2['label'] }}</a>
                                                                @endforeach
                                                                <!-- end sub menu 2 -->

                                                            </div>
                                                        </div>
                                                    </div>





                                                @endforeach
                                                <!-- end sub menu 1 -->
                                            </div>
                                        @endforeach
                                        <!-- end main menu -->





                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="py-2">
                            <a href="/" class="flex space-x-3 hover:text-primary transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                <span>صفحه اصلی</span>
                            </a>
                        </li>

                        <li class="py-2">
                            <a href="/بلاگ" class="flex space-x-3 hover:text-primary transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                                </svg>
                                <span>بلاگ</span>
                            </a>
                        </li>
                        <li class="py-2">
                            <a href="/درباره-ما" class="flex space-x-3 hover:text-primary transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z">
                                    </path>
                                </svg>
                                <span>درباره ما</span>
                            </a>
                        </li>
                        <li class="py-2">
                            <a href="/تماس-با-ما" class="flex space-x-3 hover:text-primary transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                </svg>
                                <span>تماس با ما</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</header>
<!-- ================= end header ================= -->

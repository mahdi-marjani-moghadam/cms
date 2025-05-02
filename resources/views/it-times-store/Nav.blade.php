<div class="top-menu">
    <header class='border-b py-1 px-1 lg:px-5  bg-white  min-h-[50px] max-w-[1200px] m-auto'>
        <div class='flex flex-wrap items-center lg:gap-y-2 gap-y-4 gap-x-4 '>
            <a href="/" class="">
                <img height="44" width="44" alt=" ایدن لوگو" class="inline-block"
                    srcset="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }} 1x, {{ url(env('TEMPLATE_NAME') . '/img/logo2x.png') }} 2x"
                    src="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }}" />
            </a>
            <div class='flex items-center mr-auto lg:order-1'>
                <button id="toggle" class='lg:hidden mr-7'>
                    <svg class="w-7 h-7" fill="#333" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>




            <ul id="collapseMenu"
                class=' lg:!flex lg:mr-10 lg:space-x-6 lg:space-x-reverse max-lg:space-y-2 max-lg:hidden max-lg:w-full max-lg:my-4'>
                @foreach (App\Models\Menu::where('parent', '=', '0')->orderBy('sort')->get() as $menuItem)
                <?php $subMenu = App\Models\Menu::where('menu', '=', '1')
                    ->where('parent', '=', $menuItem['id'])
                    ->orderBy('sort')
                    ->get(); ?>
                @if (count($subMenu))
                <li class='max-lg:border-b max-lg:py-2 md:mb-0 relative parent group'>
                    <a href="{{ url($menuItem['link']) }}"
                        class='lg:hover:text-yellow-600 text-gray-600 block pr-5 font-bold  lg:group-hover:ul md:ml-5'>
                        <i class="arrow top-2 down left-10 md:left-1  border-gray-400"></i>{{ $menuItem['label'] }}
                    </a>


                    <ul
                        class="hidden submenu  md:rounded-2xl md:shadow-xl border bg-gray-50 md:grid-cols-3 md:gap-2 md:p-4 md:w-[600px] lg:group-hover:block ">
                        @foreach ($subMenu as $subMenuItem)

                        <?php $subMenu2 = App\Models\Menu::where('menu', '=', '1')
                            ->where('parent', '=', $subMenuItem['id'])
                            ->orderBy('sort')
                            ->get(); ?>
                        @if (count($subMenu2))
                        <li class="parent2 relative  border-b last:border-b-0">
                            <a class="lg:hover:text-yellow-600 border-b text-gray-600 block   py-2 pr-10 md:px-5"
                                href="{{ in_array($subMenuItem['type'], ['internal', 'external']) ? url($subMenuItem['link']) : '/#' . $subMenuItem['link'] }}">

                                <i
                                    class="arrow top-4 left-10 md:left-4 max-sm:rotate-45 md:rotate-[135deg] border-gray-400"></i>

                                {{ $subMenuItem['label'] }}
                            </a>


                            <ul class="hidden submenu2 md:shadow-xl bg-gray-100 border md:absolute !top-0 md:right-[100%] z-20 md:rounded-2xl">
                                @foreach ($subMenu2 as $subMenuItem2)

                                <?php $subMenu3 = App\Models\Menu::where('menu', '=', '1')
                                    ->where('parent', '=', $subMenuItem2['id'])
                                    ->orderBy('sort')
                                    ->get(); ?>
                                @if (count($subMenu3))
                                <li class="parent3 border-b last:border-b-0">
                                    <a href="{{ url($subMenuItem2['link']) }}"
                                        class='lg:hover:text-yellow-600 text-gray-600 block font-bold py-2 pr-16 md:px-5   md:ml-5'>
                                        <i
                                            class="arrow top-4 left-10 md:left-4 max-sm:rotate-45 md:rotate-[135deg] border-gray-400"></i>
                                        {{ $subMenuItem2['label'] }}
                                    </a>
                                    <ul class="hidden submenu3 md:shadow-xl bg-gray-100 border md:absolute !top-0 md:right-[100%] z-20 md:rounded-2xl">
                                        @foreach ($subMenu3 as $subMenuItem3)
                                        <li class="border-b last:border-b-0">
                                            <a href="{{ url($subMenuItem3['link']) }}"
                                                class='lg:hover:text-yellow-600 text-gray-600 block font-bold py-2 pr-16 md:px-5   md:ml-5'>
                                                {{ $subMenuItem3['label'] }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @else
                                <li class=" border-b last:border-b-0">
                                    <a class="lg:hover:text-yellow-600 text-gray-600 block   py-2 pr-20 md:px-5"
                                        href="{{ in_array($subMenuItem2['type'], ['internal', 'external']) ? url($subMenuItem2['link']) : '/#' . $subMenuItem2['link'] }}">

                                        {{ $subMenuItem2['label'] }}
                                    </a>
                                </li>
                                @endif
                                @endforeach
                                <li class="lg:hidden">
                                    <a class="text-yellow-600  block font-bold pr-20"
                                        href="{{ url($subMenuItem['link']) }}">همه محصولات
                                        {{ $subMenuItem['label'] }}</a>

                                </li>
                            </ul>
                        </li>
                        @else
                        <li class=" relative  border-b last:border-b-0">
                            <a class="lg:hover:text-yellow-600 text-gray-600 block  py-2 pr-10 md:px-2"
                                href="{{ in_array($subMenuItem['type'], ['internal', 'external']) ? url($subMenuItem['link']) : '/#' . $subMenuItem['link'] }}">
                                {{ $subMenuItem['label'] }}
                            </a>
                        </li>
                        @endif
                        @endforeach
                        <li class="lg:hidden">
                            <a class="text-yellow-600  block font-bold pr-10"
                                href="{{ url($menuItem['link']) }}">همه محصولات
                                {{ $menuItem['label'] }}</a>

                        </li>
                    </ul>
                </li>
                @else
                <li class='max-lg:border-b max-lg:py-2 md:mb-0'>
                    <a href='{{ in_array($menuItem['type'], ['internal', 'external']) ? url($menuItem['link']) : '/#' . $menuItem['link'] }}'
                        class='lg:hover:text-yellow-600 text-gray-600 pr-5 block font-bold '>{{ $menuItem['label'] }}</a>
                </li>
                @endif
                @endforeach


            </ul>
        </div>
    </header>

    <script src="{{ url('/it-times-store/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script>
        var toggleBtn = document.getElementById('toggle');
        var collapseMenu = document.getElementById('collapseMenu');

        function handleClick() {
            if (collapseMenu.style.display === 'block') {
                collapseMenu.style.display = 'none';
            } else {
                collapseMenu.style.display = 'block';
            }
        }

        toggleBtn.addEventListener('click', handleClick);



        $(document).ready(function() {
            if ($(window).width() <= 1023) {
                $('.parent > a, .parent2 > a, .parent3 > a ').attr('href', '#')

                $(".parent > a").click(function() {
                    $(this).next(".submenu").toggleClass("hidden");
                });
                $(".parent2 > a").click(function() {
                    $(this).next(".submenu2").toggleClass("hidden");
                });
                $(".parent3 > a").click(function() {
                    $(this).next(".submenu3").toggleClass("hidden");
                });
            } else {
                $(".parent").hover(function() {
                    $(this).find(".submenu").addClass("hover");
                }, function() {
                    $(this).find(".submenu").removeClass("hover");
                });

                $(".parent2").hover(function() {
                    $(this).find(".submenu2").addClass("hover");
                }, function() {
                    $(this).find(".submenu2").removeClass("hover");
                });

                $(".parent3").hover(function() {
                    $(this).find(".submenu3").addClass("hover");
                }, function() {
                    $(this).find(".submenu3").removeClass("hover");
                });
            }
        });
    </script>
</div>




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
                            <img alt=" ایدن لوگو" class="md:h-12" src="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }}" loading="lazy" alt="">
                        </div>
                    </a>
                </div>


                <!-- search and filter -->
                <div class="lg:col-span-6 lg:block lg:order-2 order-4 hidden col-span-4 w-full">
                    <div class="flex items-center">
                        <!-- search -->
                        <div class="relative flex items-center w-full">
                            <input type="search"
                                class="w-full appearance-none dark:text-white rounded-3xl  border border-gray-300 py-3 pr-18 px-3 dark:placeholder-gray-400"
                                placeholder="جستجوی محصولات ....">
                            <button class="bg-primary-grad  p-2 text-white rounded-3xl absolute right-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </button>
                        </div>

                    </div>
                </div>





                <!-- login and basket and call and darkmode -->
                <div class="lg:col-span-4 col-span-4 order-3 w-full">
                    <div class="flex items-baseline justify-end">
                        <!-- basket and call and darkmode -->
                        <div class="flex items-baseline md:me-5 me-2">
                            <!-- call -->
                            <a href="" class="lg:block hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
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
                                                <li data-mega-id="1"
                                                    class="px-4 w-full hover:bg-opacity-70 border-opacity-0 hover:border-opacity-100 rounded-lg dark:hover:text-zinc-950 mega-menu-li">
                                                    <a href="#" class="flex items-center justify-between py-3">
                                                        <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <div class="mr-1">
                                                                <p class="text-xs">محصولات دیجیتال</p>
                                                            </div>
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-5 w-5 text-gray-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 19l-7-7 7-7" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li data-mega-id="2"
                                                    class="px-4 w-full hover:bg-opacity-70 border-opacity-0 hover:border-opacity-100 rounded-lg dark:hover:text-zinc-950 mega-menu-li">
                                                    <a href="#" class="flex items-center justify-between py-3">
                                                        <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <div class="mr-1">
                                                                <p class="text-xs">اکسسوری</p>
                                                            </div>
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-5 w-5 text-gray-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 19l-7-7 7-7" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li data-mega-id="3"
                                                    class="px-4 w-full hover:bg-opacity-70 border-opacity-0 hover:border-opacity-100 rounded-lg dark:hover:text-zinc-950 mega-menu-li">
                                                    <a href="#" class="flex items-center justify-between py-3">
                                                        <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <div class="mr-1">
                                                                <p class="text-xs">خانه و آشپز خانه</p>
                                                            </div>
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-5 w-5 text-gray-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 19l-7-7 7-7" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li data-mega-id="4"
                                                    class="px-4 w-full hover:bg-opacity-70 border-opacity-0 hover:border-opacity-100 rounded-lg dark:hover:text-zinc-950 mega-menu-li">
                                                    <a href="#" class="flex items-center justify-between py-3">
                                                        <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <div class="mr-1">
                                                                <p class="text-xs">آرایشی بهداشتی</p>
                                                            </div>
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-5 w-5 text-gray-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 19l-7-7 7-7" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li data-mega-id="5"
                                                    class="px-4 w-full hover:bg-opacity-70 border-opacity-0 hover:border-opacity-100 rounded-lg dark:hover:text-zinc-950 mega-menu-li">
                                                    <a href="#" class="flex items-center justify-between py-3">
                                                        <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <div class="mr-1">
                                                                <p class="text-xs">خودرو و موتور سیکلت</p>
                                                            </div>
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-5 w-5 text-gray-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 19l-7-7 7-7" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li data-mega-id="6"
                                                    class="px-4 w-full hover:bg-opacity-70 border-opacity-0 hover:border-opacity-100 rounded-lg dark:hover:text-zinc-950 mega-menu-li">
                                                    <a href="#" class="flex items-center justify-between py-3">
                                                        <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <div class="mr-1">
                                                                <p class="text-xs">لوازم خانگی برقی</p>
                                                            </div>
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-5 w-5 text-gray-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 19l-7-7 7-7" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li data-mega-id="7"
                                                    class="px-4 w-full hover:bg-opacity-70 border-opacity-0 hover:border-opacity-100 rounded-lg dark:hover:text-zinc-950 mega-menu-li">
                                                    <a href="#" class="flex items-center justify-between py-3">
                                                        <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <div class="mr-1">
                                                                <p class="text-xs">ابزار آلات و تجهیزات</p>
                                                            </div>
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-5 w-5 text-gray-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 19l-7-7 7-7" />
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li data-mega-id="8"
                                                    class="px-4 w-full hover:bg-opacity-70 border-opacity-0 hover:border-opacity-100 rounded-lg dark:hover:text-zinc-950 mega-menu-li">
                                                    <a href="#" class="flex items-center justify-between py-3">
                                                        <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <div class="mr-1">
                                                                <p class="text-xs">مد و پوشاک</p>
                                                            </div>
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-5 w-5 text-gray-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 19l-7-7 7-7" />
                                                        </svg>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-span-10 bg-white dark:bg-background-dark">
                                            <div data-mega-target="1"
                                                class="grid h-[400px] overflow-y-scroll grid-cols-8 gap-10 m-3">
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">گوشی موبایل</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">گوشی
                                                                موبایل هوشمند</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">گوشی‌های
                                                                اقتصادی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لپ‌تاپ</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">لپ‌تاپ‌های
                                                                گیمینگ</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">لپ‌تاپ‌های
                                                                اداری</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">تبلت</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">تبلت‌های
                                                                اندروید</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">تبلت‌های
                                                                آی‌پد</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لوازم جانبی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">هدفون</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">شارژر
                                                                و کابل</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کیف
                                                                لپ‌تاپ</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">دوربین دیجیتال</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دوربین
                                                                عکاسی حرفه‌ای</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دوربین‌های
                                                                ورزشی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">پخش‌کننده‌های موسیقی</p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">کالاهای صوتی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">اسپیکر
                                                                بلوتوثی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">هدفون
                                                                بی‌سیم</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">کنسول بازی</p>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">کنسول بازی</p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">کالاهای دیجیتال خانه</p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">کیف لپ‌تاپ و لوازم جانبی</p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لوازم جانبی بازی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کنترلر
                                                                بازی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">هدست
                                                                بازی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">باتری و شارژر</p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">فیلتر و لوازم جانبی</p>
                                                    </div>
                                                </div>
                                                <!-- menu thumbnail banner -->
                                                <div class="col-span-2">
                                                    <div class="ml-4">
                                                        <a href="">
                                                            <img src="it-times-store/assets/images/banner/banner-1.webp" loading="lazy"
                                                                alt="" class="w-full rounded-lg">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-mega-target="2"
                                                class="grid hidden h-[400px] overflow-y-scroll grid-cols-8 gap-10 m-3">
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">گردنبند</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">گردنبند
                                                                طلا</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">گردنبند
                                                                نقره</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">دستبند</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دستبند
                                                                چرمی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دستبند
                                                                طلا</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">ساعت مچی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ساعت
                                                                مچی مردانه</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ساعت
                                                                مچی زنانه</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">گوشواره</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">گوشواره
                                                                طلایی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">گوشواره
                                                                نقره‌ای</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">کمربند</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کمربند
                                                                چرمی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کمربند
                                                                پارچه‌ای</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">کیف</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کیف
                                                                دستی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کیف
                                                                دوشی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">عینک آفتابی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">عینک
                                                                آفتابی مردانه</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">عینک
                                                                آفتابی زنانه</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">کلاه</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کلاه
                                                                کپ</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کلاه
                                                                بیسبالی</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">کیف پول</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کیف
                                                                پول چرمی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کیف
                                                                پول مردانه</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">کفش</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کفش
                                                                راحتی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کفش
                                                                ورزشی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">شال و روسری</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">شال‌های
                                                                نخی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">روسری‌های
                                                                ابریشمی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">دستکش</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دستکش
                                                                چرم</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دستکش
                                                                زمستانی</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- menu thumbnail banner -->
                                                <div class="col-span-2">
                                                    <div class="ml-4">
                                                        <a href="">
                                                            <img src="it-times-store/assets/images/banner/banner-4.webp" loading="lazy"
                                                                alt="" class="w-full rounded-lg">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-mega-target="3"
                                                class="grid hidden h-[400px] overflow-y-scroll grid-cols-8 gap-10 m-3">
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">ظروف پخت و پز</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ماهیتابه</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">قابلمه</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">ظروف سرو و پذیرایی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">بشقاب
                                                                و کاسه</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">سرویس
                                                                قاشق و چنگال</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لوازم برقی آشپزخانه</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">مایکروویو</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">چای‌ساز
                                                                و قهوه‌ساز</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">سرو و نگهداری غذا</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ظروف
                                                                نگهداری غذا</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کلمن
                                                                و
                                                                فلاسک</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لوازم دکوری منزل</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">تابلو
                                                                و دیوارکوب</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">گلدان
                                                                و گل مصنوعی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">شمع و عود</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">شمع‌های
                                                                تزیینی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">عود
                                                                معطر</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">فرش و قالیچه</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">فرش
                                                                ماشینی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">قالیچه</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">سرویس خواب</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">روتختی
                                                                و ملحفه</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">بالش
                                                                و
                                                                کوسن</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لوازم حمام و سرویس بهداشتی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">پرده
                                                                حمام</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">حوله
                                                                و
                                                                پادری</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">پرده و کرکره</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">پرده
                                                                پارچه‌ای</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">پرده
                                                                زبرا</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">سطل زباله و لوازم نظافت</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">سطل
                                                                زباله آشپزخانه</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">لوازم
                                                                نظافت</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">سبد و نظم‌دهنده</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">سبد
                                                                لباس</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">نظم‌دهنده
                                                                کشو</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- menu thumbnail banner -->
                                                <div class="col-span-2">
                                                    <div class="ml-4">
                                                        <a href="">
                                                            <img src="it-times-store/assets/images/banner/banner-3.webp" loading="lazy"
                                                                alt="" class="w-full rounded-lg">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-mega-target="4"
                                                class="grid hidden h-[400px] overflow-y-scroll grid-cols-8 gap-10 m-3">
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">مراقبت پوست</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کرم
                                                                مرطوب‌کننده</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">سرم
                                                                و
                                                                آبرسان</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">مراقبت مو</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">شامپو
                                                                و نرم‌کننده</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ماسک
                                                                و
                                                                روغن مو</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">بهداشت دهان و دندان</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">خمیردندان</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">مسواک
                                                                و نخ دندان</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">عطر و ادکلن</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ادکلن
                                                                مردانه</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ادکلن
                                                                زنانه</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لوازم آرایشی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کرم
                                                                پودر</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">رژ
                                                                لب</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">آرایش چشم</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ریمل</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">مداد
                                                                و
                                                                خط چشم</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">آرایش صورت</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">پنکک
                                                                و
                                                                پودر فیکس</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کانسیلر</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">آرایش ناخن</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">لاک
                                                                ناخن</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">پاک‌کننده
                                                                ناخن</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">ابزارهای آرایشی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">براش
                                                                و
                                                                پد آرایشی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">بیگودی
                                                                و فرمژه</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">مراقبت بدن</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">لوسیون
                                                                و کره بدن</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دئودورانت
                                                                و ضدتعریق</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لوازم اصلاح</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ژیلت
                                                                و
                                                                تیغ اصلاح</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">افترشیو
                                                                و ژل اصلاح</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">بهداشت شخصی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">نوار
                                                                بهداشتی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دستمال
                                                                مرطوب</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- menu thumbnail banner -->
                                                <div class="col-span-2">
                                                    <div class="ml-4">
                                                        <a href="">
                                                            <img src="it-times-store/assets/images/banner/banner-four-1.jpg"
                                                                loading="lazy" alt="" class="w-full rounded-lg">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-mega-target="5"
                                                class="grid hidden h-[400px] overflow-y-scroll grid-cols-8 gap-10 m-3">
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لوازم جانبی خودرو</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">روکش
                                                                صندلی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کف‌پوش
                                                                خودرو</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لوازم الکتریکی خودرو</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دزدگیر
                                                                و ردیاب</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">لامپ
                                                                و
                                                                روشنایی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">مراقبت و نظافت خودرو</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">واکس
                                                                و
                                                                پولیش</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">مایع
                                                                شیشه‌شوی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">تجهیزات ایمنی خودرو</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کپسول
                                                                آتش‌نشانی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">جعبه
                                                                کمک‌های اولیه</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لوازم یدکی خودرو</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">باتری
                                                                خودرو</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">فیلتر
                                                                روغن و هوا</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">روغن و روان‌کننده‌ها</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">روغن
                                                                موتور</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">گریس
                                                                و
                                                                مکمل سوخت</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">سیستم صوتی و تصویری</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">بلندگو
                                                                و ساب ووفر</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">مانیتور
                                                                خودرو</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">تجهیزات مسافرتی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">باربند
                                                                و نگهدارنده</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">چادر
                                                                خودرو</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لوازم جانبی موتور سیکلت</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کلاه
                                                                کاسکت</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دستکش
                                                                موتورسواری</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">قطعات یدکی موتور سیکلت</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">باتری
                                                                موتور</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">زنجیر
                                                                و چرخ دنده</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لوازم نگهداری موتور</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">روغن
                                                                موتور سیکلت</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">تمیزکننده
                                                                و براق‌کننده</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">تجهیزات ایمنی موتور</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">زانو
                                                                بند و محافظ</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">لباس
                                                                مخصوص موتورسواری</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- menu thumbnail banner -->
                                                <div class="col-span-2">
                                                    <div class="ml-4">
                                                        <a href="">
                                                            <img src="it-times-store/assets/images/banner/banner-four-3.jpg"
                                                                loading="lazy" alt="" class="w-full rounded-lg">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-mega-target="6"
                                                class="grid hidden h-[400px] overflow-y-scroll grid-cols-8 gap-10 m-3">
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">یخچال و فریزر</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">یخچال
                                                                دوقلو</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">فریزر
                                                                تک</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لباسشویی و ظرفشویی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ماشین
                                                                لباسشویی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ماشین
                                                                ظرفشویی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">مایکروویو و فر برقی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">مایکروویو</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">فر
                                                                برقی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">جاروبرقی و بخارشوی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">جاروبرقی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">بخارشوی</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">چای‌ساز و قهوه‌ساز</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">چای‌ساز</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">قهوه‌ساز</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">اتو و بخارگر</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">اتو
                                                                بخار</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">بخارگر
                                                                لباس</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">پنکه و تصفیه هوا</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">پنکه
                                                                رومیزی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دستگاه
                                                                تصفیه هوا</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">آب‌سردکن و تصفیه آب</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">آب‌سردکن</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دستگاه
                                                                تصفیه آب</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">غذاساز و مخلوط‌کن</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">غذاساز</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">مخلوط‌کن</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">همزن و آبمیوه‌گیری</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">همزن
                                                                برقی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">آبمیوه‌گیری</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">سرخ‌کن و پلوپز</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">سرخ‌کن
                                                                بدون روغن</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">پلوپز
                                                                دیجیتال</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">توستر و ساندویچ‌ساز</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">توستر
                                                                نان</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ساندویچ‌ساز</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- menu thumbnail banner -->
                                                <div class="col-span-2">
                                                    <div class="ml-4">
                                                        <a href="">
                                                            <img src="it-times-store/assets/images/banner/banner-four-4.jpg"
                                                                loading="lazy" alt="" class="w-full rounded-lg">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-mega-target="7"
                                                class="grid hidden h-[400px] overflow-y-scroll grid-cols-8 gap-10 m-3">
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">ابزار برقی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دریل
                                                                برقی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">فرز
                                                                و
                                                                سنگ فرز</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">ابزار دستی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">آچار
                                                                و
                                                                پیچ‌گوشتی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">چکش
                                                                و
                                                                انبر</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">متر و اندازه‌گیری</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">متر
                                                                لیزری</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">گونیا
                                                                و تراز</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">ابزار جوشکاری</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">اینورتر
                                                                جوشکاری</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">الکترود
                                                                و سیم جوش</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">کمپرسور و پمپ</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کمپرسور
                                                                باد</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">پمپ
                                                                آب
                                                                خانگی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لوازم ایمنی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کلاه
                                                                ایمنی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دستکش
                                                                کار</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لوازم کارگاهی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">میز
                                                                کار نجاری</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">اره
                                                                رومیزی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">نردبان و بالابر</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">نردبان
                                                                تلسکوپی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">بالابر
                                                                ساختمانی</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">چسب و مواد شیمیایی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">چسب
                                                                صنعتی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">رزین
                                                                و
                                                                اپوکسی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">اره و برش</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">اره
                                                                عمودبر</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کاتر
                                                                و
                                                                تیغ برش</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">موتور برق و ژنراتور</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">موتور
                                                                برق بنزینی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ژنراتور
                                                                دیزلی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">جعبه ابزار و کیف</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">جعبه
                                                                ابزار فلزی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کیف
                                                                ابزار حرفه‌ای</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- menu thumbnail banner -->
                                                <div class="col-span-2">
                                                    <div class="ml-4">
                                                        <a href="">
                                                            <img src="it-times-store/assets/images/banner/banner-11.jpg" loading="lazy"
                                                                alt="" class="w-full rounded-lg">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-mega-target="8"
                                                class="grid hidden h-[400px] overflow-y-scroll grid-cols-8 gap-10 m-3">
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لباس مردانه</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">پیراهن
                                                                مردانه</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کت
                                                                و
                                                                شلوار</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لباس زنانه</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">مانتو
                                                                و پالتو</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">لباس
                                                                مجلسی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لباس بچگانه</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">لباس
                                                                دخترانه</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">لباس
                                                                پسرانه</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">کفش</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کفش
                                                                رسمی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کفش
                                                                اسپرت</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">کیف و کوله</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کیف
                                                                دستی زنانه</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کوله‌پشتی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">اکسسوری</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">عینک
                                                                آفتابی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کمربند</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">شال و روسری</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">شال‌های
                                                                نخی</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">روسری‌های
                                                                ابریشمی</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">ساعت مچی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ساعت
                                                                مردانه</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ساعت
                                                                زنانه</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">جواهرات</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">گردنبند
                                                                طلا</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">دستبند
                                                                نقره</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لباس راحتی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">پیژامه</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">لباس
                                                                خواب</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">لباس ورزشی</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ست
                                                                ورزشی مردانه</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">ست
                                                                ورزشی زنانه</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-sm font-bold">کلاه</p>
                                                        <div class="mt-3 space-y-4">
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کلاه
                                                                کپ</a>
                                                            <a href="#"
                                                                class="text-xs text-gray-600 block hover:text-primary dark:text-gray-300">کلاه
                                                                زمستانی</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- menu thumbnail banner -->
                                                <div class="col-span-2">
                                                    <div class="ml-4">
                                                        <a href="">
                                                            <img src="it-times-store/assets/images/banner/banner-33.webp"
                                                                loading="lazy" alt="" class="w-full rounded-lg">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="py-2">
                                <a href="" class="flex space-x-3 hover:text-primary transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                    <span>صفحه اصلی</span>
                                </a>
                            </li>
                            <li class="py-2">
                                <a href="" class="flex space-x-3 hover:text-primary transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                    </svg>
                                    <span>لیست کالا ها</span>
                                </a>
                            </li>
                            <li class="py-2">
                                <a href="" class="flex space-x-3 hover:text-primary transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                                    </svg>
                                    <span>سوالی دارید</span>
                                </a>
                            </li>
                            <li class="py-2">
                                <a href="" class="flex space-x-3 hover:text-primary transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                    </svg>
                                    <span>پیگیری سفارش</span>
                                </a>
                            </li>
                            <li class="py-2">
                                <a href="" class="flex space-x-3 hover:text-primary transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                                    </svg>
                                    <span>بلاگ</span>
                                </a>
                            </li>
                            <li class="py-2">
                                <a href="" class="flex space-x-3 hover:text-primary transition">
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
                <div class="col-span-2 place-self-end place-items-center py-2">
                    <div
                        class="text-left dark:text-white before:animate-pulse before:w-22 before:h-1 before:bg-primary before:absolute before:left-1/2 relative before:-translate-x-1/2 before:-bottom-5 before:rounded-l">
                        <a href="">فروش ویژه</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- ================= end header ================= -->

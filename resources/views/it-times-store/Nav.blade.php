<div class="top-menu">
    <header class='border-b py-1 px-1 lg:px-5  bg-white  min-h-[50px] max-w-[1450px] m-auto'>
        <div class='flex flex-wrap items-center lg:gap-y-2 gap-y-4 gap-x-4 '>
            <a href="/" class="">
                <img height="60" width="44" alt=" ایدن لوگو" class="inline-block"
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
                class=' lg:!flex lg:mr-10 lg:space-x-8 lg:space-x-reverse max-lg:space-y-2 max-lg:hidden max-lg:w-full max-lg:my-4'>
                @foreach (App\Models\Menu::where('parent', '=', '0')->orderBy('sort')->get() as $menuItem)
                    <?php $subMenu = App\Models\Menu::where('menu', '=', '1')
                        ->where('parent', '=', $menuItem['id'])
                        ->orderBy('sort')
                        ->get(); ?>
                    @if (count($subMenu))
                        <li class='max-lg:border-b max-lg:py-2 md:mb-0 relative parent group'>
                            <a href="{{ url($menuItem['link']) }}"
                                class='lg:hover:text-yellow-600 text-gray-600 block pr-5 font-bold text-[15px] lg:group-hover:ul md:ml-5'>
                                <i class="arrow top-2 down left-10 md:left-1  border-gray-400"></i>{{ $menuItem['label'] }}
                            </a>


                            <ul
                                class="hidden submenu md:rounded-2xl md:shadow-xl border bg-gray-50 md:grid-cols-3 md:gap-4 md:p-4 md:w-[700px] lg:group-hover:block ">
                                @foreach ($subMenu as $subMenuItem)
                                    <li class="parent2 relative  border-b last:border-b-0">
                                        <?php $subMenu2 = App\Models\Menu::where('menu', '=', '1')
                                            ->where('parent', '=', $subMenuItem['id'])
                                            ->orderBy('sort')
                                            ->get(); ?>
                                        @if (count($subMenu2))
                                            <a class="lg:hover:text-yellow-600 border-b text-gray-600 block font-bold text-[15px] py-2 pr-10 md:px-5"
                                                href="{{ in_array($subMenuItem['type'], ['internal', 'external']) ? url($subMenuItem['link']) : '/#' . $subMenuItem['link'] }}">

                                                <i
                                                    class="arrow top-4 left-10 md:left-4 max-sm:rotate-45 md:rotate-[135deg] border-gray-400"></i>

                                                {{ $subMenuItem['label'] }}
                                            </a>


                                            <ul class="hidden submenu2 md:shadow-xl bg-gray-100 border md:absolute !top-0 md:right-[100%] z-20 md:rounded-2xl">
                                                @foreach ($subMenu2 as $subMenuItem2)
                                                    <li class="border-b last:border-b-0">
                                                        <a href="{{ url($subMenuItem2['link']) }}"
                                                            class='lg:hover:text-yellow-600 text-gray-600 block font-bold py-2 pr-16 md:px-5 text-[15px] lg:group-hover:ul md:ml-5'>
                                                            {{ $subMenuItem2['label'] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <a class="lg:hover:text-yellow-600 text-gray-600 block font-bold text-[15px] py-2 pr-10 md:px-5"
                                                href="{{ in_array($subMenuItem['type'], ['internal', 'external']) ? url($subMenuItem['link']) : '/#' . $subMenuItem['link'] }}">

                                                {{ $subMenuItem['label'] }}
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                                <li class="lg:hidden">
                                    <a class="text-yellow-600  block font-bold text-[15px]"
                                        href="{{ url($menuItem['link']) }}">همه محصولات
                                        {{ $menuItem['label'] }}</a>

                                </li>
                            </ul>
                        </li>
                    @else
                        <li class='max-lg:border-b max-lg:py-2 md:mb-0'>
                            <a href='{{ in_array($menuItem['type'], ['internal', 'external']) ? url($menuItem['link']) : '/#' . $menuItem['link'] }}'
                                class='lg:hover:text-yellow-600 text-gray-600 pr-5 block font-bold text-[15px]'>{{ $menuItem['label'] }}</a>
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
                $('.parent > a,.parent2 > a ').attr('href', '#')

                $(".parent > a").click(function() {
                    $(this).next(".submenu").toggleClass("hidden");
                });
                $(".parent2 > a").click(function() {
                    $(this).next(".submenu2").toggleClass("hidden");
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
            }
        });
    </script>
</div>





{{-- <div class="top-menu">
    <section class="p-0 m-0">
        <div class="">
            <nav class="top">
                <a href="/" class="brand">
                    <img height="64" width="64" alt=" کریپو لوگو"
                        srcset="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }} 1x, {{ url(env('TEMPLATE_NAME') . '/img/logo2x.png') }} 2x"
                        src="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }}" />
                </a>
                <span  class="white-space-nowrap px-1 ml-0 m-auto font-08 "></span>

                <input id="bmenu" type="checkbox" class="show">
                <label for="bmenu" class="burger toggle pseudo button">
                    <span class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </label>

                <div class="menu">
                    <ul>
                        @foreach (App\Models\Menu::where('parent', '=', '0')->orderBy('sort')->get() as $menuItem)
                            @php
                                $subMenu = App\Models\Menu::where('menu', '=', '1')
                                    ->where('parent', '=', $menuItem['id'])
                                    ->orderBy('sort')
                                ->get(); @endphp
                            @if (count($subMenu))

                                <li class="parent">
                                    <a href="{{ url($menuItem['link']) }}">{{ $menuItem['label'] }} </a>
                                    <div><i class="arrow down"></i></div>
                                    <ul class="mega">
                                        @foreach ($subMenu as $subMenuItem)

                                            @php
                                                $subMenu2 = App\Models\Menu::where('menu', '=', '1')
                                                    ->where('parent', '=', $subMenuItem['id'])
                                                    ->orderBy('sort')
                                                ->get(); @endphp

                                            @if (count($subMenu2))

                                                <li class="parent">
                                                    <a
                                                        href="{{ url($subMenuItem['link']) }}">{{ $subMenuItem['label'] }}</a>

                                                    <div><i class="arrow left"></i></div>
                                                    <ul>
                                                        @foreach ($subMenu2 as $subMenuItem2)
                                                            <li><a
                                                                    href="{{ in_array($subMenuItem2['type'], ['internal', 'external']) ? url($subMenuItem2['link']) : '/#' . url($subMenuItem2['link']) }}">
                                                                    {{ $subMenuItem2['label'] }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a
                                                        href="{{ in_array($subMenuItem['type'], ['internal', 'external']) ? url($subMenuItem['link']) : '/#' . url($subMenuItem['link']) }}">
                                                        {{ $subMenuItem['label'] }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li><a
                                        href="{{ in_array($menuItem['type'], ['internal', 'external']) ? url($menuItem['link']) : '/#' . url($menuItem['link']) }}">
                                        {{ $menuItem['label'] }}
                                    </a>
                                </li>

                            @endif

                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
    </section>
</div> --}}

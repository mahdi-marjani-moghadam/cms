<div class="top-menu">
    <div class="container">
        <nav>

            <a href="/" class="brand">
                <img height="41" width="115" alt=" کریپو لوگو"
                    srcset="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }} 1x, {{ url(env('TEMPLATE_NAME') . '/img/logo2x.png') }} 2x"
                    src="{{ url(env('TEMPLATE_NAME') . '/img/logo1x.png') }}" />
            </a>

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
                    <li>
                        <a class="flexbox">
                            <div class="search1">
                                <div>
                                    <input type="text" placeholder="جستجو" required>
                                </div>
                            </div>
                        </a>
                    </li>
                    @foreach (App\Models\Menu::where('parent', '=', '0')
        ->orderBy('sort')
        ->get()
    as $menuItem)
                        <?php $subMenu = App\Models\Menu::where('menu', '=', '1')
                        ->where('parent', '=', $menuItem['id'])
                        ->orderBy('sort')
                        ->get(); ?>
                        @if (count($subMenu))
                            <li class="parent"><a href="{{ $menuItem['link'] }}">{{ $menuItem['label'] }}</a>
                                <div><img width="16" height="16" alt="arrow-down"
                                        src="{{ asset('/img/arrow-down.png') }}"></div>
                                <ul>
                                    @foreach ($subMenu as $subMenuItem)
                                        <li><a
                                                href="{{ $subMenuItem['type'] == 'internal' || $subMenuItem['type'] == 'external' ? $subMenuItem['link'] : '/#' . $subMenuItem['link'] }}">{{ $subMenuItem['label'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li><a
                                    href="{{ $menuItem['type'] == 'internal' || $menuItem['type'] == 'external' ? $menuItem['link'] : '/#' . $menuItem['link'] }}">{{ $menuItem['label'] }}</a>
                            </li>

                        @endif

                    @endforeach

                </ul>
            </div>


        </nav>

    </div>

</div>

@extends(@env('TEMPLATE_NAME').'.App')

@section('head')

@endsection
@section('footer')

@endsection

@section('Content')




    <section class="index-item-top bg-green mt-0 mb-0">
        <div class="text-center">
            <h1>مرجع تخصصی اطلاعات درب </h1>
        </div>
        <div class="flex one five-500 center  ">
            {{--image&label=category&var=category --}}
            @isset($category['data'])
                @foreach ($category['data'] as $content)
                    <a href="{{ $content->slug }}">
                        <div class="shadow hover">
                            @if (isset($content->images['thumb']))
                                <figure class="image">
                                    <img src="{{ $content->images['images']['small'] ?? $content->images['thumb'] }}"
                                        sizes="(max-width:{{ env('CATEGORY_SMALL_W') }}px) 100vw {{ env('CATEGORY_SMALL_W') }}px {{ ENV('CATEGORY_MEDIUM_W') }}px {{ ENV('CATEGORY_LARGE_W') }}px"
                                        alt="{{ $content->title }}" width="200" height="200" srcset="
                                                {{ $content->images['images']['small'] ?? $content->images['thumb'] }} {{ env('CATEGORY_SMALL_W') }}w,
                                                {{ $content->images['images']['medium'] ?? $content->images['thumb'] }} {{ env('CATEGORY_MEDIUM_W') }}w,
                                                {{ $content->images['images']['large'] ?? $content->images['thumb'] }} 2x">
                                    <figcaption>
                                        <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>
                                    </figcaption>
                                </figure>
                            @else
                                <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>
                            @endif

                        </div>
                    </a>
                @endforeach
            @endisset
        </div>

        <div class="flex one five-500 center  ">
            @isset($category['data'])
                @foreach ($category['data'] as $content)
                    <a href="{{ $content->slug }}">
                        <div class="shadow hover">
                            @if (isset($content->images['thumb']))
                                <figure class="image">
                                    <img src="{{ $content->images['images']['small'] ?? $content->images['thumb'] }}"
                                        sizes="(max-width:{{ env('CATEGORY_SMALL_W') }}px) 100vw {{ env('CATEGORY_SMALL_W') }}px {{ ENV('CATEGORY_MEDIUM_W') }}px {{ ENV('CATEGORY_LARGE_W') }}px"
                                        alt="{{ $content->title }}" width="200" height="200" srcset="
                                                {{ $content->images['images']['small'] ?? $content->images['thumb'] }} {{ env('CATEGORY_SMALL_W') }}w,
                                                {{ $content->images['images']['medium'] ?? $content->images['thumb'] }} {{ env('CATEGORY_MEDIUM_W') }}w,
                                                {{ $content->images['images']['large'] ?? $content->images['thumb'] }} 2x">
                                    <figcaption>
                                        <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>
                                    </figcaption>
                                </figure>
                            @else
                                <h2 class="p-0 m-0 text-center"> {{ $content->title }}</h2>
                            @endif

                        </div>
                    </a>
                @endforeach
            @endisset
        </div>
    </section>



    <section>
        <h1>آزمایشگاه معتمد محیط زیست</h1>
محیط و صنعت ایمن پایش یکی از شرکت های دارای گواهینامه آزمایشگاه محیط زیست از سازمان محیط زیست می باشد. خدمات این شرکت در زمینه سنجش و آنالیز میزان آلودگی های هوا و صدا ، آب و پساب و خاک و پسماند می باشد.
آزمایشگاه های زیست محیطی برای مشاوران ، مدیران ، تنظیم کنندگان ، متخصصان بهداشت و ایمنی و تیم های تحقیقاتی در مراکز مختلف ضروری است. تکنسین های آزمایشگاهی برای شناسایی و تعیین کمیت مواد ، آزمایشات آزمایشگاهی را انجام می دهند. آزمایشگاه محیط زیست آلودگی هایی را که بر محیط زیست و سلامت انسان و حیات وحش تأثیر می گذارد ، آزمایش می کنند. این آزمایشات با پیشرفته ترین ابزار در آزمایشگاه ایمن پایش انجام می شود.
    </section>

    <section class="wide  m-0" >
        <div>خدمات درب کالا</div>
    </section>


    {{--#anchor topViewProduct --}}
    <section class="index-items home-top-view">
        <div class="flex one">
            <div>
                <div class="flex two two-500 three-700 six-900 center ">
                    {{--product&label=topViewPost&var=topViewPost&count=11 --}}
                    @isset($topViewPost['data'])
                        @foreach ($topViewPost['data'] as $content)
                            <div>
                                <a class="hover shadow2" href="{{ $content->slug }}">

                                    @if (isset($content->images['thumb']))
                                        <div><img alt="{{ $content->title }}"
                                                width="{{ env('PRODUCT_SMALL_W') }}" height="{{ env('PRODUCT_SMALL_H') }}"
                                                src="{{ $content->images['images']['small'] }}" srcset="
                                                {{ $content->images['images']['small'] }} 850w,
                                                {{ $content->images['images']['medium'] }} 1536w,
                                                {{ $content->images['images']['large'] }} 2880w
                                                    "
                                                    sizes="
                                                    (min-width:1366px) {{ env('PRODUCT_SMALL_W') }}px,
                                                    (min-width:1536px) {{ env('PRODUCT_MEDIUM_W') }}px,
                                                    (min-width:850px) {{ env('PRODUCT_LARGE_W') }}px
                                                    "
                                                    ></div>
                                    @endif
                                    <footer>
                                        <h3> {{ $content->title }}</h3>
                                        <div>
                                            <div class="rate">
                                                @if (count($content->comments))
                                                    @php
                                                        $rateAvrage = $rateSum = 0;
                                                    @endphp
                                                    @foreach ($content->comments as $comment)
                                                        @php
                                                            $rateSum = $rateSum + $comment['rate'];
                                                        @endphp
                                                    @endforeach
                                                    @for ($i = $rateSum / count($content->comments); $i >= 1; $i--)
                                                        <img width="20" height="20"
                                                            srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                                            src="{{ asset('/img/star1x.png') }}"
                                                            alt="{{ 'star for rating' }}">
                                                    @endfor
                                                @endif
                                            </div>
                                            @if (isset($content->attr['price']))
                                                @convertCurrency($content->attr['price']??0) تومان
                                            @endif
                                        </div>
                                    </footer>

                                </a>
                            </div>
                        @endforeach

                    @endisset
                </div>
            </div>
        </div>
    </section>


    <section class="index-items articles bg-gray2 home-top-view mb-0">
        <div class="flex one">
            <div>
                <h2>مقالات</h2>
                <div class="flex one two-500  three-800 center ">
                    {{--post&label=articles&var=articles&count=9 --}}
                    @isset($articles['data'])
                        @foreach ($articles['data'] as $content)
                            <div>
                                <a class="hover shadow2" href="{{ $content->slug }}">

                                    @if (isset($content->images['thumb']))
                                        <div><img width="{{ env('ARTICLE_SMALL_W') }}" height="{{ env('ARTICLE_SMALL_H') }}" src="{{ $content->images['thumb'] }}"></div>
                                    @endif
                                    <footer>
                                        <h3> {{ $content->title }}</h3>
                                    </footer>

                                </a>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </section>


    {{--#anchor footer --}}


@endsection

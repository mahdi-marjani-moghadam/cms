@extends(@env('TEMPLATE_NAME') . '.App')

@push('scripts')
    <script>
        // var slideIndex = 1;
        // showSlides(slideIndex);

        // function plusSlides(n) {
        //     showSlides(slideIndex += n);
        // }

        // function currentSlide(n) {
        //     showSlides(slideIndex = n);
        // }

        // function showSlides(n) {
        //     var i;
        //     var slides = document.getElementsByClassName("mySlides");
        //     var dots = document.getElementsByClassName("dot");
        //     if (n > slides.length) {
        //         slideIndex = 1
        //     }
        //     if (n < 1) {
        //         slideIndex = slides.length
        //     }
        //     for (i = 0; i < slides.length; i++) {
        //         slides[i].style.display = "none";
        //     }
        //     for (i = 0; i < dots.length; i++) {
        //         dots[i].className = dots[i].className.replace(" active", "");
        //     }
        //     slides[slideIndex - 1].style.display = "block";
        //     //dots[slideIndex - 1].className += " active";
        // }
    </script>

    <!-- <script src="{ { asset('/siema.min.js') }}"></script> -->
    <script>
        // var w;
        // var perPageNumber;

        // function perPage() {
        //     w = window.innerWidth;
        //     if (w <= 500) {
        //         perPageNumber = 1;
        //     } else if (w <= 768) {
        //         perPageNumber = 5;
        //     } else if (w <= 1024) {
        //         perPageNumber = 5;
        //     } else {
        //         perPageNumber = 7;
        //     }
        // }


        // document.getElementsByTagName("BODY")[0].onresize = function () {
        //     mySiema.destroy();
        //     perPage();
        //     mySiema.init();
        // };


        // perPage();
        // var mySiema = new Siema({
        //     selector: '.siema',
        //     duration: 200,
        //     easing: 'ease-out',
        //     perPage: perPageNumber,
        //     startIndex: 0,
        //     draggable: true,
        //     multipleDrag: true,
        //     threshold: 20,
        //     loop: false,
        //     rtl: true,
        //     onInit: () => { },
        //     onChange: () => {

        //     },
        // });
        // document.querySelector('.prev2').addEventListener('click', () => mySiema.prev());
        // document.querySelector('.next2').addEventListener('click', () => mySiema.next());
    </script>
@endpush

@section('Content')




<section class="bg-pink  mt-0 mb-0 pb-0">
    <div class="flex one ">
        <div class="text-center">
            <h1>جدیدترین وب سایت ها، مقالات، اپلیکیشن ها</h1>
            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-5 gap-1 mb-1 ">
                {{--post&label=topView&var=topViewPost&count=5 --}}
                @isset($topViewPost['data'])
                    @foreach ($topViewPost['data'] as $content)
                        <div class="">
                            <a href="{{ $content->slug }}">
                                <article class=" shadow2 flex flex-row justify-between">

                                    @if (isset($content->images['images']['medium']) && file_exists(public_path($content->images['images']['medium'])))
                                        <figure class="image flex-none max-sm:w-32  max-sm:pl-4 mt-0">
                                            <img loading="lazy" src="{{ $content->images['images']['medium'] }}"
                                                width="{{ env('ARTICLE_SMALL_W') }}" height="{{ env('ARTICLE_SMALL_H') }}"
                                                alt="{{ $content->title }}">
                                        </figure>
                                    @else
                                        <figure class="image flex-none max-sm:w-32  max-sm:pl-4 mt-0">
                                            <img src="{{ asset('img/placeholder-post.png') }}" width="{{ env('ARTICLE_SMALL_W') }}"
                                                height="{{ env('ARTICLE_SMALL_H') }}" alt="{{ $content->title }}">
                                        </figure>
                                    @endif

                                    <div class="pb-0 flex-1 flex justify-between">

                                        <div class="title align-right p-0">{{ $content->title }}</div>

                                        <div class=" font-09 max-sm:text-right">
                                            <div class="flex gap-x-3 justify-between font-08">
                                                @include(asset('widget.publishDate'))
                                                @include(asset('widget.rate'))
                                                @include(asset('widget.viewCount'))
                                            </div>
                                            <div class="line-clamp-2">
                                                {!! $content->brief_description !!}
                                            </div>
                                        </div>
                                    </div>

                                </article>
                            </a>
                        </div>
                    @endforeach
                @endisset
            </div>

            <div class="grid gap-1 grid-cols-1 sm:grid-cols-2">
                <a class="block" href="https://edengoldgallery.ir/?ref=corepo" target="__blunk"><img height=""
                        class="w-full border-radius-10 " src="{{ asset('/img/eden-70.jpg') }}" alt=""></a>
                <a class="block" href="https://it-times-store.com/?ref=corepo" target="__blunk"><img height=""
                        class="w-full border-radius-10 " src="{{ asset('/img/it-70.jpg') }}" alt=""></a>
            </div>

        </div>
    </div>
    </div>
</section>





<section class="index-items bg-pink mt-0 mb-0 pt-0">

    <div>
        <h2 class="text-white">بازی و اپلیکیشن </h2>
    </div>

    <div class="flex  application  ">
        {{--post&label=application&var=application&count=5 --}}
        @isset($application['data'])
            @foreach ($application['data'] as $content)
                <div class="p-1 w-full sm:basis-1/3 md:basis-1/6 ">
                    <a href="{{ $content->slug }}">
                        <article class="shadow2 ">
                            @if (isset($content->images['images']['small']))
                                <figure class="image m-0">
                                    <img loading="lazy" src="{{ image_or_placeholder($content->images['images']['small']) }}"
                                        alt="{{ $content->title }}" width="80" height="80">
                                </figure>
                            @endif


                            <div class="title mt-1 line-clamp-1">{{ $content->title }}</div>
                            @include(asset('widget.rate'))
                        </article>
                    </a>
                </div>
            @endforeach
            <div class="p-1 w-full  sm:basis-1/3 md:basis-1/6">
                <a href="/برنامه-و-اپلیکیشن">
                    <article class="shadow2 py-3 max-sm:flex max-sm:flex-wrap max-sm:!flex-row ">
                        <svg class="max-sm:h-5 max-sm:!mt-0 max-sm:order-2" height="70px" width="70px" id="Layer_1"
                            style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" xml:space="preserve"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path
                                d="M28,14H8.8l4.62-4.62C13.814,8.986,14,8.516,14,8c0-0.984-0.813-2-2-2c-0.531,0-0.994,0.193-1.38,0.58l-7.958,7.958  C2.334,14.866,2,15.271,2,16s0.279,1.08,0.646,1.447l7.974,7.973C11.006,25.807,11.469,26,12,26c1.188,0,2-1.016,2-2  c0-0.516-0.186-0.986-0.58-1.38L8.8,18H28c1.104,0,2-0.896,2-2S29.104,14,28,14z" />
                        </svg>
                        <div class="title line-clamp-1  max-sm:order-1">تمام اپلیکیشن ها</div>
                    </article>
                </a>
            </div>
        @endisset
    </div>
</section>

<section class="bg-pink  mt-0 mb-0  ">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-1">

        <img height="" class=" full border-radius-10  " src="{{ asset('/img/garmgah-70.jpg') }}" alt="">
        <img height="" class=" full border-radius-10  " src="{{ asset('/img/banner-70.jpg') }}" alt="">

    </div>
</section>


<section class="category-box bg-gray-dark  mt-0 mb-0">


    <div class="flex  ">
        <div class="full">
            <h2 class="color-white p-0">مقالات</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-5  gap-1">
            <div class="  mb-1">
                <div class="shadow full-height border-radius-10 ">
                    {{--categoryDetail&label=categoryDetail&var=categoryDetail&count=1 --}}
                    @isset($categoryDetail['data'])
                        <div class="flex four-800 align-items-center px-0 py-0  ">
                            <div
                                class="full  [&_div]:px-0 [&_a]:bg-slate-50 [&_a]:text-sm [&_a]:border [&_a]:block text-center  [&_a]:p-2 [&_p]:mb-4 [&_a]:rounded">
                                <div class="font-bold text-[#e81e6c]  text-lg mb-4">لینک های مفید</div>
                                {!! $categoryDetail['data']['description'] !!}
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
            <div class="sm:col-span-4  ">
                <div class="shadow mb-1  border-radius-10">
                    {{--post&label=salamat&var=salamat&count=3 --}}
                    <h3><a href="{{ url('سلامت-و-سبک-زندگی') }}">سلامت و سبک زندگی</a></h3>
                    <div class="grid grid-cols-1 md:grid-cols-3  gap-2">
                        @isset($salamat['data'])
                            @foreach ($salamat['data'] as $content)
                                <div class="flex  flex-row align-items-center px-0 py-1 border-b last:border-b-0 ">
                                    <div class="flex gap-x-3 align-items-center p-0 pt-1 min-height ">
                                        <a class="" href="{{ url($content['slug']) }}">

                                            <img class="rounded p-0" width="70" height="70" alt="{{ $content['title'] }}"
                                                src="{{ image_or_placeholder($content['images']['images']['small']) }}">

                                        </a>
                                        <div class="pb-0 flex-1 flex mb-0">
                                            <a class="full p-0 m-0"
                                                href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                            <div class="flex gap-x-3 justify-between font-08">
                                                @include(asset('widget.publishDate'))
                                                @include(asset('widget.rate'))
                                                @include(asset('widget.viewCount'))
                                            </div>
                                        </div>
                                    </div>
                                    <div class="full line-clamp-2">{!! $content['brief_description'] !!}</div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2  gap-1  ">

                    <div class="mb-1 flex-1">
                        <div class="shadow full-height border-radius-10 ">
                            <h3><a href="{{ url('آشپزی-و-تغذیه') }}">آشپزی و تغذیه</a></h3>
                            <div class="flex one ">
                                {{--post&label=articleChef&var=articleChef&count=2 --}}
                                @isset($articleChef['data'])
                                    @foreach ($articleChef['data'] as $content)
                                        <div class="flex gap-x-3 align-items-center p-0 pt-1 min-height ">
                                            <a class="" href="{{ url($content['slug']) }}">
                                                <img class="rounded p-0" width="70" height="70" alt="{{ $content['title'] }}"
                                                    src="{{ image_or_placeholder($content['images']['images']['small']) }}">
                                            </a>
                                            <div class="flex-1 pb-0 flex mb-0">
                                                <a class="full p-0 m-0 line-clamp-2"
                                                    href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                                <div class="flex gap-x-3 justify-between font-08">
                                                    @include(asset('widget.publishDate'))
                                                    @include(asset('widget.rate'))
                                                    @include(asset('widget.viewCount'))
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-0 line-clamp-2 @if (!$loop->last) border-bottom @endif">
                                            {!! $content->brief_description !!}
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                    </div>


                    <div class="mb-1 flex-1">
                        <div class="shadow full-height border-radius-10">
                            <h3><a href="{{ url('کسب-و-کار') }}">کسب و کار</a></h3>
                            <div class="flex one">
                                {{--post&label=articleJob&var=articleJob&count=2 --}}
                                @isset($articleJob['data'])
                                    @foreach ($articleJob['data'] as $content)
                                        <div class="flex gap-x-3 align-items-center p-0 pt-1 min-height ">
                                            <a class="" href="{{ url($content['slug']) }}">


                                                <img class="rounded p-0" width="70" height="70" alt="{{ $content['title'] }}"
                                                    src="{{ image_or_placeholder($content['images']['images']['small']) }}">

                                            </a>
                                            <div class="flex-1 pb-0 flex mb-0">
                                                <a class="full p-0 m-0"
                                                    href="{{ url($content['slug']) }}">{{ $content['title'] }}</a>
                                                <div class="flex gap-x-3 justify-between font-08">
                                                    @include(asset('widget.publishDate'))
                                                    @include(asset('widget.rate'))
                                                    @include(asset('widget.viewCount'))
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-0 line-clamp-2 @if (!$loop->last) border-bottom @endif">
                                            {!! $content->brief_description !!}
                                        </div>
                                    @endforeach
                                @endisset
                            </div>

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 ">


            <div class="mb-1 flex-1">
                <div class="shadow full-height border-radius-10">
                    <h3><a href="{{ url('سفر-و-گردش') }}">سفر و گردش</a></h3>
                    <div class="flex one">
                        {{--post&label=articleTour&var=articleTour&count=2 --}}
                        @isset($articleTour['data'])
                            @foreach ($articleTour['data'] as $content)
                                <div class="flex gap-x-3 align-items-center p-0 pt-1 min-height border-b  last:border-b-0">
                                    <a class="shrink-0 flex-none" href="{{ url($content['slug']) }}">


                                        <img class="rounded p-0" width="70" height="70" alt="{{ $content['title'] }}"
                                            src="{{ image_or_placeholder($content['images']['images']['small']) }}">

                                    </a>
                                    <div class="flex-1 pb-0 flex mb-0">
                                        <div class="full">
                                            <a class="full p-0 m-0" href="{{ url($content['slug']) }}">
                                                {{ $content['title'] }}
                                            </a>
                                            <div class="p-0 line-clamp-1">
                                                {!! $content->brief_description !!}
                                            </div>
                                        </div>
                                        <div class="flex gap-x-3 justify-between font-08">
                                            @include(asset('widget.publishDate'))
                                            @include(asset('widget.rate'))
                                            @include(asset('widget.viewCount'))
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>

            <div class="mb-1 flex-1">
                <div class="shadow full-height border-radius-10">
                    <h3><a href="{{ url('دکور-و-خانه-داری') }}">دکور و خانه داری</a></h3>
                    <div class="flex one">
                        {{--post&label=articleDeco&var=articleDeco&count=2 --}}
                        @isset($articleDeco['data'])
                            @foreach ($articleDeco['data'] as $content)
                                <div class="flex gap-x-3 align-items-center p-0 pt-1 min-height border-b  last:border-b-0">
                                    <a class="shrink-0 flex-none" href="{{ url($content['slug']) }}">


                                        <img class="rounded p-0" width="70" height="70" alt="{{ $content['title'] }}"
                                            src="{{ image_or_placeholder($content['images']['images']['small']) }}">

                                    </a>
                                    <div class="flex-1 pb-0 flex mb-0">
                                        <div class="full">
                                            <a class="block p-0 m-0" href="{{ url($content['slug']) }}">
                                                {{ $content['title'] }}
                                            </a>
                                            <div class="p-0 line-clamp-1">
                                                {!! $content->brief_description !!}
                                            </div>
                                        </div>
                                        <div class="flex gap-x-3 justify-between font-08">
                                            @include(asset('widget.publishDate'))
                                            @include(asset('widget.rate'))
                                            @include(asset('widget.viewCount'))
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>

            <div class="">
                <div class="shadow full-height border-radius-10 pt-0">
                    <h3><a href="{{ url('علمی-و-آموزشی') }}">علمی و آموزشی</a></h3>
                    <div class="flex one ">
                        {{--post&label=articleUni&var=articleUni&count=2 --}}
                        @isset($articleUni['data'])
                            @foreach ($articleUni['data'] as $content)
                                <div class="flex gap-x-3 align-items-center p-0 pt-1 min-height border-b  last:border-b-0">
                                    <a class="shrink-0 flex-none" href="{{ url($content['slug']) }}">


                                        <img class="rounded p-0" width="70" height="70" alt="{{ $content['title'] }}"
                                            src="{{ image_or_placeholder($content['images']['images']['small']) }}">

                                    </a>
                                    <div class="flex-1 pb-0 flex mb-0">
                                        <div class="full">
                                            <a class="full p-0 m-0" href="{{ url($content['slug']) }}">
                                                {{ $content['title'] }}
                                            </a>
                                            <div class="p-0 line-clamp-1">
                                                {!! $content->brief_description !!}
                                            </div>
                                        </div>
                                        <div class="flex gap-x-3 justify-between font-08">
                                            @include(asset('widget.publishDate'))
                                            @include(asset('widget.rate'))
                                            @include(asset('widget.viewCount'))
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
            <div class="">
                <div class="shadow full-height border-radius-10 pt-0">
                    <h3><a href="{{ url('مقالات-خودرو') }}">مقالات خودرو</a></h3>
                    <div class="flex one">
                        {{--post&label=articleCar&var=articleCar&count=2 --}}
                        @isset($articleCar['data'])
                            @foreach ($articleCar['data'] as $content)
                                <div class="flex gap-x-3 align-items-center p-0 pt-1 min-height border-b  last:border-b-0">
                                    <a class="shrink-0 flex-none" href="{{ url($content['slug']) }}">


                                        <img class="rounded p-0" width="70" height="70" alt="{{ $content['title'] }}"
                                            src="{{ image_or_placeholder($content['images']['images']['small']) }}">

                                    </a>
                                    <div class="flex-1 pb-0 flex mb-0">
                                        <div class="full">
                                            <a class="full p-0 m-0" href="{{ url($content['slug']) }}">
                                                {{ $content['title'] }}
                                            </a>
                                            <div class="p-0 line-clamp-1">
                                                {!! $content->brief_description !!}
                                            </div>
                                        </div>
                                        <div class="flex gap-x-3 justify-between font-08">
                                            @include(asset('widget.publishDate'))
                                            @include(asset('widget.rate'))
                                            @include(asset('widget.viewCount'))
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>



        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-1 mt-4">
            <img height="" class="w-full border-radius-10 " src="{{ asset('/img/banner-70.jpg') }}" alt="">
            <img height="" class="w-full border-radius-10 " src="{{ asset('/img/banner-70.jpg') }}" alt="">
        </div>
    </div>

</section>


<section class="bg-pink  mt-0 mb-0">
    <div class="flex one ">
        <div class="text-center">
            <h3>جدیدترین وب سایت ها</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-5 gap-1 mb-1 ">
                {{--post&label=newWebsite&var=newWebsite&count=5 --}}
                @isset($newWebsite['data'])
                    @foreach ($newWebsite['data'] as $content)
                        <div class="">
                            <a href="{{ $content->slug }}">
                                <article class=" shadow2 flex flex-row justify-between">

                                    @if (isset($content->images['images']['medium']))
                                        <figure class="image flex-none max-sm:w-32  max-sm:pl-4 mt-0">
                                            <img loading="lazy"
                                                src="{{ image_or_placeholder($content->images['images']['medium']) }}"
                                                width="{{ env('ARTICLE_SMALL_W') }}" height="{{ env('ARTICLE_SMALL_H') }}"
                                                alt="{{ $content->title }}">
                                        </figure>
                                    @endif

                                    <div class="pb-0 flex-1 flex justify-between">

                                        <div class="title align-right p-0">{{ $content->title }}</div>

                                        <div class=" font-09 max-sm:text-right ">
                                            <div class="flex gap-x-3 justify-between font-08">
                                                @include(asset('widget.publishDate'))
                                                @include(asset('widget.rate'))
                                                @include(asset('widget.viewCount'))
                                            </div>
                                            <div class="line-clamp-3">

                                                {!! $content->brief_description !!}
                                            </div>
                                        </div>
                                    </div>

                                </article>
                            </a>
                        </div>
                    @endforeach
                @endisset
            </div>


        </div>
    </div>
</section>




@endsection

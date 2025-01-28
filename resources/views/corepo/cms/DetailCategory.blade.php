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


@section('head')
<link rel="stylesheet" href="{{ asset('/detail.category.css') }}">

@if (json_decode($relatedProduct->toJson())->prev_page_url != null)
    <link rel="prev" href="{{ json_decode($relatedProduct->toJson())->prev_page_url }}">
@endif
@if (json_decode($relatedProduct->toJson())->next_page_url != null)
    <link rel="next" href="{{ json_decode($relatedProduct->toJson())->next_page_url }}">
@endif

<link href="{{$seo['url']}}" rel="canonical" />

@endsection


@section('footer')



<script src="{{ asset('/siema.min.js') }}"></script>
<script>
    var w;
    var perPageNumber;

    function perPage() {
        w = window.innerWidth;
        if (w <= 500) {
            perPageNumber = 1;
        } else if (w <= 768) {
            perPageNumber = 5;
        } else if (w <= 1024) {
            perPageNumber = 5;
        } else {
            perPageNumber = 5;
        }
    }


    document.getElementsByTagName("BODY")[0].onresize = function () {
        mySiema.destroy();
        perPage();
        mySiema.init();
    };


    perPage();
    var mySiema = new Siema({
        selector: '.siema',
        duration: 200,
        easing: 'ease-out',
        perPage: perPageNumber,
        startIndex: 0,
        draggable: true,
        multipleDrag: true,
        threshold: 20,
        loop: false,
        rtl: true,
        onInit: () => { },
        onChange: () => {

        },
    });
    document.querySelector('.prev2').addEventListener('click', () => mySiema.prev());
    document.querySelector('.next2').addEventListener('click', () => mySiema.next());
</script>

@auth
    @if (Auth::user()->id == 1)
        <div class="btn btn-info edit-button" onclick="window.open('{{ url('/admin/category/' . $detail->id . '/edit/') }}')">
            ویرایش</div>
    @endif
@endauth

@endsection

@section('Content')

@php
    $tableOfImages = tableOfImages($detail->description);
    $append = '';
@endphp

@if (count($relatedProduct))
    @include('jsonLdRelatedProduct')
@endif

@include('jsonLdFaq')

@if (count($breadcrumb) > 0)
    @include('jsonLdBreadcrumb')
@endif

@if (count($breadcrumb))
    <section class="breadcrumb bg-amber-400">
        <div class="flex one  ">
            <div class="p-0">
                <a href="/">خانه </a>
                @foreach ($breadcrumb as $key => $item)
                    <span>></span>
                    <a title="{{ $item['title'] }}" href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                @endforeach

            </div>
        </div>
    </section>
@endif

@if (count($subCategory))
    <section class=" border-b border-b-gray-300 my-0 pb-0" id="index-best-view">
        <div class="flex one relative">
            <div class="flex gap-2 max-sm:!flex-nowrap contain-content p-0 max-sm:overflow-x-scroll scrollbar pb-3">
                @foreach ($subCategory as $content)
                    <a href="{{ $content->slug }}">
                        <div class="hover over rounded-md !py-0 px-2 border bg-white whitespace-nowrap text-center">
                            <span class="px-2 m-0 text-center"> {{ $content->title }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

@if (count($relatedProduct))
    <section class="products mt-5" id="index-best-view">
        <div class="flex one ">
            <div>
                <div class="">

                    <div class="flex one two-500 four-900 center ">

                        @foreach ($relatedProduct as $content)
                            <div>
                                <article>
                                    @if (isset($content->images['images']['small']))
                                        <figure class="image">
                                            <img loading="lazy" src="{{ $content->images['images']['small']  }}"
                                                sizes="(max-width:{{ env('ARTICLE_SMALL_W') }}px) 100vw {{ env('ARTICLE_SMALL_W') }}px {{ ENV('ARTICLE_MEDIUM_W') }}px"
                                                alt="{{ $content->title }}" width="100" height="100"
                                                srcset="
                                                                                                                                                                                                                                                                                            {{ $content->images['images']['small']  }} {{ env('ARTICLE_SMALL_W') }}w,
                                                                                                                                                                                                                                                                                            {{ $content->images['images']['medium'] ?? $content->images['images']['small'] }} 2x">
                                        </figure>

                                    @endif
                                    <footer>
                                        <h2><a href="{{ $content->slug }}"> {{ $content->title }}</a></h2>
                                        {!! $content->brief_description !!}
                                    </footer>
                                </article>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<section class=" bg-gray-100 mt-0 pt-0">
    <div>
        <h1>{{ $detail->title ?? '' }}</h1>
    </div>
    <div class="grid  md:grid-cols-4 gap-4">

        <div class="md:col-span-3 ">

            @if(isset($relatedPost) && count($relatedPost))
                <div>
                    @isset($relatedPost)
                        <div class="grid grid-cols-1 gap-4 mb-2">
                            @foreach ($relatedPost as $content)
                                <div>
                                    <a href="{{ $content->slug }}">
                                        <article class="shadow !rounded-xl grid grid-cols-6 gap-x-2 ">
                                        <div class="title col-span-6 pb-2">{{ $content->title }}</div>
                                            @if (isset($content->images['images']['small']))
                                                <figure class="image col-span-2 sm:col-span-1">
                                                    <img loading="lazy"
                                                        src="{{ image_or_placeholder($content->images['images']['small'])  }}"
                                                        width="{{ env('ARTICLE_SMALL_W', 200) }}"
                                                        height="{{ env('ARTICLE_SMALL_H', 200) }}" alt="{{ $content->title }}">
                                                </figure>
                                            @endif
                                            <div class="col-span-4 sm:col-span-5 flex content-between">
                                                <div class="w-full">
                                                    <div class="info line-clamp-3 sm:line-clamp-5">
                                                        {!! $content->brief_description !!}
                                                    </div>
                                                </div>
                                                <div class="rate mt-1 md:justify-start ">
                                                    <div class="flex justify-center gap-x-2 ">
                                                        @include(asset('widget.rate'))

                                                        <div class="flex flex-1 gap-x-1 text-sm items-center">
                                                            @include(asset('widget.publishDate'))
                                                            @include(asset('widget.viewCount'))

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </article>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        {{ $relatedPost->links('pagination::default') }}
                    @endisset
                </div>
            @endif

            @if (isset($relatedCompany) && $relatedCompany->count())
                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-3 mb-5">
                    @foreach ($relatedCompany as $content)
                        <a class="shadow rounded-lg block text-center" href="{{ url('profile/' . $content->id) }}">

                            <img alt="{{ $content->name ?? '' }}" class="rounded" width="{{ env('COMPANY_LARGE_W') }}"
                                height="{{ env('COMPANY_LARGE_H') }}"
                                src="{{ image_or_placeholder($content->logo['large'] ?? '') }}">

                            <div class=" ">
                                {{ $content->name ?? 'کاربر جدید' }}
                            </div>

                        </a>
                    @endforeach

                </div>
                {{ $relatedCompany->links('pagination::default') }}
            @endif


            @if ($detail->description != '')
                <div class="!rounded-lg mt-4 shadow" id="">
                    <div class="flex one ">
                        <div class="overflow-auto ">
                            <ul>
                                @foreach ($table_of_content as $key => $item)
                                    <li class="toc1">
                                        - <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <hr>
                            @include(@env('TEMPLATE_NAME') . '.DescriptionModule')
                        </div>
                    </div>
                </div>
            @endif

            <div class="mt-4">
                @include('corepo.Comment')
            </div>
        </div>

        <div class="">
            <div class="">
                {{-- images&label=adv&var=adv&count=3 --}}
                @if (isset($adv) && isset($adv['images']))
                <div class="text-center shadow rounded-xl">
                    @foreach ($adv['images'] as $k => $content)
                        <a class="text-center block" target="_blanck" href="{{ $adv['url'][$k] }}" @if (!isset($adv['follow'][$k])) rel="nofollow" @endif>
                            <img class="inline" width="200px" height="200px" src="{{ image_or_placeholder($content) }}"
                                alt="محل تبلیغ کریپو">
                        </a>
                    @endforeach
                </div>
                @endisset



                <div class="mt-4">آخرین مقالات</div>
                {{--post&label=sideCategory&var=sideCategory&count=10&child=true --}}
                @isset($sideCategory['data'])
                    <ul class=" shadow rounded-xl">
                        @foreach ($sideCategory['data'] as $item)
                            <li class="border-b last:border-b-0 border-gray-300 pb-2 last:pb-0">
                                <a class="flex gap-x-1" href="{{ url($item->slug) }} ">
                                        <img class="rounded h-auto object-contain flex-none"
                                            src="{{ image_or_placeholder($item->images['images']['small']) }}" width="35"
                                            height="35" alt="">
                                    <span class="flex-1">{{ $item->title }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endisset


            </div>
        </div>
    </div>
</section>











@endsection

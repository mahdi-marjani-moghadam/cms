@extends(@env('TEMPLATE_NAME').'.App')

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
            perPageNumber = 7;
        }
    }


    document.getElementsByTagName("BODY")[0].onresize = function() {
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
        onInit: () => {},
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

@if (count($breadcrumb)>0)
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
<section class="bg-amber-400 category-section my-0" id="index-best-view">
    <div class="flex one relative">
        <div class="siema p-0">
            @foreach ($subCategory as $content)
            <a href="{{ $content->slug }}">
                <div class="hover text-center">
                    @if (isset($content->images['images']['small']))
                    <figure class="image">
                        <img loading="lazy" src="{{ $content->images['images']['small']  }}" alt="{{ $content->title }}" width="{{ env('CATEGORY_SMALL_W') }}" height="{{ env('CATEGORY_SMALL_H') }}" srcset="
                                            {{ $content->images['images']['small']  }} {{ env('CATEGORY_SMALL_W') }}w,
                                            {{ $content->images['images']['medium'] ?? $content->images['images']['small'] }} {{ env('CATEGORY_MEDIUM_W') }}w,
                                            {{ $content->images['images']['large'] ?? $content->images['images']['small'] }} {{ env('CATEGORY_LARGE_W') }}w">
                        <figcaption>
                            <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                        </figcaption>
                    </figure>
                    @else
                    <h3 class="p-0 m-0 text-center"> {{ $content->title }}</h3>
                    @endif

                </div>
            </a>
            @endforeach

        </div>
        <a class="prev2">&#10094;</a>
        <a class="next2">&#10095;</a>



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
                                <img loading="lazy" src="{{ $content->images['images']['small']  }}" sizes="(max-width:{{ env('ARTICLE_SMALL_W') }}px) 100vw {{ env('ARTICLE_SMALL_W') }}px {{ ENV('ARTICLE_MEDIUM_W') }}px" alt="{{ $content->title }}" width="100" height="100" srcset="
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

<section class=" bg-gray-100 mt-0">
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
                            <article class="shadow !rounded-xl grid grid-cols-1 md:grid-cols-5 gap-x-2 max-sm:text-center">
                                @if (isset($content->images['images']['small']))
                                <figure class="image">
                                    <img loading="lazy" src="{{ $content->images['images']['small']  }}" width="{{ env('ARTICLE_SMALL_W', 200) }}" height="{{ env('ARTICLE_SMALL_H', 200) }}" alt="{{ $content->title }}">
                                </figure>
                                @endif
                                <div class="md:col-span-4 flex content-between max-sm:justify-center ">
                                    <div class="w-full">
                                        <div class="title text-lg">{{ $content->title }}</div>
                                        <div class="info">
                                            {!! readMore($content->brief_description, 1000) !!}
                                        </div>
                                    </div>
                                    <div class="rate mt-1 md:justify-start ">
                                        <div class="flex gap-x-2 ">
                                            @include(asset('widget.rate'))

                                            <div class="flex gap-x-1 items-center">
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



            @if(Request::is('تعرفه') || Request::is('رپورتاژ') || Request::is('درباره-ما') || Request::is('تبلیغات'))
            <div class="!rounded-lg shadow" id="">
                <div class="flex one ">
                    <div>
                        <ul>
                            @foreach ($table_of_content as $key => $item)
                            <li class="toc1">
                                <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                            </li>
                            @endforeach

                        </ul>
                        @include(@env('TEMPLATE_NAME').'.DescriptionModule')
                    </div>
                </div>
            </div>
            @endif




        </div>

        <div class="">
            <div class="">
                {{-- images&label=adv&var=adv&count=3 --}}
                @if (isset($adv) && isset($adv['images']))
                <div class="text-center shadow rounded-xl">
                    @foreach ($adv['images'] as $k => $content)
                    <a class="text-center block" target="_blanck" href="{{ $adv['url'][$k] }}" @if (!isset($adv['follow'][$k])) rel="nofollow" @endif>
                        <img class="inline" width="200px" height="200px" src="{{ $content }}" alt="محل تبلیغ کریپو">
                    </a>
                    @endforeach
                </div>
                @endisset



                <div class="mt-4">آخرین مقالات</div>
                {{--post&label=sideCategory&var=sideCategory&count=10&child=true --}}
                @isset($sideCategory['data'])
                <ul class="max-sm:grid max-sm:grid-cols-2 max-sm:gap-x-1 shadow rounded-xl">
                    @foreach ($sideCategory['data'] as $item)
                    <li class="border-b last:border-b-0 border-gray-300 pb-2 last:pb-0">
                        <a class="flex gap-x-1" href="{{ url($item->slug) }} ">
                            <div>
                                <img class="rounded h-auto object-contain" src="{{ $item->images['images']['small'] }}" width="35" height="35" alt="">
                            </div>
                            <span class="flex-initial w-4/5 max-sm:w-2/3">{{ $item->title }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                @endisset


            </div>
        </div>
    </div>
</section>




@if(!Request::is('درباره-ما') && !Request::is('تعرفه') && !Request::is('رپورتاژ') && !Request::is('تبلیغات'))
<section class="comments bg-gray mt-0 mb-0">
    <div class="flex one">
        <div>
            <div>نظرات شما درباره {{ $detail->title }}</div>
            <div>
                <div class="comment-form lg:w-1/2 m-auto">
                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                    @endif

                    @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        {!! \Session::get('error') !!}
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    </div>
                    @endif
                    <form action="{{ route('comment.client.store') }}#comment" id="comment" method="post">
                        <input type="hidden" name="content_id" value="{{ $detail->id }}">

                        @csrf
                        <div>
                            <div class="rating">
                                <span>امتیاز: </span>
                                <input name="rate" type="radio" id="st5" {{ old('rate') == '5' ? 'checked' : '' }} value="5" />
                                <label for="st5" title="عالی"></label>
                                <input name="rate" type="radio" id="st4" {{ old('rate') == '4' ? 'checked' : '' }} value="4" />
                                <label for="st4" title="خوب"></label>
                                <input name="rate" type="radio" id="st3" {{ old('rate') == '3' ? 'checked' : '' }} value="3" />
                                <label for="st3" title="معمولی"></label>
                                <input name="rate" type="radio" id="st2" {{ old('rate') == '2' ? 'checked' : '' }} value="2" />
                                <label for="st2" title="ضعیف"></label>
                                <input name="rate" type="radio" id="st1" {{ old('rate') == '1' ? 'checked' : '' }} value="1" />
                                <label for="st1" title="بد"></label>
                                <span id="rating-hover-label"></span>
                            </div>
                        </div>

                        <div>
                            <label for="comment_name">نام:</label>
                            <input id="comment_name" class="w-full p-1" type="text" name="name" value="{{ old('name') }}">
                        </div>
                        <div>
                            <label for="comment-text">پیام:</label>
                            <textarea id="comment-text" class="w-full p-1" name="comment">{{ old('comment') }}</textarea>
                        </div>
                        <button class="button button-blue g-recaptcha" data-sitekey="reCAPTCHA_site_key" data-callback='onSubmit' data-action='submit'>ارسال نظر</button>
                    </form>
                </div>

                @foreach ($detail->comments as $comment)
                @if ($comment['name'] != '' && $comment['comment'] != '')
                <div class="comment">
                    <div class="aside">
                        <div class="name">{{ $comment['name'] }}</div>
                        <div class="date">{{ convertGToJ($comment['created_at']) }}</div>
                    </div>
                    <div class="article">
                        <div>
                            @for ($i = $comment->rate; $i >= 1; $i--)
                            <label></label>

                            @endfor
                        </div>
                        <div class="text">{!! $comment['comment'] !!}</div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif


@endsection

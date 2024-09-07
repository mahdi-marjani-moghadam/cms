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

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {

        const ratings = document.querySelectorAll('[name="rate"]');
        const labels = document.querySelectorAll('.rating > label');

        const change = (e) => {
            console.log(e.target.value);

        }
        const mouseenter = (e) => {
            document.getElementById('rating-hover-label').innerHTML = e.target.title;
        }
        const mouseleave = (e) => {

            document.getElementById('rating-hover-label').innerHTML = '';
        }

        ratings.forEach((el) => {
            el.addEventListener('change', change);
        });
        labels.forEach((el) => {
            el.addEventListener('mouseenter', mouseenter);
            el.addEventListener('mouseleave', mouseleave);
        });



    });


    function myFunction(imgs) {
        var expandImg = document.getElementById("main-image");
        // var imgText = document.getElementById("imgtext");
        // console.log(expandImg.dataset.columns);
        expandImg.src = imgs.dataset.large;
        // imgText.innerHTML = imgs.alt;
        expandImg.parentElement.style.display = "block";
    }
</script>
@endpush

@section('footer')
@auth
@if (Auth::user()->id == 1)
<div class="btn btn-info edit-button" onclick="window.open('{{ url('/admin/contents/' . $detail->id . '/edit/') }}')">
    ویرایش</div>
@endif
@endauth
@endsection



@section('Content')
@php
$tableOfImages = tableOfImages($detail->description);
$append = '';
@endphp

@if ($detail->attr_type == 'product')
@include('jsonLdProduct')
@endif
@include('jsonLdFaq')

@if ($detail->attr_type == 'article')
@include('jsonLdArticle')
@endif

@if (count($breadcrumb) > 0)
@include('jsonLdBreadcrumb')
@endif

<section class="breadcrumb ">
    <div class="flex one  ">
        <div class="p-0">
            <a href="/">خانه </a>
            @foreach ($breadcrumb as $key => $item)
            <span>></span>
            <a href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
            @endforeach

        </div>
    </div>
</section>
<section class="intro my-0 pt-0 pb-4" id="detail">
    <div class="flex one four-500  ">
        <div class="order2-500">
            @if (isset($detail->images['images']['large']))
            <figure class="image">
                <img id="main-image"
                    class=""
                    src="{{ image_or_placeholder($detail->images['images']['large']) }}"
                    alt="{{ $detail->title }}"
                    width="{{ env(Str::upper($detail->attr_type) . '_LARGE_W') }}"
                    height="{{ env(Str::upper($detail->attr_type) . '_LARGE_H') }}">
            </figure>


            @if ($detail->gallery->count())
            <div class="gallery">
                <img onclick="myFunction(this);" class="m-1"
                    data-large="{{ $detail->images['images']['large'] }}"
                    src="{{ $detail->images['images']['small'] }}" height="100">
                @foreach ($detail->gallery as $item)
                <img onclick="myFunction(this);" class="m-1"
                    data-large="{{ $item->images['images']['large'] }}"
                    src="{{ $item->images['images']['small'] }}" height="100">
                @endforeach
            </div>
            @endif

            @endif

        </div>
        <div class="three-fourth-500 order3-500 md:pr-4">
            <div>
                <h1 class="site-name pt-0">{{ $detail->title }}</h1>
                <div class="website"></div>
                <div class="rate">

                    @if (isset($detail->comments) && count($detail->comments))
                    @php
                    $rateAvrage = $rateSum = 0;
                    @endphp
                    @foreach ($detail->comments as $comment)
                    @php
                    $rateSum = $rateSum + $comment['rate'];
                    @endphp
                    @endforeach
                    @for ($i = $rateSum / count($detail->comments); $i >= 1; $i--)
                    <img width="20" height="20"
                        srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                        src="{{ asset('/img/star1x.png') }}" alt="{{ 'star for rating' }}">
                    @endfor
                    <span class="font-08">({{ count($detail->comments) }} نفر)</span>
                    @endif
                </div>
                <div class="p-0 flex items-center">
                    <svg class="p-0" width="13" height="13" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 3C6.40848 3 1.71018 6.82432 0.378052 12C1.71018 17.1757 6.40848 21 12 21C17.5915 21 22.2898 17.1757 23.6219 12C22.2898 6.82432 17.5915 3 12 3ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                            fill="currentColor" />
                    </svg>
                    <span class="pr-1">{{ $detail->viewCount }}</span>
                </div>
            </div>
            {!! $detail->brief_description !!}
            <hr>
            دسته بندی:
            @foreach ($detail->categories as $item)
            <a href="{{ url($item->slug) }}">{{ $item->title }}</a>
            @if (!$loop->last)
            -
            @endif
            @endforeach

        </div>

    </div>
    </div>
</section>

<section class="content-detail bg-gray  pt-6 my-0 " id="">
    <div class="flex one ">
        <ul class="">
            @foreach ($table_of_content as $key => $item)
            <li class="toc1 ">
                <a class="" id="test" href="#{{ $item['anchor'] }}">✅ {{ $item['label'] }}</a>
            </li>
            @endforeach

        </ul>
        @include(@env('TEMPLATE_NAME') . '.DescriptionModule')
    </div>
</section>

@if (count($relatedProduct))
<section class="products bg-gray m-0 pt-1 pb-1 " id="index-best-view">
    <div class="flex one max-w-screen-lg">
        <div>
            <div class="shadow ">
                <h2>محصولات مرتبط {{ $detail->title }}</h2>
                <div class="flex two two-500 four-900 center ">

                    @foreach ($relatedProduct as $content)
                    <div>
                        <article>
                            @if (isset($content->images['images']['small']))
                            <a class="" href="{{ $content->slug }}">
                                <img src="{{ image_or_placeholder($content->images['images']['small']) }}"
                                    width="{{ env(Str::upper($content->attr_type) . '_SMALL_W') }}"
                                    height="{{ env(Str::upper($content->attr_type) . '_SMALL_H') }}">
                            </a>
                            @endif
                            <footer>
                                <div> <a class="" href="{{ $content->slug }}">{{ $content->title }}</a> </div>
                                <a class="btn btn-block bg-blue" href="{{ $content->slug }}">@lang('messages.more')</a>
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

@if (count($relatedPost))
<section class="products " id="index-best-view">
    <div class="flex one max-w-screen-lg">
        <div>
            <div class="shadow">
                <h2>مقاله های مرتبط {{ $detail->title }}</h2>
                <div class="flex one two-500 four-900 center ">
                    @foreach ($relatedPost as $content)
                    <div>
                        <article>
                            <a href="{{ $content->slug }}">
                                @if (isset($content->images['images']['small']))
                                <div><img src="{{ image_or_placeholder($content->images['images']['small']) }}"></div>
                                @endif
                                <footer>
                                    <h3> {{ $content->title }}</h3>
                                </footer>
                            </a>
                        </article>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
@endif




<section class="comments bg-gray mt-0 mb-0">
    <div class="flex one">
        <div>

            @include('it-times-store.Comment')

        </div>
    </div>
</section>
@endsection

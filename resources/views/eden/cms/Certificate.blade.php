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


@endsection

@section('Content')

    @php
    $tableOfImages = tableOfImages($detail->description);
    $append = '';
    @endphp
    @if (count($breadcrumb)>0)
        @include('jsonLdBreadcrumb')
    @endif
    {{--@if (count($relatedProduct))
        @include('jsonLdRelatedProduct')
    @endif--}}
    <!-- @include('jsonLdFaq') -->


    @if (count($breadcrumb))
        <section class="breadcrumb my-0 py-0">
            <div class="flex one  ">
                <div class="p-0">
                    <a href="/"> خانه</a>
                    @foreach ($breadcrumb as $key => $item)
                        <span>></span>
                        <a href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    <section class="p-0  mt-0">
        <div class="flex one">
            <h1 class="p-0">{{ $detail->title }}</h1>
            <div class="font-08">
                <span class="rate mt-1">
                    @if (count($detail->comments))
                        @php
                        $rateAvrage = $rateSum = 0;
                        @endphp
                        @foreach ($detail->comments as $comment)
                            @php
                            $rateSum = $rateSum + $comment['rate'] ;
                            @endphp
                        @endforeach
                        @for ($i = $rateSum / count($detail->comments); $i >= 1; $i--)
                            <img width="20" height="20"
                                srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                src="{{ asset('/img/star1x.png') }}" alt="{{ 'star for rating' }}">
                        @endfor
                        <span class="font-07">({{ count($detail->comments) }} نفر)   </span>
                    @endif
                </span>             </div>


        </div>
    </section>



    @if (!Request::get('page'))

        <section class="" id="">
            <div class="flex one ">
                <div class="bg-white p-1 border-radius-5">

                    <div class="flex one two-700">
                        <div class="two-third-700">
                            <ul>
                                @foreach ($table_of_content as $key => $item)
                                    <li class="toc1">
                                        <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                                    </li>
                                @endforeach

                            </ul>

                        </div>
                        <div class="third-700">
                            @if (isset($detail->images['images']))
                                <picture>


                                    <img loading="lazy" src="{{ $detail->images['images']['medium'] ?? '' }}"
                                        alt="{{ $detail->title }}"

                                        width="{{ env('CATEGORY_MEDIUM_W') }}"
                                        height="{{ env('CATEGORY_MEDIUM_W') }}">
                                </picture>
                            @endif


                        </div>

                    </div>

                    @include(@env('TEMPLATE_NAME').'.DescriptionModule')

                </div>
            </div>
        </section>



    @endif

@endsection

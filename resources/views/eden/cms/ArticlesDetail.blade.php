@extends(@env('TEMPLATE_NAME') . '.App')



@section('twitter:title', $detail->title)
@section('twitter:description', clearHtml($detail->meta_description))

@section('og:title', $detail->title)
@section('og:description', clearHtml($detail->meta_description))


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


@push('scripts')

@endpush

@section('footer')
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

    @if (count($breadcrumb) > 0)
        @include('jsonLdBreadcrumb')
    @endif
    @if ($detail->attr_type == 'article')
        @include('jsonLdArticle')
    @endif





    @if (count($breadcrumb))
        <section class="breadcrumb my-0 py-0">
            <div class="flex one  ">
                <div class="p-0">
                    <a href="/">خانه </a>
                    @foreach ($breadcrumb as $key => $item)
                        <span>></span>
                        <a title="{{ $item['title'] }}" href="{{ url($item['slug']) }}">{{ $item['title'] }}</a>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    <section class="p-0 m-0">
        <div>
            <h1 class="p-0 m-0">{{ $item['title'] }}</h1>
        </div>
    </section>




    @if (!Request::get('page'))
        <section class="category-content" id="">
            <div class="flex one ">


                <div>
                    <ul>
                        @foreach ($table_of_content as $key => $item)
                            <li class="toc1">
                                <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                            </li>
                        @endforeach

                    </ul>

                    @include(@env('TEMPLATE_NAME') . '.DescriptionModule')
                </div>
            </div>
        </section>
    @endif

@if (count($relatedPost))

        <section class=" " id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="">

                        <div class="flex one two-500 five-900 center ">

                            @foreach ($relatedPost as $content)
                                <a href="{{ url($content->slug) }}">
                                    <div class="shadow hover p-0 ">
                                        @if (isset($content->images['images']['small']))
                                            <figure class="image ">
                                                <img src="{{ image_or_placeholder($content->images['images']['large']) }}"
                                                    alt="{{ $content->title }}" title="{{ $content->title }}" width="400" height="400">
                                                <figcaption>
                                                    <h3 class="px-0 m-0 text-center"> {{ $content->title }}</h3>
                                                </figcaption>
                                            </figure>
                                        @else
                                            <h3 class="px-0 m-0 text-center "> {{ $content->title }}</h3>
                                        @endif

                                    </div>
                                </a>
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

                @include('eden.Comment')

            </div>
        </div>
    </section>

@endsection

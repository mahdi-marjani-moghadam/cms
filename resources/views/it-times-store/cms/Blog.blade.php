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


@push('head')
    @if (json_decode($relatedProduct->toJson())->prev_page_url != null)
        <link rel="prev" href="{{ json_decode($relatedProduct->toJson())->prev_page_url }}">
    @endif
    @if (json_decode($relatedProduct->toJson())->next_page_url != null)
        <link rel="next" href="{{ json_decode($relatedProduct->toJson())->next_page_url }}">
    @endif
@endpush


@push('scripts')

@endpush

@section('footer')
    @auth

        @if (Auth::user()->id == 1)
            <div class="btn btn-info edit-button top-0 right-0 fixed"
                onclick="window.open('{{ url('/admin/category/' . $detail->id . '/edit/') }}')">
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



    <!-- ================= start content section ================= -->
    <section class="py-5">
        <div class="container">
            <!--Hero section-->
            <section
                class="bg-[url('../../it-times-store/assets/images/blog/cover.jpg')] bg-cover bg-center rounded-lg shadow-md py-25 transition-colors duration-200 relative">
                <div class="absolute inset-0 bg-black/40 backdrop-blur-sm rounded-lg"></div>
                <div class="container mx-auto px-4 text-center relative z-10">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-100 dark:text-white mb-4">وبلاگ فروشگاه اینترنتی
                    </h1>
                    <p class="text-lg text-gray-300 dark:text-gray-300 max-w-2xl mx-auto">آخرین مقالات، راهنماهای خرید و
                        نکات مفید برای تجربه خریدی بهتر</p>

                </div>
            </section>

            <!--Original content-->
            <main class="container !px-0 my-10">
                <div class="flex flex-col xl:flex-row gap-4">
                    <!-- Articles -->
                    <div class="xl:w-full">
                        <!-- article -->
                        <div class="grid grid-cols-1 xl:grid-cols-4 md:grid-cols-2 gap-4">


                            @foreach ($relatedPost as $content)
                                <div class="space-y-3 px-1.5 py-2">
                                    <a href="{{ $content->slug }}" class="w-full block" itemprop="url">
                                        <article
                                            class="p-4 space-y-3 rounded-xl hover:-translate-y-2 transition border border-gray-200 bg-white drop-shadow-md dark:bg-background-dark">
                                            <figure class="text-center block py-4" itemprop="image" itemscope
                                                itemtype="https://schema.org/ImageObject">
                                                <img src="{{ image_or_placeholder($content->images['images']['large']) }}"
                                                    class="h-50 rounded-xl w-full block mx-auto object-cover"
                                                    itemprop="contentUrl">
                                            </figure>
                                            <section class="space-y-5">
                                                <div class="space-y-4">
                                                    <h4
                                                        class="relative before:right-0 before:z-[-1] before:rounded-lg before:bg-gray-300 before:absolute before:top-1/2 before:h-px before:w-full before:-translate-y-1/2">
                                                        <span
                                                            class="bg-secondary text-sm rounded text-white px-3 dark:bg-secondary-300"
                                                            itemprop="articleSection">{{ $content->category['title'] }}</span>
                                                    </h4>
                                                    <h2 class="text-xl line-clamp-1 font-bold dark:text-white"
                                                        itemprop="headline">{{ $content->title }}</h2>
                                                </div>
                                                <div class="flex mt-8 flex-wrap justify-between items-center">
                                                    <div class="flex items-center" itemprop="datePublished"
                                                        content="2024-03-02">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.5" stroke="currentColor"
                                                            class="size-6 dark:text-white">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                        <time
                                                            class="mr-2 dark:text-white">{{ convertGToJ($content->publish_date) }}</time>
                                                    </div>
                                                    <div class="flex items-center" itemprop="interactionStatistic" itemscope
                                                        itemtype="https://schema.org/InteractionCounter">
                                                        <meta itemprop="interactionType"
                                                            content="https://schema.org/WatchAction">
                                                        <meta itemprop="userInteractionCount" content="128">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.5" stroke="currentColor"
                                                            class="size-6 dark:text-white">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                        <time class="mr-2 dark:text-white">{{ $content->viewCount }}
                                                            بازدید</time>
                                                    </div>
                                                </div>
                                            </section>
                                        </article>
                                    </a>
                                </div>
                            @endforeach


                        </div>

                        {{ $relatedPost->links('it-times-store.pagination') }}
                    </div>


                </div>
            </main>


        </div>
    </section>
    <!-- ================= end content section ================= -->




@endsection

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

    <link href="{{ request()->fullUrl() }}" rel="canonical" />
@endpush


@push('scripts')

@endpush

@section('footer')
    @auth

        @if (Auth::user()->id == 1)
            <div class="fixed top-0 right-0 z-50 bg-blue-500 py-2 px-3 rounded-bl text-white"
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
            <!-- breadcrumb -->
            <nav class="flex mt-2 mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse"            >
                    <li >
                        <a href="/"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white"
                            >
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            <span >خانه</span>
                        </a>
                    </li>

                    @foreach ($breadcrumb as $key => $item)
                        <li >
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 9 4-4-4-4" />
                                </svg>
                                <a href="{{ $item['slug'] }}"
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
                                    >
                                    <span >{{ $item['title'] }}</span>
                                </a>
                            </div>
                        </li>
                    @endforeach


                </ol>
            </nav>
            <!-- main -->





            <!-- title -->
            <div class="ps-15 my-10 section-heading sm:col-span-4 w-full col-span-6 relative space-y-3">
                <h1 class="font-black text-3xl">
                    <span class="text-primary font-bold">{{ $detail->title ?? '' }}</span>
                </h1>
            </div>

            <!-- quick select category -->
            <div class="mb-6">
                <div class="swiper free-mode">
                    <div class="swiper-wrapper" style="padding-bottom: 0 !important;">


                        @if (count($subCategory))
                            @foreach ($subCategory as $content)
                                <div class="swiper-slide p-1 !w-auto">
                                    <div
                                        class="size-40 overflow-hidden rounded-lg border border-gray-200 flex flex-col justify-center items-center space-y-3 bg-white dark:bg-background-dark p-3 drop-shadow-sm">
                                        <img src="{{ image_or_placeholder($content->images['images']['small'] ?? '') }}" alt="{{ $content->title }}"
                                            width="50" height="50">
                                        <p class="text-neutral-600 dark:text-white truncate w-full text-center">{{ $content->title }}</p>
                                        <a href="{{ $content->slug }}"
                                            class="bg-secondary-500 hover:bg-secondary-400 transition flex items-center space-x-1 rounded-3xl py-1 text-sm px-3">
                                            <span class="inline-block text-white">مشاهده</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4 text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 19.5 8.25 12l7.5-7.5" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                    </div>
                    <div
                        class="swiper-button-prev bg-white rounded-full dark:bg-zinc-800 dark:bg-zinc-800 border border-gray-200 !size-12 after:!text-xl px-3">
                    </div>
                    <div
                        class="swiper-button-next bg-white rounded-full dark:bg-zinc-800 dark:bg-zinc-800 border border-gray-200 !size-12 after:!text-xl px-3ؤ">
                    </div>
                </div>
            </div>

            <!-- filter and products -->
            <div class="grid gap-4 grid-cols-4">


                <!-- filter -->
                <aside class="hidden lg:col-span-1 relative space-y-4 col-span-4 w-full">
                    <section class="space-y-5 sticky top-0">
                        <!-- search -->
                        <section>
                            <div
                                class="dark:bg-background-dark dark:text-white bg-white rounded-lg drop-shadow-lg border-gray-300 border-1 p-4">
                                <h2
                                    class="font-bold text-lg mb-4 relative pb-4 before:absolute before:right-0 before:bottom-0 before:size-2 before:rounded-full before:bg-primary after:absolute after:w-40 after:h-2 after:bottom-0 after:right-4 after:bg-primary after:rounded-lg">
                                    جستجوی محصولات</h2>
                                <div class="relative flex items-center w-full">
                                    <input type="search"
                                        class="w-full appearance-none dark:text-white rounded-3xl  border border-gray-300 py-3 pr-12 px-3"
                                        placeholder="اسم محصول را وارد کنید ....">
                                    <button class="bg-primary-grad  p-2 text-white rounded-3xl absolute right-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </section>

                    </section>
                </aside>


                <!-- products -->
                <section class="lg:col-span-4 col-span-4 w-full">
                    <div class="grid grid-cols-12 gap-4 place-items-center">

                    @if (count($relatedProduct))
                    @foreach ($relatedProduct as $content)
                        <div class="lg:col-span-3 md:col-span-6 col-span-12 w-full">
                            <article
                                class="bg-white product-box-item drop-shadow-md rounded-xl p-4 dark:bg-card-dark dark:border-white dark:border-1"
                                >

                                <figure class="flex image justify-center my-4">
                                    <a href="{{ $content->slug }}" >
                                        <img class="{{ $content->gallery->count() ? 'one-image' : '' }} " src="{{ image_or_placeholder($content->images['images']['small']) }}" loading="lazy"
                                            alt="{{ $content->title }}" >
                                        @foreach ($content->gallery as $gallery)
                                            <img class="two-image" src="{{ image_or_placeholder($gallery->images['images']['small']) }}" loading="lazy">
                                        @endforeach
                                    </a>
                                </figure>
                                <h3 class="text-base leading-8  line-clamp-2 mb-2 text-center">
                                    <a href="{{ $content->slug }}" class="text-gray-800 dark:text-white">{{ $content->title }}</a>
                                </h3>

                            </article>
                        </div>
                    @endforeach
                    @endif


                    </div>
                </section>

            </div>
            @if (count($relatedProduct))
            {{ $relatedProduct->links('it-times-store.pagination') }}
            @endif



            <!-- description category -->
            @if (!Request::get('page'))
            <div
                class="p-5 bg-white dark:bg-background-dark dark:text-white rounded-xl tab-content border border-gray-300 drop-shadow">
                <div class="space-y-5">
                    <h2
                        class="text-2xl pb-3 font-black text-zinc-800 relative before:absolute before:bottom-0 before:right-0 before:h-1 before:w-22 before:bg-primary-500 before:rounded dark:text-white">
                        دسته بندی {{ $detail->title }}
                    </h2>
                    <div class="text-neutral-700 leading-11 [&_h2]:text-[#d35400] [&_h2]:text-2xl/15 [&_a]:text-[#d35400] overflow-auto text-justify text-lg dark:text-white">
                    @if (count($table_of_content))
                    <ul>
                        @foreach ($table_of_content as $key => $item)
                            <li class="toc1">
                                <a href="#{{ $item['anchor'] }}">✅ {{ $item['label'] }}</a>
                            </li>
                        @endforeach

                    </ul>

                    @endif
                    @include(@env('TEMPLATE_NAME') . '.DescriptionModule')

                    </div>
                </div>
            </div>
            @endif




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


                    </div>


                </div>
            </main>

        </div>
    </section>
    <!-- ================= end content section ================= -->







@endsection

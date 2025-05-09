@extends(@env('TEMPLATE_NAME') . '.App')



@section('meta-title', $detail->title)
@section('meta_description', $detail->title)

@section('twitter:title', $detail->title)
@section('twitter:description', clearHtml($detail->description))

@section('og:title', $detail->title)
@section('og:description', clearHtml($detail->description))
@section('canonical', url($detail->slug))


@if (isset($detail->images['images']['medium']))
@section('twitter:image', url($detail->images['images']['medium']))

@section('og:image', url($detail->images['images']['medium']))
@section('og:image:type', 'image/jpeg')
@section('og:image:width', $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W'))
@section('og:image:height', $detail->attr_type == 'article' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H'))
@section('og:image:alt', $detail->title)

@endif



@section('Content')

    @include('jsonLdWebsite')


    <!-- ================= start content section ================= -->
    <section class="py-5">
        <div class="container">
            <!-- breadcrumb -->
            <nav class="flex mt-2 mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse" itemscope
                    itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="/"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white"
                            itemprop="item">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            <span itemprop="name">خانه</span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>

                    @foreach ($breadcrumb as $key => $item)
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 9 4-4-4-4" />
                                </svg>
                                <a href="{{ $item['slug'] }}"
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
                                    itemprop="item">
                                    <span itemprop="name">{{ $item['title'] }}</span>
                                </a>
                            </div>
                            <meta itemprop="position" content="2">
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


            <!-- products -->
            <div class="grid gap-4 grid-cols-4">


                <!-- products -->
                <section class="lg:col-span-4 col-span-4 w-full">
                    <div class="grid grid-cols-12 gap-4 place-items-center">

                        @if (count($products))
                            @foreach ($products as $content)
                                <div class="lg:col-span-3 md:col-span-6 col-span-12 w-full">
                                    <article class="bg-white product-box-item drop-shadow-md rounded-xl p-4
                                                                    dark:bg-card-dark dark:border-white dark:border-1">

                                        <figure class="flex image justify-center my-4">
                                            <a href="{{ $content->slug }}" itemprop="url">
                                                <img class="one-image"
                                                    src="{{ image_or_placeholder($content->images['images']['small']) }}"
                                                    loading="lazy" alt="گوشی موبایل اپل آیفون 13 پرو مکس" itemprop="image">
                                                @foreach ($content->gallery as $gallery)

                                                    <img class="two-image"
                                                        src="{{ image_or_placeholder($gallery->images['images']['small']) }}"
                                                        loading="lazy">
                                                @endforeach
                                            </a>
                                        </figure>
                                        <h3 class="text-base leading-8  line-clamp-2 mb-2">
                                            <a href="{{ $content->slug }}" class="text-gray-800 dark:text-white"
                                                itemprop="name">{{ $content->title }}</a>
                                        </h3>

                                    </article>
                                </div>
                            @endforeach
                        @endif


                    </div>
                </section>

            </div>







        </div>
    </section>
    <!-- ================= end content section ================= -->




    <div class="container !px-0 my-10">
    <h2 class="text-2xl font-bold  dark:text-white mb-4">مقالات</h2>
        <div class="flex flex-col xl:flex-row gap-4">
            <!-- Articles -->
            <div class="w-full">
                <!-- article -->
                <div class="grid grid-cols-1 xl:grid-cols-5 md:grid-cols-2 gap-4">

                    @foreach ($posts as $content)
                        <div class="space-y-3 px-1.5 py-2">
                            <a href="{{ $content->slug }}" class="w-full block" itemprop="url">
                                <article
                                    class="p-4 space-y-3 rounded-xl hover:-translate-y-2 transition border border-gray-200 bg-white drop-shadow-md dark:bg-background-dark">
                                    <figure class="text-center block py-4" itemprop="image" itemscope
                                        itemtype="https://schema.org/ImageObject">
                                        <img src="{{ image_or_placeholder($content->images['images']['large'] ?? '') }}"
                                            class="h-50 rounded-xl w-full block mx-auto object-cover"
                                            itemprop="contentUrl">
                                    </figure>
                                    <section class="space-y-5">
                                        <div class="space-y-4">
                                            <h4
                                                class="relative before:right-0 before:z-[-1] before:rounded-lg before:bg-gray-300 before:absolute before:top-1/2 before:h-px before:w-full before:-translate-y-1/2">
                                                <span class="bg-secondary text-sm rounded text-white px-3 dark:bg-secondary-300"
                                                    itemprop="articleSection">{{ $content->category['title'] ?? '' }}</span>
                                            </h4>
                                            <h2 class="text-xl line-clamp-1 font-bold dark:text-white" itemprop="headline">{{ $content->title }}</h2>
                                        </div>
                                        <div class="flex mt-8 flex-wrap justify-between items-center">
                                            <div class="flex items-center" itemprop="datePublished" content="2024-03-02">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <time class="mr-2 dark:text-white">{{ convertGToJ($content->updated_at) }}</time>
                                            </div>
                                            <div class="flex items-center" itemprop="interactionStatistic" itemscope
                                                itemtype="https://schema.org/InteractionCounter">
                                                <meta itemprop="interactionType" content="https://schema.org/WatchAction">
                                                <meta itemprop="userInteractionCount" content="128">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6 dark:text-white">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                                <time class="mr-2 dark:text-white">{{ $content->viewCount }} بازدید</time>
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
    </div>








@endsection

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

@section('bootstrap')
    <link rel="stylesheet" href="{{ asset('bootstrap.css')}}">
@endsection

@section('footer')
    @auth
        @if (Auth::user()->id == 1)
            <div class="fixed top-0 right-0 z-50 bg-blue-500 py-2 px-3 rounded-bl text-white"
                onclick="window.open('{{ url('/admin/contents/' . $detail->id . '/edit/') }}')">
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
        @include('it-times-store.jsonLdProduct')
    @endif
    @include('jsonLdFaq')

    @if ($detail->attr_type == 'article')
        @include('jsonLdArticle')
    @endif

    @if (count($breadcrumb) > 0)
        @include('jsonLdBreadcrumb')
    @endif




    <!-- ================= start content section ================= -->
    <section class="py-5">
        <div class="container">
            <!--Original content-->
            <main class="container !px-0 my-10">
                <div class="flex flex-col xl:flex-row gap-4">
                    <!-- Articles -->
                    <div class="xl:w-3/4 bg-white rounded-xl shadow-md overflow-hidden">
                        <!--The main image of the article-->
                        <img src="{{ image_or_placeholder($detail->images['images']['large']) }}" alt="{{ $detail->title }}"
                            class="w-full h-64 md:h-96 object-cover">

                        <!--Header of the article-->
                        <div class="p-6 md:p-8 dark:bg-card-dark">
                            <div class="flex flex-wrap items-center justify-between mb-6">
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm text-gray-500">{{ $detail->publish_date }}</span>
                                </div>

                            </div>

                            <h1
                                class="text-2xl md:text-3xl  border-b border-gray-200 font-bold text-gray-800 mb-6 pb-6 dark:text-white">
                                {{ $detail->title }}
                            </h1>


                            <!--Content of the article-->
                            <div class="article-content text-gray-700 dark:text-gray-300 [&_a]:text-primary-600">
                                <ul class="">
                                    @foreach ($table_of_content as $key => $item)
                                        <li class="toc1 ">
                                            <a class="" id="test" href="#{{ $item['anchor'] }}">✅ {{ $item['label'] }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                                @include(@env('TEMPLATE_NAME') . '.DescriptionModule')
                            </div>






                            <!-- Comments -->
                            <div class="mt-12">
                                <h3
                                    class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200 dark:text-gray-300">
                                    نظرات کاربران ({{ $detail->comments->filter(fn($c) => $c->name && $c->comment)->count() }})</h3>

                                <form action="{{ route('comment.client.store') }}#comment" method="post" id="comment"
                                    class="mb-8">
                                    <input type="hidden" name="content_id" value="{{ $detail->id }}">
                                    @csrf
                                    @if ($errors->comment_error->has('rate'))
                                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-3 rounded">
                                            {{ $errors->comment_error->first('rate') }}
                                        </div>
                                    @endif
                                    @if (\Session::has('comment_success'))
                                        <div class="bg-lime-100 border border-lime-400 text-lime-700 px-4 py-3 mb-3 rounded">
                                            {!! \Session::get('comment_success') !!}
                                        </div>
                                    @endif


                                    @if (\Session::has('comment_error'))
                                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                            {!! \Session::get('comment_error') !!}
                                        </div>
                                    @endif
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label value="{{ old('name') }}" for="name" class="mb-3 inline-block">نام و نام
                                                خانوادگی:</label>
                                            <input id="name" name="name" value="{{ old('name') }}" type="text"
                                                placeholder="نام خود را وارد کنید"
                                                class="w-full px-3 py-4 border-gray-300 border rounded-lg">
                                        </div>

                                    </div>
                                    <div class="mb-4">
                                        <label class="block mb-4">امتیاز شما:</label>
                                        <div class="flex space-x-2">
                                            <input type="radio" id="star1" name="rate" class="hidden" value="1" {{ old('rate') == '1' ? 'checked' : '' }}>
                                            <label for="star1" class="cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-6 text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03z" />
                                                </svg>
                                            </label>

                                            <input type="radio" id="star2" name="rate" class="hidden" value="2" {{ old('rate') == '2' ? 'checked' : '' }}>
                                            <label for="star2" class="cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-6 text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03z" />
                                                </svg>
                                            </label>

                                            <input type="radio" id="star3" name="rate" class="hidden" value="3" {{ old('rate') == '3' ? 'checked' : '' }}>
                                            <label for="star3" class="cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-6 text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03z" />
                                                </svg>
                                            </label>

                                            <input type="radio" id="star4" name="rate" class="hidden" value="4" {{ old('rate') == '4' ? 'checked' : '' }}>
                                            <label for="star4" class="cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-6 text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03z" />
                                                </svg>
                                            </label>

                                            <input type="radio" id="star5" name="rate" class="hidden" value="5" {{ old('rate') == '5' ? 'checked' : '' }}>
                                            <label for="star5" class="cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-6 text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03z" />
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                    <textarea id="comment" name="comment" placeholder="نظر خود را بنویسید..."
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                        rows="3">{{ old('comment') }}</textarea>
                                    <button type="submit"
                                        class="mt-3 bg-primary-600 hover:bg-primary-700 text-white py-2 px-6 rounded-lg transition duration-300">ارسال
                                        نظر</button>
                                </form>

                                <div class="space-y-6">

                                    @foreach ($detail->comments as $comment)
                                        @if ($comment['name'] != '' && $comment['comment'] != '')
                                            <div class="flex items-start space-x-3">

                                                <div class="w-full">
                                                    <div class=" bg-gray-50 dark:bg-zinc-900 p-4 rounded-lg">
                                                        <div class="flex justify-between items-start">
                                                            <h4 class="font-medium text-gray-800 dark:text-gray-300">{{ $comment['name'] }}
                                                            </h4>
                                                            <span class="text-xs text-gray-500 dark:text-gray-300">{{ convertGToJ($comment['created_at']) }}</span>
                                                        </div>
                                                        <p class="mt-1  text-gray-700 dark:text-gray-300">{!! $comment['comment'] !!}</p>
                                                    </div>

                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- sidebar -->
                    <aside class="xl:w-1/4 relative">
                        <div class="space-y-8 sticky top-0">


                            <!--Popular articles-->
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md transition-colors duration-200">
                                <h3
                                    class="font-bold dark:text-white text-lg mb-4 relative pb-4 before:absolute before:right-0 before:bottom-0 before:size-2 before:rounded-full before:bg-primary after:absolute after:w-40 after:h-2 after:bottom-0 after:right-4 after:bg-primary after:rounded-lg">
                                    مقالات پرطرفدار</h3>
                                <div class="space-y-4">

                                    @foreach ($relatedPost as $content)
                                        <a href="{{ $content->slug }}" class="flex items-start space-x-3 group">
                                            <img  src="{{ image_or_placeholder($content->images['images']['small']) }}"
                                                alt="{{ $content->title }}" class="w-16 h-16 object-cover rounded-lg ">
                                            <div>
                                                <h4
                                                    class="text-sm font-medium text-gray-800 dark:text-gray-200 group-hover:text-primary-600 dark:group-hover:text-primary-400">
                                                    {{ $content->title }}
                                                </h4>
                                                <span
                                                    class="text-xs text-gray-500 dark:text-gray-400">{{ convertGToJ($content->publish_date) }}</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>


                        </div>
                    </aside>
                </div>
            </main>

        </div>
    </section>
    <!-- ================= end content section ================= -->


@endsection

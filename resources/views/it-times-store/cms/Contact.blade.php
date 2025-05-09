@extends(@env('TEMPLATE_NAME') . '.App')

@section('head')
    <meta property="og:image" content="{{ url($detail->images['images']['medium'] ?? '') }}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W') }}" />
    <meta property="og:image:height"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H') }}" />
    <meta property="og:image:alt" content="{{ $detail->title }}" />
@endsection

@section('Content')
    @php
        $tableOfImages = tableOfImages($detail->description);
        $append = '';
    @endphp
    @if (count($relatedProduct))
        @include('jsonLdRelatedProduct')
    @endif


    <!-- ================= start content section ================= -->
    <section class="py-5">
        <div class="container">
            <!-- Page title -->
            <div class="mb-12 md:mb-16">
                <span
                    class="inline-block px-4 py-2 bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 rounded-full text-sm font-medium mb-4">ارتباط
                    با ما</span>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">با ما در تماس
                    باشید</h1>
                <p class="text-lg text-gray-600 dark:text-slate-400">تیم پشتیبانی ما آماده پاسخگویی به سوالات و دریافت
                    پیشنهادهای شماست</p>
            </div>

            <!-- Main contact section -->
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Contact form -->
                <div class="contact-card rounded-2xl p-6 md:p-8 shadow-soft dark:shadow-soft-dark">
                    <h2
                        class="font-bold dark:text-light text-xl mb-4 flex items-center space-x-3 relative pb-4 before:absolute before:right-0 before:bottom-0 before:size-2 before:rounded-full before:bg-primary after:absolute after:w-40 after:h-2 after:bottom-0 after:right-4 after:bg-primary after:rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 text-primary-600 dark:text-primary-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        پیام خود را ارسال کنید
                    </h2>

                    <form action="{{ route('contact.store') }}" method="post" class="space-y-6">
                        @csrf
                        @if (\Session::has('success'))
                            <div class="alert alert-success ">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        @if (\Session::has('error'))
                            <div class="alert alert-danger ">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            </div>
                        @endif

                        <!-- Name -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">نام کامل</label>
                                <input type="text" id="name" placeholder="نام"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary-500 dark:bg-gray-800 dark:text-white transition"
                                    required>
                            </div>

                            <div>
                                <label for="lastname"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1"> نام
                                    خانوادگی</label>
                                <input type="text" id="lastname" placeholder=" نام خانوادگی"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary-500 dark:bg-gray-800 dark:text-white transition"
                                    required>
                            </div>
                        </div>



                        <!-- Message -->
                        <div>
                            <label for="message"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">پیام شما</label>
                            <textarea id="message" rows="5" placeholder="متن پیام خود را بنویسید..."
                                class="w-full px-4 py-3 border placeholder-gray-500 border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary-500 dark:bg-gray-800 dark:text-white transition"
                                required></textarea>
                        </div>

                        <!-- Submit button -->
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium rounded-xl hover:opacity-90 transition duration-200 shadow-md shadow-primary-500/20">
                            ارسال پیام
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </form>

                </div>

                <!-- Contact information -->
                <div class="space-y-6">
                    <div class="contact-card rounded-2xl p-6 md:p-8 shadow-soft dark:shadow-soft-dark">
                        <h2
                            class="font-bold dark:text-light text-xl mb-4 flex items-center space-x-3 relative pb-4 before:absolute before:right-0 before:bottom-0 before:size-2 before:rounded-full before:bg-primary after:absolute after:w-40 after:h-2 after:bottom-0 after:right-4 after:bg-primary after:rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 ml-2 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            اطلاعات تماس
                        </h2>

                        <div class="space-y-5">
                            <div class="flex items-start">
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-primary-600 dark:text-primary-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="mr-3">
                                    <h3 class="font-bold text-lg mb-1 text-gray-800 dark:text-slate-200">آدرس فروشگاه</h3>
                                    <p class="text-gray-600 dark:text-slate-400">تهران - خیابان جمهوری - تقاطع حافظ - ساختمان امجد - طبقه سوم - واحد 16 ( فروشگاه عصر آی تی )</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-primary-600 dark:text-primary-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div class="mr-3">
                                    <h3 class="font-bold text-lg mb-1 text-gray-800 dark:text-slate-200">تلفن‌های تماس</h3>
                                    <p class="text-gray-600 dark:text-slate-400">021-66740231</p>
                                    <p class="text-gray-600 dark:text-slate-400">021-66740232</p>
                                    <p class="text-gray-600 dark:text-slate-400">021-66717523</p>
                                    <p class="text-gray-600 dark:text-slate-400">021-66740172</p>
                                    <p class="text-gray-600 dark:text-slate-400">021-66740447</p>
                                    <p class="text-gray-600 dark:text-slate-400">0912-8210151</p>
                                </div>
                            </div>


                        </div>
                    </div>

                    <!-- Working hours -->
                    <div class="contact-card rounded-2xl p-6 md:p-8 shadow-soft dark:shadow-soft-dark">
                        <h2
                            class="font-bold dark:text-light text-xl mb-4 flex items-center space-x-3 relative pb-4 before:absolute before:right-0 before:bottom-0 before:size-2 before:rounded-full before:bg-primary after:absolute after:w-40 after:h-2 after:bottom-0 after:right-4 after:bg-primary after:rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 ml-2 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            ساعات کاری
                        </h2>

                        <div class="space-y-4">
                            <div
                                class="flex justify-between items-center pb-4 border-b border-gray-200 dark:border-slate-700">
                                <span class="font-medium text-gray-800 dark:text-slate-200">شنبه تا پنجشنبه</span>
                                <span class="text-gray-600 dark:text-slate-400">۹:۳۰ صبح - ۱۹:۰۰ عصر</span>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <!-- <div class="mt-12 md:mt-16 rounded-2xl overflow-hidden shadow-soft dark:shadow-soft-dark">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3239.676621075215!2d51.38882131526982!3d35.7323439801875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzXCsDQzJzU2LjQiTiA1McKwMjMnMjMuNiJF!5e0!3m2!1sen!2s!4v1620000000000!5m2!1sen!2s"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    class="dark:grayscale-[50%] dark:opacity-90 transition"></iframe>
            </div> -->
        </div>
    </section>
    <!-- ================= end content section ================= -->


@endsection

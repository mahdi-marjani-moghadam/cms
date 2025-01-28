<section id="footer">
    <div class="footer-links py-4 ">
        <ul class="flex flex-wrap justify-center  gap-5 [&>li]:border-l [&>li]:border-gray-400 [&>li]:pl-3 [&>li]:mb-0 [&>li]:leading-none">
            <li><a href="/مقاله-ها">مقالات</a></li>
            <li><a href="/وب-سایت">معرفی وبسایت ها</a></li>
            <li><a href="/کمپانی">کمپانی ها</a></li>
            <li><a href="/تماس-با-ما">تماس با ما</a></li>
            <li><a href="/درباره-ما">درباره ما</a></li>
            <li><a href="/تبلیغات">تعرفه تبلیغات</a></li>
            <li><a href="/ساخت-صفحه-اختصاصی">ساخت صفحه اختصاصی</a></li>
            <li><a href="/ثبت-آگهی-در-کمپانی-ها">ثبت آگهی در کمپانی ها</a></li>
            <li class="border-none"><a href="/رپورتاژ">رپورتاژ</a></li>
        </ul>
    </div>
</section>
<section class="footer-copyright mt-0">
    <div class="container">
        <div class="flex one">
            <div class="text-center">
                <div>ویژن شرکت کریپو
                    ایجاد پلتفرم تبلیغاتی و آگهی می باشد.
                    ساخته شده توسط <a target="_blanck" href="https://dingweb.ir"> دینگ وب </a></div>
            </div>
        </div>
    </div>
</section>
@yield('footer')
@yield('cropper')
@stack('scripts')


@if (WebsiteSetting::where('variable', '=', 'phone')->first()?->value != '' && ($showcallnowbutton ?? 1))
    <a href="tel:{{ WebsiteSetting::where('variable', '=', 'phone')->first()->value }}" id="callnowbutton"></a>
@endif

@if (url('/') == 'https://corepo.ir')
    <!-- Google Tag Manager -->
    <script async>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PVTXH97');
    </script>
    <!-- End Google Tag Manager -->
@endif

</body>

</html>

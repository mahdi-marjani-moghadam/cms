@php
// function minifyHtml($html) {
//     $html = preg_replace('/>\s+</', '><', $html); // حذف فاصله بین تگ‌ها
//     $html = preg_replace('/\s{2,}/', ' ', $html); // حذف فاصله‌های اضافی
//     return trim($html);
// }
@endphp

@php
// ob_start()
@endphp
@include(@env('TEMPLATE_NAME').'.Head')

@include(@env('TEMPLATE_NAME').'.Nav')
@yield('Content')

@include(@env('TEMPLATE_NAME').'.Footer')
@php
/*
{!!  minifyHtml(ob_get_clean()) !!}
*/ @endphp

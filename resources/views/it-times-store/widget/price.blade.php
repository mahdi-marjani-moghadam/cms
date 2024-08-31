@if (env('SHOP', false) || env('ORDER_IF_PRICE_ZERO', false))
<div class=" text-green font-09 ">
    @if(isset($content->attr['weight']))
        @convertCurrency($content->GoldPrice()['totalPrice']) تومان
    @elseif(isset($content->attr['price']))
        @convertCurrency($content->attr['price']) تومان
    @elseif(env('ORDER_IF_PRICE_ZERO', false))
        ثبت سفارش
    @else
    تماس گرفته شود
    @endif
</div>
@endif


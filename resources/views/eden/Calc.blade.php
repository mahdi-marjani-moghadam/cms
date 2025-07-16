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





    @if (count($breadcrumb))
        <section class="breadcrumb my-0 py-0">
            <div class="flex one  ">
                <div class="p-0">
                    <a href="/">خانه </a>
                    @foreach ($breadcrumb as $key => $item)
                        <span>></span>
                        <a title="{{ $item['title'] }}" href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                    @endforeach

                </div>
            </div>
        </section>
    @endif



    <section>
        <form action="{{ route('calc') }}" class=" " method="post">
            <h1 class="text-center">{{ $calculate }} تومان</h1>
            @csrf
            <div class="one gap-2 grid grid-cols-[80px_1fr] text-left [&>div]:text-right m-auto" style="max-width: 500px;" >

                <label for="">
                    قیمت طلا
                </label>
                <div class="">
                    <input name="tala" type="text" class="p-2" value="{{ getGoldPrice()['priceToman'] }}">
                    تومان
                </div>
                <label for="">
                    وزن
                </label>
                <div>
                    <input name="weight" style="border-color: red;" type="text" class="p-2" value="{{ old('weight') }}">
                    گرم  = ({{ number_format($gold,0).' تومان' ?? ''}})
                </div>
                <label for="">
                    اجرت
                </label>
                <div>
                    <input name="ojrat" type="text" class="p-2" value="{{ old('ojrat', 18) }}">
                    درصد = ({{ number_format($ojrat,0).' تومان' ?? ''}})
                </div>
                <label for="">
                    سود
                </label>
                <div>
                    <input name="sood" type="text" class="p-2" value="{{ old('sood', 7) }}">
                    درصد  = ({{ number_format($sood,0).' تومان' ?? ''}})
                </div>
                <label for="">
                    خرج کار
                </label>
                <div>
                    <input name="additionalPrice" type="text" class="p-2" value="{{ old('additionalPrice', 0) }}">
                    تومان
                </div>
                <label for="">
                    مالیات
                </label>
                <div>
                    <input name="tax" type="text" class="p-2" value="{{ old('tax', 9) }}">
                    درصد = ({{ number_format($tax,0).' تومان' ?? ''}})
                </div>
                <br>
                <button class="bg-lime-700  !text-white  p-3 rounded-md  m-auto">محاسبه</button>
            </div>

        </form>
    </section>







@endsection

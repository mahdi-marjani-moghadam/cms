@extends(@env('TEMPLATE_NAME') . '.App')
@section('meta-title', 'معاملات')

@section('Content')
    <section class="panel">
        @include('auth.customer.nav')

        <div class="list">
            <h1 class="">معاملات </h1>
            <div class="border px-4 py-2 mb-4 bg-amber-100">
                @php
                    $balance = $customer->getWalletBalances();
                @endphp
                موجودی طلا: {{ $balance['gold'] }} گرم 
            </div>
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    {!! \Session::get('success') !!}
                </div>
            @endif

            @if (\Session::has('error'))
                <div class="alert alert-danger">

                    {!! \Session::get('error') !!}
                </div>
            @endif
            @isset($trades)

                <div class="overflow-auto ">
                    <div class="mx-[1px] grid grid-cols-[40px_200px_100px_150px_150px_250px] [&>div]:px-4 [&>div]:py-2 font-bold">
                        <div class="border">#</div>
                        <div class="border">نوع</div>
                        <div class="border">مقدار طلا</div>
                        <div class="border">قیمت هر گرم</div>
                        <div class="border">مبلغ کل</div>
                        <div class="border">تاریخ</div>
                    </div>
                    @foreach ($trades as $item)
                        <div class="mx-[1px] grid grid-cols-[40px_200px_100px_150px_150px_250px] [&>div]:px-4 [&>div]:py-2">
                            <div class="border">{{ $item->id }}</div>
                            <div class="border">
                                @switch($item->type)
                                    @case('buy')
                                        خرید آنلاین
                                        @break
                                    @case('sell')
                                        فروش
                                        @break
                                    @case('admin_add')
                                        افزوده شده توسط ادمین
                                        @break
                                    @case('admin_deduct')
                                        کسر شده توسط ادمین
                                        @break
                                    @case('order_deduct')
                                        کسر از سفارش
                                        @break
                                    @case('refund')
                                        برگشت
                                        @break
                                    @default
                                        {{ $item->type }}
                                @endswitch
                            </div>
                            <div class="border">{{ number_format($item->gold_amount, 3) }} گرم</div>
                            <div class="border">@convertCurrency($item->gold_price) تومان</div>
                            <div class="border">@convertCurrency($item->total_price) تومان</div>
                            <div class="border">{{ convertGtoJ($item->created_at, true) }}</div>
                        </div>
                    @endforeach
                    {{ $trades->links() }}
                </div>
                <div class="align-center">
                    @if (count($trades) == 0)
                        @lang('messages.not found')
                    @endif
                </div>
            @endisset


        </div>
    </section>

@endsection

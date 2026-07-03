@extends(@env('TEMPLATE_NAME') . '.App')
@section('meta-title', 'صندوق طلا')

@section('Content')
    <section class="panel">
        @include('auth.customer.nav')

        <div class="list">
            <div class=" text-center ">
                <img class="m-auto" src="{{ url(env('TEMPLATE_NAME') . '/img/gold-wallet.jpg') }}" alt="gold wallet icon"
                    height="100" width="100">
                صندوق طلا
                @php
                    $balance = $customer->getWalletBalances();
                @endphp

                <div class="font-bold text-5xl mt-2 mb-8">
                    {{ number_format($balance['gold'], 3) }} گرم
                </div>
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
            @isset($gold_wallet)

                <div class="lg:w-fit overflow-auto lg:mx-auto text-center mx-[1px] grid grid-cols-[150px_200px_200px_250px_250px] [&>div]:px-4 [&>div]:py-2">
                    <div class="border border-gray-300 font-bold bg-gray-200">مقدار طلا (گرم)</div>
                    <div class="border border-gray-300 font-bold bg-gray-200">قیمت هر گرم</div>
                    <div class="border border-gray-300 font-bold bg-gray-200">مبلغ کل</div>
                    <div class="border border-gray-300 font-bold bg-gray-200">تاریخ</div>
                    <div class="border border-gray-300 font-bold bg-gray-200">توضیحات</div>

                    @foreach ($gold_wallet as $transaction)

                        <div class="text-center font-bold border ltr {{ $transaction->operation == 'deposit' ? 'text-green-800' : 'text-red-800' }}">{{ $transaction->operation == 'deposit' ? '+' : '-' }}
                            {{ number_format($transaction->amount, 3) }}
                        </div>
                        <div class="border text-center">
                            @switch($transaction->reference_type)
                                @case(\App\Models\Trade::class)
                                    @convertCurrency($transaction->asset_price) تومان
                                    @break
                                @case(\App\Models\Order::class)
                                    @convertCurrency($transaction->reference()->first()?->orderDetail()->first()->attributes['gold_price']) تومان
                                    @break
                                @default
                                    @convertCurrency($transaction->asset_price ) تومان
                                    @break
                            @endswitch
                        </div>
                        <div class="border text-center">


                                @switch($transaction->reference_type)
                                    @case(\App\Models\Trade::class)
                                        @convertCurrency($transaction->asset_price * $transaction->amount) تومان
                                        @break

                                    @case(\App\Models\Order::class)
                                        @convertCurrency($transaction->reference()->first()?->total_price) تومان
                                        @break

                                    @default
                                        @convertCurrency($transaction->asset_price * $transaction->amount) تومان
                                        @break
                                @endswitch
                        </div>
                        <div class="border">{{ convertGtoJ($transaction->created_at, true) }}</div>
                        <div class="border">
                            @if ($transaction->description)
                                {{ ($transaction->description) }}
                            @else
                                @switch($transaction->reference_type)
                                    @case(\App\Models\Trade::class)
                                        صندوق طلا
                                        @break
                                    @case(\App\Models\Order::class)
                                        سفارش
                                        @break
                                    @default
                                        توسط ادمین
                                        @break
                                @endswitch
                            @endif
                        </div>

                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $gold_wallet->links('pagination::default') }}
                </div>
                <div class="align-center">
                    @if (count($gold_wallet) == 0)
                        @lang('messages.not found')
                    @endif
                </div>
            @endisset


        </div>
    </section>

@endsection

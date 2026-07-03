@extends(@env('TEMPLATE_NAME') . '.App')
@section('meta-title', 'پرداختی ها')

@section('Content')
    {{-- <link href="{{ url('/adminAssets/css/font-awesome.min.css') }}" rel="stylesheet"> --}}


    <section class="panel">
        @include('auth.customer.nav')

        <div class="list">
            <h1 class="">کیف پول </h1>
            <div class="border px-4 py-2 mb-4 bg-amber-100">
                @php
                    $balance = $customer->getWalletBalances();
                @endphp
                موجودی طلا: {{ $balance['gold'] }} گرم <br>
                موجودی:  @convertCurrency($balance['toman']) تومان
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
            @isset($wallet)

                <div class="overflow-auto ">
                    @foreach ($wallet as $content)

                            <div class="mx-[1px] grid grid-cols-[40px_150px_120px_250px_1fr] [&>div]:px-4 [&>div]:py-2">
                                <div class="border">{{ $content->id }}</div>



                                <div class="border">
                                    @switch($content->wallet_type)
                                        @case('gold')
                                           {{ number_format($content->amount, 3) }} گرم
                                            @break

                                        @default
                                            @convertCurrency($content->amount) @lang('messages.toman')
                                    @endswitch
                                </div>

                                <div class="border">
                                    @switch($content->operation)
                                        @case('deposit')
                                            افزایش اعتبار
                                            @break
                                        @case('withdraw')
                                            کسر از اعتبار
                                            @break
                                        @case('purchase')
                                            خرید
                                            @break
                                        @case('refund')
                                             برگشت پول
                                            @break
                                        @case('adjustment')
                                            اصلاح
                                            @break
                                        -
                                        @default
                                    @endswitch
                                </div>

                                <div class="border">
                                    {{ convertGtoJ($content->created_at,true) }}
                                </div>
                                <div class="border">
                                    {{ $content->message }}
                                </div>
                            </div>
                    @endforeach
                    <div class="mt-4">
                        {{ $wallet->links('pagination::default') }}
                    </div>
                </div>
                <div class="align-center">
                    @if (count($wallet) == 0)
                        @lang('messages.not found')
                    @endif
                </div>
            @endisset


        </div>
    </section>

@endsection

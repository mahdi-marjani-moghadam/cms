@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.customer.index') }}">مشتریان</a></li>
            <li class="active">افزایش موجودی طلا</li>
        </ul>
    </div>

    <div class="content-body" style="background-color: white; padding: 2em;">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul><li>{!! \Session::get('success') !!}</li></ul>
            </div>
        @endif

        @if (\Session::has('error'))
            <div class="alert alert-danger">
                <ul><li>{!! \Session::get('error') !!}</li></ul>
            </div>
        @endif

        <div class="panel" style="max-width: 500px; margin: auto;">
            <div class="panel-body">
                <h3>افزایش موجودی طلا</h3>
                <div class="border rounded p-3 mb-4 bg-slate-100" style="margin:  20px 0;">
                    <strong>مشتری:</strong> {{ $customer->name }}<br>
                    <strong>موجودی فعلی طلا:</strong> {{ number_format($balance['gold'], 3) }} گرم<br>
                    <strong>موجودی فعلی تومان:</strong> @convertCurrency($balance['toman']) تومان
                </div>

                <form method="post" action="{{ route('admin.customer.addGold.store', $customer) }}">
                    @csrf
                    <div class="form-group">
                        <label>مقدار طلا (گرم) *</label>
                        <input type="number" step="0.001" min="0.001" name="amount" required
                            class="form-control" placeholder="مثلاً 2">
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>کارمزد *</label>
                        <input type="number" step="0.1" min="0" name="fee" required
                            class="form-control" placeholder="مثلاً 0.5 موقع خرید از مشتری میگیرم">
                        @error('fee')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>عملیات *</label>
                        <select class="form-control" name="operation" id="">
                            <option value="deposit">افزایش</option>
                            <option value="withdraw">کاهش</option>
                        </select>

                        @error('fee')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>توضیحات</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="مثلاً: خرید کارت به کارت ۲ گرم"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">افزایش موجودی</button>
                    <a href="{{ route('admin.customer.index') }}" class="btn btn-default">انصراف</a>
                </form>
            </div>
        </div>
        <div style="margin-top:20px ;">
            @isset($gold_wallet)

                <table class="table table-striped ">
                    <tr>

                        <td class="border border-gray-300 font-bold bg-gray-200"></td>
                        <td class="border border-gray-300 font-bold bg-gray-200">مقدار طلا (گرم)</td>
                        <td class="border border-gray-300 font-bold bg-gray-200">قیمت هر گرم</td>
                        <td class="border border-gray-300 font-bold bg-gray-200">مبلغ کل</td>
                        <td class="border border-gray-300 font-bold bg-gray-200">تاریخ</td>
                        <td class="border border-gray-300 font-bold bg-gray-200">توضیحات</td>
                    </tr>

                    @foreach ($gold_wallet as $transaction)
                        <tr>
                        <td>{{ $transaction->id }}</td>

                        <td class="text-center font-bold border ltr {{ $transaction->operation == 'deposit' ? 'text-green-800' : 'text-red-800' }}">{{ $transaction->operation == 'deposit' ? '+' : '-' }}
                            {{ number_format($transaction->amount, 3) }}
                        </td>
                        <td class="border text-center">
                            @switch($transaction->reference_type)
                                @case(\App\Models\Trade::class)
                                    @convertCurrency($transaction->asset_price) تومان
                                    @break
                                @case(\App\Models\Order::class)
                                    @convertCurrency($transaction->reference()->first()?->orderDetail()->first()->attributes['gold_price']) تومان
                                    @break
                                @default
                                    @convertCurrency($transaction->asset_price) تومان
                                    @break
                            @endswitch
                        </td>
                        <td class="border text-center">


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
                        </td>
                        <td class="border">{{ convertGtoJ($transaction->created_at, true) }}</div>
                        <td class="border">
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
                        </td>
                        </tr>
                    @endforeach
                </table>
                <div class="mt-4">
                    {!! $gold_wallet->appends(Request::except('page'))->onEachSide(5)->links() !!}
                </div>
                <div class="align-center">
                    @if (count($gold_wallet) == 0)
                        @lang('messages.not found')
                    @endif
                </div>
            @endisset
        </div>
    </div>
@endsection

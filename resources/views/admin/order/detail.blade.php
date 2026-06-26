@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">
                @lang('messages.order') #{{ $order->id }}
            </li>
            <li>
                {{ convertGtoJ($order->created_at, time: True) }}
                قیمت طلا @convertCurrency($list[0]->attributes['gold_price'] ?? 0)
            </li>
            <span>
                <div style="display:flex; gap:1em;">
                    @if ($order->status != 3 )
                        @php
                            $customer = $order->user?->customer;
                            $goldBalance = $customer?->getWalletBalances()['gold'] ?? 0;
                        @endphp
                        @if (!$order->orderDetail->contains(fn($detail) => (\App\Models\Content::find($detail->attributes['product_id'])->attr['in-stock'] ?? 0) == 0))

                            <form method="post" action="{{ route('admin.order.edit', $order) }}">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="status" value="3">
                                <button href="" class=" btn btn-sm btn-success btn-icon  mat-button " >
                                    <i class="fa fa-check"></i>@lang('messages.paid successfully')
                                </button>
                            </form>
                        @else
                            این فاکتور یکی محصولاتش موجود نیست
                        @endif
                        @if ($customer)
                            <form method="post" action="{{ route('admin.order.payGoldFund', $order) }}">
                                @csrf
                                <button type="submit" class=" btn btn-sm btn-icon  mat-button " style="border:1px solid #000; background-color: #f3f30c;"
                                    onclick="return confirm('پرداخت از صندوق طلا (موجودی: {{ number_format($goldBalance, 3) }} گرم)؟')">
                                    <i class="fa fa-btc"></i>پرداخت از صندوق طلا
                                </button>
                            </form>
                        @endif
                    @endif

                    @if ($order->status != -1)
                        <form method="post" action="{{ route('admin.order.edit', $order) }}">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="-1">
                            <button href="" class=" btn btn-sm btn-danger btn-icon  mat-button ">
                                <i class="fa fa-remove"></i>@lang('messages.unconfirm')
                            </button>
                        </form>
                    @endif

                </div>
            </span>
        </ul>

    </div>

    <div class="" style="padding:1em">
        <div class=" chat-panel bottom-0">
            <div class="panel-body full-height" style="padding: 0;">
                @php

                    $gp = $list[0]->attributes['gold_price'] ?? 1;
                    $total_sood = 0;
                    $totalGoldOrder = 0;
                    $total_additional = 0;
                    $total_ojrat = 0;
                    $total_tax = 0;
                    $totalGoldEquivalent = 0;
                    $firstDetail = $list->first();
                    $isAdminOrder = is_null($order->user_id);
                    $customerName = $isAdminOrder ? ($firstDetail?->attributes['customer_name'] ?? '-') : (($order->user->customer->name ?? '') . ' ' . ($order->user->customer->family ?? ''));
                    $customerMobile = $isAdminOrder ? ($firstDetail?->attributes['customer_mobile'] ?? '-') : ($order->user->mobile ?? '-');
                    $customerZip = $isAdminOrder ? ($firstDetail?->attributes['customer_zipcode'] ?? '-') : ($order->user->customer?->zipcode ?? '-');
                    $customerAddr = $isAdminOrder ? ($firstDetail?->attributes['customer_address'] ?? '-') : ($order->user->customer?->address ?? '-');
                @endphp



                @if ($order->status == 5)
                    <div class="alert alert-success">
                        @lang('messages.ready to send')
                    </div>
                @elseif ($order->status == 4)
                    <div class="alert alert-success">
                        @lang('messages.prepairing')
                    </div>
                @elseif ($order->status == 3)
                    <div class="alert alert-success">
                        وضعیت: @lang('messages.paid successfully')

                    </div>
                @elseif ($order->status == 2)
                    <div class="alert alert-warning">
                        وضعیت: فیش آپلود شده


                        @if (count($transactions))

                            @foreach ($transactions as $item)
                                @if (strpos($item->description, 'upload'))
                                    <div class="" style="display:flex; align-items: center; gap:1em; padding-top: 1em; ">

                                        <a class="btn " target="_blank" href="{{ url($item->description) }}">

                                            <img src="{{ url($item->description) }}" height="100" alt="">
                                            دانلود فیش :
                                            {{ convertGtoJ($item->created_at) }}
                                            وضعیت:
                                            @if ($item->status == 3)
                                                آپلود شده
                                            @elseif($item->status == 2)
                                                تایید شده
                                            @elseif($item->status == -1)
                                                رد شده
                                            @endif

                                        </a>
                                        @if ($item->status != 2)
                                            <form method="post" action="{{ route('admin.transaction.edit', $item) }}">
                                                @csrf
                                                @method('patch')
                                                <input type="hidden" value="2" name="status">
                                                <button href="" class=" btn btn-sm btn-success btn-icon  mat-button ">
                                                    <i class="fa fa-check"></i>تایید واریزی
                                                </button>
                                            </form>
                                        @endif
                                        @if ($item->status != -1)
                                            <form method="post" action="{{ route('admin.transaction.edit', $item) }}">
                                                @csrf
                                                @method('patch')
                                                <input type="hidden" value="-1" name="status">
                                                <button href="" class=" btn btn-sm btn-danger btn-icon  mat-button ">
                                                    <i class="fa fa-remove"></i>عدم واریزی
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                @elseif ($order->status == -1)
                    <div class="alert alert-danger">
                        @lang('messages.unconfirm')
                    </div>
                @else
                    <div class="alert alert-warning">
                        @lang('messages.order insert')
                    </div>
                @endif



                <div style="white-space: nowrap; background-color: white; padding: 1em 10px; border: 1px solid #ccc;display: flex;
                                    flex-wrap: wrap;">
                    <span>نام:</span>
                    <span style="font-weight: bold; ">{{ trim($customerName) ?: '-' }}</span>

                    <span style="margin: 0 10px;">|</span>

                    <span>موبایل:</span>
                    <span style="font-weight: bold;">{{ $customerMobile }}</span>

                    <span style="margin: 0 10px;">|</span>

                    <span>کد پستی:</span>
                    <span style="font-weight: bold;">{{ $customerZip }}</span>

                    <span style="margin: 0 10px;">|</span>

                    <span>آدرس:</span>
                    <span style="font-weight: bold;">{{ $customerAddr }}</span>
                </div>
                <br>









                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif

                @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{!! \Session::get('error') !!}</li>
                        </ul>
                    </div>
                @endif
                <div style="overflow:auto">
                    <table class="table table-striped " style="background-color: white; border: 1px solid #ccc; ">
                        <thead>
                            <tr>
                                <th>کد</th>
                                <th>@lang('messages.image')</th>
                                <th>@lang('messages.title')</th>
                                <th>وزن</th>
                                <th>اجرت</th>
                                <th>سود</th>
                                <th>مبلغ اضافی</th>
                                <th>مالیات</th>
                                <th>@lang('messages.price')</th>
                                <th>@lang('messages.status')</th>
                                <th width="50"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                                @php
                                    $weight = (float)($item->attributes['weight'] ?? 0);
                                    $gp = (int)($item->attributes['gold_price'] ?? 0);


                                    $additionalPriceToman = (int) ($item->attributes['additional_price'] ?? 0);
                                    $additionalPriceGold = $gp > 0 ? $additionalPriceToman / $gp : 0;

                                    $totalGoldEquivalent += $weight;


                                    $total_ojrat += $item->attributes['ojrat'] ?? 0;
                                    $total_sood += $item->attributes['sood'] ?? 0;
                                    $total_additional += $item->attributes['additional_price'] ?? 0;
                                    $total_tax += $item->attributes['tax'] ?? 0;



                                    // $total_tax += $taxToman;
                                @endphp
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        @if (isset($item['attributes']['image']) && file_exists(public_path() . $item['attributes']['image']))
                                            <a target="__blank" href="{{ url($item->attributes['slug']) }}">
                                                <img height="50" src="{{ $item->attributes['image'] }}" alt="">
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class=""><a href="{{ url($item->attributes['slug']) }}">{{ $item->title ?? '' }}</a>
                                    </td>
                                    <td>@convertCurrency($weight * $gp) تومان<br>
                                        <span class="text-xs text-gray-500">{{ $weight }} گرم</span>
                                    </td>
                                    <td>@convertCurrency($item->attributes['ojrat'] ?? 0) تومان<br>
                                        <span class="text-xs text-gray-500">{{ number_format($item->attributes['ojrat'] / $gp, 3) }} گرم</span>
                                    </td>
                                    <td>@convertCurrency($item->attributes['sood'] ?? 0) تومان<br>
                                        <span class="text-xs text-gray-500">{{ number_format($item->attributes['sood'] / $gp, 3) }} گرم</span>
                                    </td>
                                    <td>@convertCurrency($item->attributes['additional_price'] ?? 0) تومان<br>
                                        <span class="text-xs text-gray-500">{{ number_format(($item->attributes['additional_price']??0) / $gp, 3) }} گرم</span>
                                    </td>
                                    <td>@convertCurrency(($item->attributes['tax'] ?? 0)) تومان<br>
                                        <span class="text-xs text-gray-500">{{ number_format(($item->attributes['tax']??0) / $gp, 3) }} گرم</span>
                                    </td>
                                    <td class="">

                                        <div style="font-weight:bold">@convertCurrency($item->price) @lang('messages.toman')
                                            {{ $item->count }} عدد
                                        </div>
                                    </td>

                                    <td>
                                        @if ($item->status == 2)
                                            <i class="fa fa-check"></i>
                                        @elseif ($item->status == 1)
                                            در حال بررسی
                                        @else
                                            ثبت شده
                                        @endif
                                    </td>
                                    <td>
                                        <div class="">
                                            <div class="">
                                                <form class="pull-right" action="{{ route('admin.order.destroy', $item) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you sure')"
                                                        class="font-full-plus-half-em text-danger btn-xs  no-border no-bg no-padding"
                                                        type="submit" title="@lang('messages.delete')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><span style="font-weight:bold">@convertCurrency($totalGoldEquivalent * $gp ) تومان</span><br>
                                    <span class="text-xs">{{ number_format($totalGoldEquivalent, 3) }} گرم</span>
                                </td>
                                <td>
                                    <span style="font-weight:bold">@convertCurrency($total_ojrat) تومان</span><br>
                                    <span class="text-xs">{{ number_format($total_ojrat / $gp , 3) }} گرم</span>
                                </td>
                                <td>
                                    <span style="font-weight:bold">@convertCurrency($total_sood) تومان</span><br>
                                    <span class="text-xs">{{ number_format($total_sood / $gp, 3)  }} گرم</span>
                                </td>
                                <td>
                                    <span style="font-weight:bold">@convertCurrency($total_additional) تومان</span><br>
                                    <span class="text-xs">{{ number_format($total_additional / $gp , 3) }} گرم</span>
                                </td>
                                <td>
                                    <span style="font-weight:bold">@convertCurrency($total_tax) تومان</span><br>
                                    <span class="text-xs">{{ number_format($total_tax / $gp , 3)  }} گرم</span>
                                </td>
                                <td>
                                    <div style="font-weight:bold">
                                        مبلغ کل @convertCurrency($order->total_price) @lang('messages.toman')
                                    </div>
                                    <div style="display: flex; gap:1em;">
                                        {{ number_format($order->total_price/$gp,3) }} گرم
                                        <a href="">قسطی</a>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active">@lang('messages.order')</li>
        </ul>
        <div>
            <a href="{{ route('admin.order.create') }}" class=" btn btn-success btn-icon  mat-button ">
                <i class="fa fa-plus"></i>@lang('messages.add')
            </a>

        </div>
    </div>

    <div class="content-body">
        <div class=" pos-abs chat-panel bottom-0" style="background-color: white;">
            <div class="panel-body full-height">
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

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="300">@lang('messages.mobile')</th>
                            <th>@lang('messages.total price')</th>
                            <th>@lang('messages.status')</th>

                            <th>@lang('messages.created at')</th>
                            <th width="150"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td class="">{{ $item->user?->mobile ?? ($item->orderDetail->first()?->attributes['customer_mobile'] ?? '') }} {{ $item->user?->customer?->name ?? ($item->orderDetail->first()?->attributes['customer_name'] ?? '') }}<br>
                                @foreach ($item->orderDetail as $item2)
                                        @if (isset($item2['attributes']['image']) && file_exists(public_path() . $item2['attributes']['image']))
                                            <img height="60" style="border:1px solid #ccc"
                                                src="{{ $item2->attributes['image'] }}" alt="">
                                        @endif
                                    @endforeach
                                </td>

                                <td style="font-weight:bold">

                                    @convertCurrency($item->total_price) @lang('messages.toman')


                                </td>

                                <td>
                                    @if ($item->status == 5)
                                        @lang('messages.ready to send')
                                    @elseif ($item->status == 4)
                                        @lang('messages.prepairing')

                                    @elseif ($item->status == 3)
                                        <i class="fa fa-check bg-green" style="padding:5px 5px; border-radius:50%"></i> @lang('messages.paid successfully')
                                    @elseif ($item->status == 2)
                                        <i class="fa fa-check bg-orange" style="padding:5px 5px; border-radius:50%"></i>  فیش اپلود شده
                                    @elseif ($item->status == 1)
                                        ارسال به بانک
                                    @elseif ($item->status == -1)
                                         <i class="fa fa-remove bg-red" style="padding:5px 7px; border-radius:50%"></i> رد شد
                                    @else
                                        ثبت شده
                                    @endif

                                </td>


                                <td class="">{{ convertGToJ($item->created_at, true) }} </td>

                                <td>

                                    <div style="display: flex; gap:1em; align-items: center; justify-content: space-around">

                                        <a class="btn btn-info btn-sm" href="{{ route('admin.order.detail', $item) }}">
                                            @lang('messages.detail') ({{ $item->orderDetail()->count() }})
                                        </a>
                                        <form class="" action="{{ route('admin.order.destroy', $item) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('@lang('messages.Are you sure?')')"
                                                class="font-full-plus-half-em text-danger btn-xs  no-border no-bg no-padding"
                                                type="submit" title="@lang('messages.delete')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                {!! $list->appends(Request::except('page'))->onEachSide(5)->links() !!}
            </div>
        </div>
    </div>
@endsection

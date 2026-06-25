@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a href="{{ route('role.index') }}">@lang('messages.role')</a></li>
            <li class="active">customer</li>
        </ul>


    </div>

    <div class="content-body" style="background-color: white;">
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
                    <th>@lang('messages.name')</th>
                    <th>موجودی (تومان)</th>
                    <th>طلا (گرم)</th>
                    <th>@lang('messages.mobile')</th>
                    <th>@lang('messages.address')</th>
                    <th>@lang('messages.orders')</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $item)
                    <tr>
                        <td>{{ $item?->id }}</td>
                        <td>{{ $item?->name }}</td>
                        <td>@convertCurrency($item?->toman_balance) </td>
                        <td>
                            {{ $item?->gold_balance }}
                            <a href=""><i class="fa fa-plus bg-green" style="border-radius: 50px; padding:5px 5px 2px"></i></a>
                        </td>
                        <td>{{ $item->mobile }}</td>
                        <td>{{ $item?->address }} - {{ $item?->zipcode }}</td>
                        <td>{{ $item->user->orders->count() }}</td>
                        <td style="width: 100px !important">
                            <div class="row">
                                <div class="col-md-6">
                                    <form class="pull-right" action="{{ route('role.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('@lang('messages.Are you sure?')')"
                                            class="font-full-plus-half-em text-danger btn-xs  no-border no-bg no-padding"
                                            type="submit" title="@lang('messages.delete')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                                <!-- <div class="col-md-6">
                                    <a href="{{ route('admin.customer.edit', $item->id) }}"
                                        class="font-full-plus-half-em text-success btn-xs pull-right"
                                        title="@lang('messages.edit')">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div> -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $customers->appends(Request::except('page'))->onEachSide(5)->links() !!}
    </div>



@endsection

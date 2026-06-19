@extends('admin.layouts.app')
@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active"><a class="btn btn-success" style="color:white; font-weight: bold;" href="{{ route('chat.index') }}">chat</a></li>
        </ul>

    </div>

    <div class="content-body">
        <div class="dashboard">
            <div class="">
                <div class="title">@lang('messages.customer')</div>
                <div class="info">
                    <a class="count" href="/admin/role/3/users">{{ $data['customersCount'] }}</a>
                </div>
            </div>
            <div class="">
                <div class="title">@lang('messages.companies')</div>
                <div class="info">
                    <a class="count" href="{{ route('admin.company.index') }}">{{ $data['companiesCount'] }}</a>
                </div>
            </div>
            <div class="">
                <div class="title">@lang('messages.Products')</div>
                <div class="info">
                    <a class="count"
                        href="{{ route('contents.type.show', ['type' => 'product']) }}">{{ $data['productsCount'] }}</a>
                    <a href="{{ route('contents.create', ['type' => 'product']) }}"
                        class=" btn btn-success btn-icon  mat-button ">
                        <i class="fa fa-plus"></i>@lang('messages.add')
                    </a>
                </div>
            </div>
            <div class="">
                <div class="title">@lang('messages.Articles')</div>
                <div class="info">
                    <a class="count"
                        href="{{ route('contents.type.show', ['type' => 'article']) }}">{{ $data['articlesCount'] }}</a>
                    <a href="{{ route('contents.create', ['type' => 'article']) }}"
                        class=" btn btn-success btn-icon  mat-button ">
                        <i class="fa fa-plus"></i>@lang('messages.add')
                    </a>
                </div>
            </div>
            <div class="">
                <div class="title">@lang('messages.Comments')</div>
                <div class="info">
                    <a class="count" href="{{ route('comment.index') }}">{{ $data['commentsCount'] }}</a>
                </div>
            </div>
        </div>

        <div class="dashboard" style="margin-top:30px;">
            <div>
                <div class="title">سود ماهیانه (پرداخت موفق)</div>
                <div class="info" style="display:block;">
                    <table class="table table-striped" style="max-width:100%;margin-bottom:0;">
                        <thead>
                            <tr>
                                <th>ماه</th>
                                <th>تعداد</th>
                                <th>مبلغ کل فروش (تومان)</th>
                                <th>سود (تومان)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['monthlyProfits'] as $monthKey => $row)
                                <tr>
                                    <td>{{ $row['name'] }}</td>
                                    <td>{{ $row['count'] }}</td>
                                    <td>{{ number_format($row['sales']) }}</td>
                                    <td>{{ number_format($row['profit']) }}</td>
                                </tr>
                            @endforeach
                            @if (count($data['monthlyProfits']) == 0)
                                <tr><td colspan="4">موردی یافت نشد</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

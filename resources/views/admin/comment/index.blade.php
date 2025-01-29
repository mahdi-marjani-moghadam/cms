@extends('admin.layouts.app')
@section('content')
<div class="content-control">
    <ul class="breadcrumb">
        <li class="active">@lang('messages.Comments')</li>
    </ul>


</div>

<div class="content-body">
    <div class="panel panel-default pos-abs chat-panel bottom-0">
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
                        <th>@lang('messages.name')</th>
                        <th>@lang('messages.comment')</th>
                        <th>@lang('messages.rate')</th>
                        <th>@lang('messages.status')</th>
                        <th>@lang('messages.content')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td class="">{{ $item->name ?? '' }}</td>
                            <td class="">{!! $item->comment !!}</td>
                            <td class="">
                                @for ($i = $item->rate; $i >= 1; $i--)
                                    <img width="20" height="20" src="{{ url('adminAssets/img/star1x.png') }}"
                                        alt="{{ 'star for rating' }}">
                                @endfor
                            </td>
                            <td class="">
                                @if ($item->status == 1)
                                    <i class="fa fa-check"></i>
                                @else
                                    @if ($errors->any())
                                        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                                    @endif
                                    <form method="post" action="{{ route('comment.update', $item->id) }}">
                                        <input type="hidden" name="{{ isset($item->content) ? 'content_id' : 'comapny_id' }}"
                                            value="{{ isset($item->content) ? $item->content->id : $item->company->id }}">
                                        <input type="hidden" name="name" value="{{ $item->name }}">
                                        <input type="hidden" name="comment" value="{{ $item->comment }}">

                                        @method('PATCH')
                                        @csrf
                                        <input type="hidden" name="status" value="1">
                                        <button class="btn btn-sm">تایید</button>
                                    </form>
                                @endif

                            </td>
                            <td class="">
                                <a target="_blank"
                                    href="{{ (isset($item->content->slug)) ? url($item->content->slug) : url('/profile/' . $item->company->id) }}">
                                    {{ $item->content->title ?? $item->company->name }}
                                    <i class="fa fa-external-link"></i>
                                </a>
                            </td>
                            <td class="">{{ convertGToJ($item->created_at, true) }}</td>

                            <td class="width-100">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form class="pull-right" action="{{ route('comment.destroy', $item->id) }}"
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
                                    <div class="col-md-6">
                                        <a href="{{ route('comment.edit', $item->id) }}"
                                            class="font-full-plus-half-em text-success btn-xs pull-right"
                                            title="@lang('messages.edit')">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @lang('messages.total') {{ $data->total() }} |
            @lang('messages.page') {{ $data->currentPage() }}
            {{ $data->links() }}
        </div>
    </div>
</div>

@endsection

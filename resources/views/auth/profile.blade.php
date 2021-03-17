@extends(@env('TEMPLATE_NAME').'.App')
@section('bootstrap')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.rtl.min.css" integrity="sha384-4dNpRvNX0c/TdYEbYup8qbjvjaMrgUPh+g4I03CnNtANuv+VAvPL6LqdwzZKV38G" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

@endsection
@section('Content')

    <section class="panel">
        @include('auth.nav')

        <div>
            <h1>@lang('messages.profile')</h1>
            <div>@lang('messages.store name'): {{ $user->company->name ?? '' }}</div>
            <div>@lang('messages.mobile'): {{ $user->company->mobile ?? ''}}</div>
            <div>@lang('messages.site'): {{ $user->company->site ?? ''}}</div>
            <div>@lang('messages.email'): {{ $user->company->email ?? ''}}</div>
            <div>@lang('messages.name'): {{ $user->name }}</div>
            <div>@lang('messages.register date'): {{ convertGToJ($user->date) }}</div>

            
        </div>
    </section>

@endsection

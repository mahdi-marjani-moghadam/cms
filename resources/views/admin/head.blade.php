<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LiveChat</title>

    <!-- Fonts -->
    {{--<link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">--}}
    <!-- Styles -->

    <link href="{{ url('/adminAssets/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ url('/adminAssets/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ url('/adminAssets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('/adminAssets/css/bootstrap-theme.css') }}" rel="stylesheet">
    <link href="{{ url('/adminAssets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('/adminAssets/css/dependencies.css') }}" rel="stylesheet">
    <link href="{{ url('/adminAssets/css/helper.css') }}" rel="stylesheet">
    <link href="{{ url('/adminAssets/css/iziToast.min.css') }}" rel="stylesheet">
    <link href="{{ url('/adminAssets/css/fancy.min.css') }}" rel="stylesheet">
    <link href="{{ url('/adminAssets/css/iziToast.min.css') }}" rel="stylesheet">
    <link href="{{ url('/adminAssets/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('/adminAssets/css/responsive.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ url('/adminAssets/js/jquery.min.js') }}"></script>
    <script src="{{ url('/adminAssets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ url('/adminAssets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/adminAssets/js/demo-setup.js') }}"></script>
    <script src="{{ url('/adminAssets/js/dependencies-setup.js') }}"></script>
    <script src="{{ url('/adminAssets/js/iziToast.min.js') }}"></script>
    <script src="{{ url('/adminAssets/js/jquery.bootstrap-growl.min.js') }}"></script>
    <script src="{{ url('/adminAssets/js/jquery.multi-select.js') }}"></script>
    <script src="{{ url('/adminAssets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('/adminAssets/js/panel-setup.js') }}"></script>
    <script src="{{ url('/adminAssets/js/select2.min.js') }}"></script>
    <script src="{{ url('/adminAssets/js/theme-setup.js') }}"></script>
    <script src="{{ url('/adminAssets/js/fancy.min.js') }}"></script>
    <script src="{{ url('/adminAssets/js/iziToast.min.js') }}"></script>
    <script src="{{ url('/adminAssets/js/iziToast-custom.js') }}"></script>
    <script src="{{ url('/adminAssets/js/scripts.js') }}"></script>


    <script>
        $(function() {
            /* essential functions */
            $.httpRequest = function(url, method, data, isJson) {
                var option = {
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('html').find('meta[name="csrf-token"]').attr('content')
                    }
                };

                if (method !== undefined && method !== null && method !== '') {
                    option.method = method;
                }

                if (data !== undefined && data !== null && data !== '') {
                    option.data = data;
                }

                if (isJson !== undefined && isJson === true) {
                    option.contentType = "application/json; charset=utf-8";
                }

                return $.ajax(option);
            };
        });
    </script>
</head>

<body>
    <div class="overlay pos-fix right-0 top-0 bottom-0 left-0"></div>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
        @if(app('env') == 'production')
            <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
            <link rel="stylesheet" href="{{ secure_asset('css/inststyle.css') }}">
        @else
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('css/inststyle.css') }}">
        @endif

        <title>instroid</title>
    </head>
    <body>
      @include('inst/header')
      @yield('content')
      @yield('form')
    </body>
</html>

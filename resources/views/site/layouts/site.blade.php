<!doctype html>
<html lang="{{ config('app.locale') }}" data-bs-theme="auto">
    <head>
        <title>@section('title') {{ config('app.site_title') }} @show</title>

        @include('site._partials.head')

        <style>

        </style>

        @yield('head')
    </head>
    <body>
        @include('_partials.icons')

        <div class="container">
        @include('site._partials.header')


                @yield('content')


        @include('site._partials.footer')

        </div>

        @include('site._partials.scripts')

        @yield('scripts')
    </body>
</html>

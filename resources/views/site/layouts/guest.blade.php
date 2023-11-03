<!doctype html>
<html lang="{{ config('app.locale') }}" data-bs-theme="auto">
    <head>
        <title>Site</title>

        @include('site._partials.head')

        <style>
            .footer {
                position: absolute;
                bottom: 0;
            }
        </style>

        @yield('head')
    </head>
    <body>
        @include('_partials.icons')

        <main>
            {{--<h1 class="visually-hidden">Headers examples</h1>--}}

            <div class="container">

                @yield('content')


            </div>

        </main>

        @include('site._partials.scripts')

        @yield('scripts')
    </body>
</html>

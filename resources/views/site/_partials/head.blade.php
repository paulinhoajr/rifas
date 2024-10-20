<script src="{{asset('js/color-modes.js')}}"></script>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="imagetoolbar" content="no"/>
<meta http-equiv="window-target" content="standard"/>
<meta http-equiv="Expires" content="-1"/>
<meta http-equiv="Content-Language" content="pt-br"/>
<meta http-equiv="cache-control" content="no-cache"/>
<meta name="resource-type" content="document"/>
<meta name="classification" content="Internet"/>
<meta name="distribution" content="Global"/>
<meta name="doc-class" content="Completed"/>
<meta name="generator" content="JetBrains PhpStorm"/>
<meta name="MSSmartTagsPreventParsing" content="true"/>
<meta name="author" content="Voope Soluções"/>
<link rel="author" href="https://www.voope.com.br" title="Voope"/>
<meta name="revisit-after" content="30 Days"/>
<meta name="robots" content="index, follow">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="DC.date.created" content="{{ config('app.site_date') }}"/>

<meta name="DC.title" content="{{ config('app.site_title') }}"/>

<meta name="keywords" content="{{ config('app.site_keywords') }}"/>
<meta name="description" content="{{ config('app.site_description') }}"/>

<!-- Favicons -->
<link rel="apple-touch-icon" href="{{asset('images/favicons/apple-touch-icon.png')}}" sizes="180x180">
<link rel="icon" href="{{asset('images/favicons/favicon-32x32.png')}}" sizes="32x32" type="image/png">
<link rel="icon" href="{{asset('images/favicons/favicon-16x16.png')}}" sizes="16x16" type="image/png">
<link rel="manifest" href="{{asset('images/favicons/manifest.json')}}">
<link rel="mask-icon" href="{{asset('images/favicons/safari-pinned-tab.svg')}}" color="#712cf9">
<link rel="icon" href="{{asset('images/favicons/favicon.ico')}}">
<meta name="theme-color" content="#712cf9">

<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-icons.min.css')}}" rel="stylesheet">
<link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
<link href="{{ asset('css/cookiealert.css') }}" rel="stylesheet" />
<link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
        z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
    }
</style>

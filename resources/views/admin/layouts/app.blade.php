<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title', '首页')-{{ setting('webname') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('static/css/admin.css') }}?{{ time() }}">
    @yield('css')
</head>

<body>
    @include('admin.layouts.nav')
    <div class='d-flex'>
        <div class="sidebar navbar-nav">
            @yield('sidebar')
        </div>
        <div class='container-fluid'>
            @include('admin.layouts.message')
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>

</html>

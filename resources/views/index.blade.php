<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('head')
</head>
<body>
<div class="container">

    <header class="row">
        @include('header')
    </header>

    <div id="main" class="row">
        @yield('content')
    </div>

    <footer class="row">
        @include('footer')
    </footer>

</div>
    @stack('scripts')
</body>
</html>

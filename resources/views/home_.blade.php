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
        <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
    </div>

    <footer class="row">
        @include('footer')
    </footer>

</div>
</body>
</html>
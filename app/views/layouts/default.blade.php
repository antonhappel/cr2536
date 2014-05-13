<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    @include('includes.header')
    <div class="container">
        <div class="row">
            @include('partials.alert')
        </div>
    </div>
    @yield('content')
</body>
</html>
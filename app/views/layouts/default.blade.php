<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    @include('includes.header')
        @include('partials.alert')

    @yield('content')
</body>
</html>
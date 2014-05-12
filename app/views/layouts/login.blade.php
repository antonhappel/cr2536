<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
        <div class="container">
            @section('page_header')
            @show
                    @yield('content')
        </div>
</body>
</html>
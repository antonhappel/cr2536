<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div id="bg">
    <img class="bg" src="/packages/core/images/bg.jpg" alt="">
</div>
    <div class="container">
        @if(Auth::user()->admin)
            @include('includes.header')
        @else
        <div class="club_logo">
            <a  href="{{ route('core.home'); }}" ><img height="50" src="/packages/core/images/1248_300x120.gif"></a>
            <a  href="{{ route('core.home'); }}" ><img height="50" src="/packages/core/images/club100_logo.jpg"></a>
        </div>
        @endif
        @include('partials.alert')
        @yield('content')
    </div>

</body>
</html>
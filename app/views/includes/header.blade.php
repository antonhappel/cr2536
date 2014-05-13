<div role="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand"><img height="50" src="http://club1255.de/packages/core/images/1248_300x120.gif"></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('core.home'); }}">Home</a></li>

                @if(Auth::check())
                    @if(Auth::user()->admin)
                        <li><a href="{{ route('core.admin'); }}">Admin</a></li>
                    @endif
                <li><a href="{{ route('core.logout'); }}">Logout</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
@extends(Config::get('general.views.layout_backend'))
@section('content')
<div class="container">
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-3 col-sm-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p class="semi-bold">Personen eingeladen</p>
                    <h4><span data-animation-duration="700" data-value="21451" class="item-count animate-number semi-bold">21.451</span> EUR</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p class="semi-bold">Zugesagt</p>
                    <h4><span data-animation-duration="700" data-value="21451" class="item-count animate-number semi-bold">1</span></h4>
                    <p class="semi-bold">Zugesagt + 1</p>
                    <h4><span data-animation-duration="700" data-value="21451" class="item-count animate-number semi-bold">52</span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p class="semi-bold">Kein Shuttle Service</p>
                    <h4><span data-animation-duration="700" data-value="21451" class="item-count animate-number semi-bold">2</span></h4>
                    <p class="semi-bold">Shuttle Service</p>
                    <h4><span data-animation-duration="700" data-value="21451" class="item-count animate-number semi-bold">6</span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p class="semi-bold">Wartend</p>
                    <h4><span data-animation-duration="700" data-value="21451" class="item-count animate-number semi-bold">21451.00</span> EUR</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="page-header">
        <h3>User</h3>
    </div>


    <div class="row">
        @foreach($users as $user)
        <div class="person col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $user->first_name; }} {{ $user->last_name;}}</div>
                <ul class="list-group">
                    <li class="list-group-item">Einladung angenommen <span class="badge">Yes</span></li>
                    <li class="list-group-item">Shuttle-Service <span class="badge">Yes</span></li>
                    <li class="list-group-item">Adresse:
                        <p>{{ $user->street; }} <br/>
                        {{ $user->zip_code; }} {{ $user->city; }}
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        @endforeach
    </div>




</div>


@stop
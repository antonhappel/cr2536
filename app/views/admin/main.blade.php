@extends(Config::get('general.views.layout_backend'))
@section('content')
<div class="container">
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-3 col-sm-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p class="semi-bold">Personen eingeladen</p>
                    <h4><span data-animation-duration="700" data-value="21451" class="item-count animate-number semi-bold">{{ $personen_eingeladen; }}</span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p class="semi-bold">Zugesagt</p>
                    <h4><span data-animation-duration="700" data-value="21451" class="item-count animate-number semi-bold">{{ count($zugesagt); }}</span></h4>
                    <p class="semi-bold">Zugesagt + 1</p>
                    <h4><span data-animation-duration="700" data-value="21451" class="item-count animate-number semi-bold">{{ $zugesagt_plus1; }}</span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p class="semi-bold">Shuttle Service</p>
                    <h4><span data-animation-duration="700" data-value="21451" class="item-count animate-number semi-bold">{{ $shuttle_count; }}</span></h4>
                    <p class="semi-bold">Kein Shuttle Service</p>
                    <h4><span data-animation-duration="700" data-value="21451" class="item-count animate-number semi-bold">{{ ((count($zugesagt)-$shuttle_count) >= 0) ? count($zugesagt)-$shuttle_count : '-'; }}</span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p class="semi-bold">Wartend</p>
                    <h4><span data-animation-duration="700" data-value="21451" class="item-count animate-number semi-bold">{{ $personen_eingeladen - count($zugesagt);}}</span></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="page-header">
        <h3>User</h3>
    </div>
    <ul class="nav nav-pills" style="margin-bottom: 15px;">
        <li class="active"><a href="#zugesagt" data-toggle="tab">Zugesagt</a></li>
        <li><a href="#abgesagt" data-toggle="tab">Abgesagt</a></li>
        <li><a href="#wartend" data-toggle="tab">Keine Antwort</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="zugesagt">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Shuttle</th>
                        <th>Adresse</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($zugesagt as $user)
                    <tr>
                        <td>{{ $user->first_name; }} {{ $user->last_name;}} {{ ($user->companion == 1) ? '<span class="label label-danger">+1</span>' : ''; }}</td>
                        <td>{{ ($user->shuttle) ? "Yes" : "No"}}</td>
                        <td>{{ ($user->shuttle) ? $user->street.', '.$user->zip_code.' '.$user->city : "" }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="abgesagt">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Antwort</th>
                </tr>
                </thead>
                <tbody>
                @foreach($abgesagt as $user)
                <tr>
                    <td>{{ $user->first_name; }} {{ $user->last_name;}} {{ ($user->companion == 1) ? '<span class="label label-danger">+1</span>' : ''; }}</td>
                    <td>{{ ($user->response != null) ? date("d.m.Y H:i:s", strtotime($user->response)) : ""}}</td>

                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="tab-pane" id="wartend">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($wartend as $user)
                <tr>
                    <td>{{ $user->first_name; }} {{ $user->last_name;}} {{ ($user->companion == 1) ? '<span class="label label-danger">+1</span>' : ''; }}</td>

                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>




</div>


@stop
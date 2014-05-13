@extends(Config::get('general.views.layout_newbackend'))

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <b>Neuen Gast anlegen</b>
        {{ Form::open(array('route' => 'core.invite.create', 'method' => 'post', 'class' => 'form', 'style' => 'margin-top: 20px;')); }}
        <div class="form-group">
            <label for="first_name">Vorname</label>
            <input type="text" class="form-control" name="first_name" placeholder="Vorname" value="{{ (Input::old('first_name')) ? Input::old('first_name') : ''; }}">
        </div>
        <div class="form-group">
            <label for="last_name">Nachname</label>
            <input type="text" class="form-control" name="last_name" placeholder="Nachname" value="{{ (Input::old('last_name')) ? Input::old('last_name') : ''; }}">
        </div>
        <button class="btn btn-default" type="submit">Speichern</button>
        </form>
    </div>
</div>

@stop
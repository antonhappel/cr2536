@extends(Config::get('general.views.layout_login'))

<style>
    body {
        padding-top: 0px !important;
    }
</style>


@section('content')
<div class="text-center">
    <div class="row">
        {{ HTML::image('packages/core/images/club1248_banner.jpg' , "Club 1248", array('class' => 'img-responsive')); }}
        <h3>A Little Party Never Killed Nobody</h3>
    </div>

</div>

@include('partials.alert')
{{Form::open(array('route' => 'core.login'))}}
    <div class="form-group">
        <label for="username">Vor- und Nachname</label>
        <input type="text" class="form-control" name="username" placeholder="Vor- und Nachname" value="{{ (Input::has('username')) ? Input::get('username') : Input::old('username'); }}">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-default btn-block btn-primary">Login</button>
    <div class="text-center" style="margin-bottom: 10px"">Ein Gentleman genießt und schweigt.</div>
{{ Form::close() }}

@stop
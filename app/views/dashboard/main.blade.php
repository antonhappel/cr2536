@extends(Config::get('general.views.layout_newbackend'))



@section('content')

@if ( Session::has('shuttle') && (Session::get('shuttle') == 1 || Session::get('shuttle') == 2) )
<script>
    $(document).ready(function (){
        $('html, body').animate({
            scrollTop: $("#shuttle").offset().top
        }, 500);
    });
</script>
@endif

<div class="sections">
    <section id="intro">
        <div class="container">
            <h3>Hallo {{ Auth::user()->first_name; }},</h3>
            <p>Du hast eine persönliche Einladung erhalten. Wir freuen uns, dass Du dabei sein möchtest.</p>
            <p>Die Einladungskarte berechtigt zu freiem Eintritt für 2 Personen sowie die Nutzung des Shuttle-Service.</p>
            <p></p>
            <p><strong>* Der Club 1248 lädt ein am 7. Juni 2014, um 21:48 Uhr in die Club 100 Lounge, Campusallee 2 in Flensburg.</strong></p>
            <p><strong>* Dresscode: Casual chic.</strong></p>
            <p><strong>* Ab 1:00 Uhr steht ein Shuttle-Service für die Heimfahrt, in einem Umkreis von 15km vom Veranstaltungsort, bereit.</strong></p>
            <p></p>
            <p>Bitte erteile uns hier Deine verbindliche Zusage.</p>
            <p>Vielen Dank!</p>
        </div>
    </section>
    @if( Auth::user()->response == null )
    <section id="attend">
        <div class="col-sm-12">
            <b>Bist Du dabei?</b>
            <div class="btn-group btn-group-justified">
                <div class="btn-group">
                    <a class="btn btn-default" href="{{route('core.user.attend', array(2)); }}"><span class="glyphicon glyphicon-ok"></span> Ja +1</a>
                </div>
                <div class="btn-group">
                    <a class="btn btn-default" href="{{route('core.user.attend', array(1)); }}"><span class="glyphicon glyphicon-ok"></span> Ja</a>
                </div>
                <div class="btn-group">
                    <a class="btn btn-default" href="{{route('core.user.attend', array(0)); }}"><span class="glyphicon glyphicon-remove"></span> Nein</a>
                </div>
            </div>
        </div>
    </section>
    @elseif( Auth::user()->response != null && Auth::user()->attending == true  )
    <section id="shuttle">
        <div class="clearfix">

            <div class="col-sm-6" id="shuttle">
                <div class="panel panel-default">
                <div class="panel-body">
                <b>Möchtest Du den Shuttle Service buchen? Bitte trage hier deine Adresse ein:</b>
                {{ Form::open(array('route' => 'core.user.update', 'method' => 'put', 'class' => 'form', 'style' => 'margin-top: 20px;')); }}
                <div class="form-group">
                    <label for="street">Strasse, Nr.</label>
                    <input type="text" class="form-control" name="street" placeholder="Strasse, Nr." value="{{ (Input::old('street')) ? Input::old('street') : Auth::user()->street; }}">
                </div>
                <div class="form-group">
                    <label for="zip_code">PLZ</label>
                    <input type="text" class="form-control" name="zip_code" placeholder="PLZ" value="{{ (Input::old('zip_code')) ? Input::old('zip_code') : Auth::user()->zip_code; }}">
                </div>
                <div class="form-group">
                    <label for="city">Stadt</label>
                    <input type="text" class="form-control" name="city" placeholder="Stadt" value="{{ (Input::old('city')) ? Input::old('city') : Auth::user()->city; }}">
                </div>
                <button class="btn btn-default" type="submit">Update</button>
                </form>
                </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <b>Du hast die Einladung bestätigt!</b>
                    </div>
                </div>
            </div>



        </div>
    </section>

    @else

    <section id="shuttle">
        <div class="container">
            <div class="text-center">
                <b>Du hast die Einladung leider abgelehnt!</b>
            </div>
        </div>
    </section>

    @endif
</div>


@stop
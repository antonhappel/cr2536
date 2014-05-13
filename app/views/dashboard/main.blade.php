@extends(Config::get('general.views.layout_backend'))



@section('content')

<style>
    body {
        background-color: #FAFAFA;
    }
</style>

<div class="sections">
    <section id="intro">
        <div class="container">
            <h2>Hallo {{ Auth::user()->first_name; }} {{ Auth::user()->last_name; }},</h2>
            <p>Du hast eine persönliche Einladung erhalten. Wir freuen uns, dass Du dabei sein möchtest.</p>
            <p>Die Einladungskarte berechtigt zu freiem Eintritt für 2 Personen sowie die Nutzung des Shuttle-Service.</p>
            <p></p>
            <p><strong>* Der Club 1248 lädt ein am 7. Juni 2014, um 21:48 Uhr in die Club 100 Lounge, Campusallee 2 in Flensburg.</strong></p>
            <p><strong>* Dresscode: Casual chic.</strong></p>
            <p></p>
            <p>Bitte erteile uns hier Deine verbindliche Zusage.</p>
            <p>Vielen Dank!</p>
        </div>
    </section>
    @if( Auth::user()->response == null )
    <section id="attend">
        <div class="container">
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
        <div class="container">
            <b>Möchtest Du den Shuttle Service buchen? Bitte trage hier deine Adresse ein:</b>
            {{ Form::open(array('route' => 'core.user.update', 'method' => 'put', 'class' => 'form-inline', 'style' => 'margin-top: 20px;')); }}
            <div class="form-group">
                <label for="street">Strasse, Nr.</label>
                <input type="text" class="form-control" name="street" placeholder="Strasse, Nr." value="{{ Auth::user()->street; }}">
            </div>
            <div class="form-group">
                <label for="zip_code">PLZ</label>
                <input type="text" class="form-control" name="zip_code" placeholder="PLZ" value="{{ Auth::user()->zip_code; }}">
            </div>
            <div class="form-group">
                <label for="city">Stadt</label>
                <input type="text" class="form-control" name="city" placeholder="Stadt" value="{{ Auth::user()->city; }}">
            </div>
            <button class="btn btn-default" type="submit">Update</button>
            </form>
        </div>
    </section>

    <section id="shuttle">
        <div class="container">
             <div class="text-center">
                 <b>Du hast die Einladung bestätigt!</b>
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
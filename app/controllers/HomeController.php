<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    public function index()
    {
        return View::make(Config::get('general.views.dashboard'));
    }

    public function import()
    {
        if(Auth::user()->admin) {

            $admins = Admins::all();
            foreach($admins as $admin) {

                $user = new User();

                $user->first_name = $admin->vorname;
                $user->last_name = $admin->name;
                $user->username = strtolower( str_replace(" ", "", $admin->vorname.$admin->name) );

                $user->password = Hash::make("club1248");
                $user->admin = true;

                $user->save();
            }


            $guests = Guests::all();
            foreach($guests as $guest) {

                $user = new User();

                $user->first_name = $guest->vorname;
                $user->last_name = $guest->name;
                $user->username = strtolower( str_replace(" ", "", $guest->vorname.$guest->name) );

                $user->password = Hash::make("PJMTG19JS12F3");

                $user->save();
            }

            return Redirect::route('core.home');
        }
        else {
            return Redirect::route('core.home');
        }
    }

    public function admin() {

        $personen_eingeladen = User::whereRaw('admin != 1')->count();
        $zugesagt_plus1 = User::whereRaw('response IS NOT NULL and attending = 1 and companion = 1')->count();
        $shuttle_count = User::whereRaw('response IS NOT NULL and attending = 1 and shuttle = 1')->count();

        $zugesagt = User::whereRaw('response IS NOT NULL and attending = 1')->get();
        $abgesagt = User::whereRaw('response IS NOT NULL and attending = 0')->get();
        $wartend = User::whereRaw('response IS NULL and attending = 0')->get();

        return View::make(Config::get('general.views.admin_dashboard'))
            ->with('zugesagt', $zugesagt)
            ->with('abgesagt', $abgesagt)
            ->with('personen_eingeladen', $personen_eingeladen)
            ->with('zugesagt_plus1', $zugesagt_plus1)
            ->with('shuttle_count', $shuttle_count)
            ->with('wartend', $wartend);

    }

	public function showLogin()
	{
        return View::make(Config::get('general.views.login'));
	}


    public function showInvite() {
        return View::make(Config::get('general.views.invite_index'));
    }


    public function storeInvite() {

        $rules = array(
            'first_name'    => 'required_if:last_name,""',
            'last_name'  => 'required_if:first_name,""'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::route('core.invite.index')
                ->withInput(Input::except('password'))
                ->with('error', "Bitte füllen Sie das Adressformular richtig aus.");

        }
        else {


            $username = strtolower( str_replace(" ", "", Input::get('first_name').Input::get('last_name')) );

            $userExists = User::where('username', '=', $username)->count();

            if($userExists != 0) {
                return Redirect::route('core.invite.index')
                    ->with('error', "Der Benutzername ist bereits vergeben");
            }


            $user = new User();

            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->username = $username;
            $user->password = Hash::make("PJMTG19JS12F3");

            $user->save();

            return Redirect::route('core.invite.index')
                ->with('success', "Der Gast wurde angelegt");
        }
    }


    public function doAttend($type) {
        $user = Auth::user();

        if($user->response != null) {
            echo "user ist bereits dabei";
        }
        else {
            switch ($type) {
                case 0: {
                    $user->attending = false;
                }
                break;
                case 1: {
                    $user->attending = true;
                    $user->companion = 0;
                }
                break;
                case 2: {
                    $user->attending = true;
                    $user->companion = 1;
                }
                break;
                default: {
                    return Redirect::route('core.home');
                }
            }

            $user->response = new DateTime;
            $user->save();
        }

        return Redirect::route('core.home')
            ->with('success', "Wir haben Ihre Antwort erhalten.")
            ->with('shuttle', $type);
    }

    public function update() {
        $user = Auth::user();

        $rules = array(
            'street'    => 'required',
            'zip_code' => 'required|min:5|max:6',
            'city' => 'required'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return Redirect::route('core.home')
            ->withInput(Input::except('password'))
            ->with('error', "Bitte füllen Sie das Adressformular richtig aus.");

        }
        else {
            $user->street = Input::get('street');
            $user->zip_code = Input::get('zip_code');
            $user->city = Input::get('city');
            $user->shuttle = true;

            $user->save();

            return Redirect::route('core.home')
                ->with('success', "Ihre Daten sind gespeichert. Unser Shuttle-Service bringt Sie sicher nach Hause.");
        }


    }


    public function doLogin()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'username'    => 'required', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);



        // if the validator fails, redirect back to the form
        if ($validator->fails()) {



            return Redirect::to('login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'username' 	=> strtolower( str_replace(" ", "", Input::get('username')) ),
                'password' 	=> Input::get('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {

                // validation not successful, send back to form
                return Redirect::route('core.home');

            } else {

                // validation not successful, send back to form
                return Redirect::route('core.login')
                        ->with('error', "Login leider nicht erfolgreich. Bitte versuchen sie es noch einmal!");

            }

        }
    }


    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }

}

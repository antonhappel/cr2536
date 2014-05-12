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

        $users = User::all();

        return View::make(Config::get('general.views.admin_dashboard'))
            ->with('users', $users);

    }

	public function showLogin()
	{
        return View::make(Config::get('general.views.login'));
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

        return Redirect::route('core.home');
    }

    public function update() {
        $user = Auth::user();

        $rules = array(
            'street'    => 'required',
            'zip_code' => 'required|min:5',
            'city' => 'required'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            echo "fail";
        }
        else {
            $user->street = Input::get('street');
            $user->zip_code = Input::get('zip_code');
            $user->city = Input::get('city');

            $user->save();

            return Redirect::route('core.home');
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
                return Redirect::route('core.login');

            }

        }
    }


    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    //protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function attemptLogin(Request $request)
    {
        $this->validate($request,
        [
            'username'      => 'required|min:3',
            'password'      => 'required|min:5',
            //'g-recaptcha-response' => 'required|recaptcha'
        ],['username'       => 'Email/Username']);
        
       // $rolePermissionController = new RolePermissionController;

        try{
            $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password, 'active' => 1])) {
                //return redirect($redirectTo);
                try{
                    //$rolePermissionController->doAfterLogin();
                }catch(\Throwable $e){}
                
                return redirect()->intended($this->redirectPath());
            }else{
                return redirect()->back()->with('error', 'Email/Username or Password not correct')->withInput();
            }
        }catch(\Throwable $e)
        {
            return redirect()->back()->with('error', 'Sorry, an error occurred while signing in to your account. Try again.')->withInput();
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Validator;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(\Illuminate\Http\Request $request)
    {
        //dd( ['email' => $request->email, 'password' => $request->password, 'IsActive' => '1', 'IsVerify' => '1']);
        //return $request->only($this->username(), 'password');
        return ['email' => $request->email, 'password' => $request->password, 'IsActive' => '1', 'IsVerify' => '1'];
    }

    protected function sendFailedLoginResponse(\Illuminate\Http\Request $request)
    {
        if ( ! User::where('email', $request->email)->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $this->username() => "Invalid id or password",
                ]);
        }
        $user = User::where('email', $request->email)->first();
        if ( ! User::where('email', $request->email)->where('password', bcrypt($request->password))->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    'password' => "Invalid id or password",
                ]);
        }
       

    }
    protected function authenticated($request, $user)
    {    

        if($user->user_type == '2') { 
            //return redirect()->intended('/student-profile');
            return redirect()->intended('/admin/dashboard'); 
            
        }

        return redirect()->intended('/admin/dashboard'); 
    }
}

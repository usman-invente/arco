<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Hash;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    //RouteServiceProvider::HOME
    protected $redirectTo ='/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('Website.Auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        if ( $user->role_id != User::TYPE_VOLUNTEER ) {// do your magic here
            return redirect()->route('home');
        }
        return redirect('/');
    }
     public function login(\Illuminate\Http\Request $request) {
        $this->validateLogin($request);
    
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
    
        // This section is the only change
        if ($this->guard()->validate($this->credentials($request))) {
            $user = $this->guard()->getLastAttempted();
    
            // Make sure the user is active
            if ($user->login_status==1 && $this->attemptLogin($request)) {
                // Send the normal successful login response
                return $this->sendLoginResponse($request);
            } else {
                // Increment the failed login attempts and redirect back to the
                // login form with an error message.
                $this->incrementLoginAttempts($request);
                return redirect()
                    ->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors(['active' => 'You must be active to login.']);
            }
        }
    
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
    
        return $this->sendFailedLoginResponse($request);
    }
    
   public function forgetform(){
            return view('Website.Auth.forget');
    }
    
    public function reserpasswors(Request $request){
        $details = [
        'url' => 'https://arabrcrc.org/volunteer_test/update/password/?email='.$request->email,
        'email' => $request->email
    ];
         if(User::where('email', $request->email)->exists()){
              \Mail::to( $request->email)->send(new \App\Mail\ResetPassword($details));
               return redirect()->back()->with('emailsent','Password Reset Link Sent at "'.$request->email.'"');
         }else{
               return redirect()->back()->with('message','Email Not Exist In Our System');
         }

        
        
    }
    
    public function updatepassword(){
        return view('Website.Auth.updatepassword');
    }
    
     public function update(Request $request){
         if(User::where('email', $request->email)->exists()){
         User::where('email',$request->email)
         ->update([
             'password' => Hash::make($request->password)
             ]);
             
             return redirect()->back()->with('message','Password Updated Successfully');
         }else{
             return redirect()->back()->with('message','Email Not Exist In Our System');  
         }
        
    }
    
    public function logout(Request $request) {
          Auth::logout();
          return redirect('/login');
    }


}

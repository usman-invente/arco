<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Organization;
use App\VolunteeringField;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //RouteServiceProvider::HOME
    protected $redirectTo ='/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nationality' => ['required'],
            'contact_number' => ['required', 'max:20'],
            'qualification' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:100'],
            'volunteering_field' => ['required'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nationality_id' => $data['nationality'],
            'contact_number' => $data['contact_number'],
            'qualification' => $data['qualification'],
            'organization_id' => $data['organization_id'],
            'city' => $data['city'],
            'address' => $data['address'],
            'volunteer_field_id' => $data['volunteering_field'],
            'role_id'=>User::TYPE_VOLUNTEER
        ]);
    }

    public function showRegistrationForm()
    {
        $volunteer_field = VolunteeringField::all();
        $country = DB::table('lkp_country')->get();
        $organization = Organization::all();
        return view('Website.Auth.signup',compact('volunteer_field','country','organization'));
    }
}

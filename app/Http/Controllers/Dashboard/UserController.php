<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\VolunteeringField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Select_db= User::where('organization_id',Auth::user()->organization_id)
            ->whereIn('users.role_id',array(User::TYPE_ADMIN, User::TYPE_VOLUNTEER_SUPERVISOR, User::TYPE_VOLUNTEER_OPPORTUNITY_OFFICER,User::TYPE_SITE_ADMIN))
            ->leftJoin('lkp_active_status','users.activeStatus_id','=','lkp_active_status.id')
            ->leftJoin('organizations','users.organization_id','=','organizations.id')
            ->leftJoin('roles','users.role_id','=','roles.id')
            ->select(  'users.id as id' ,'name', 'users.email','contact_number','role_id','organization_id','activeStatus_id','lkp_active_status.status','organizations.name_en','organizations.name_ar','role')
            ->orderBy('users.id','DESC');

        if (request()->ajax()) {
            return datatables()->of($Select_db)->make(true);
        }
        return view('Dashboard.Users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function user_registrationView()
    {
        $roles=Role::all();
        $volunteering_fields=VolunteeringField::all();
        return view('Dashboard.staticPages.user',compact('roles','volunteering_fields'));
    }

    public function user_registration(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nationality_id' => ['required'],
            'role_id' => ['required'],
            'contact_number' => ['required', 'max:20'],
            'qualification' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:100'],
            'volunteer_field_id' => ['required'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'nationality_id' => $request->input('nationality_id'),
            'contact_number' => $request->input('contact_number'),
            'qualification' => $request->input('qualification'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'volunteer_field_id' => $request->input('volunteer_field_id'),
            'role_id'=>  $request->input('role_id'),
            'organization_id'=>Auth::user()->organization_id
        ]);

        return redirect('dashboard/user_registration')->with('success', 'Done Volunteer is successfully Registered');
    }


}

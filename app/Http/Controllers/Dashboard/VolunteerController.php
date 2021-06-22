<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Gate;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('allowedUsers',collect('volunteers_access'));

        $Select_db= User::where(['users.role_id'=>User::TYPE_VOLUNTEER,'organization_id'=>Auth::user()->organization_id])
            ->leftJoin('organizations','users.organization_id','=','organizations.id')
            ->leftJoin('lkp_active_status','users.activeStatus_id','=','lkp_active_status.id')
            ->leftJoin('volunteer_opportunities','users.id','=','volunteer_opportunities.user_id')
            ->select('users.id as id','name','users.email','contact_number','organization_id',
                'activeStatus_id','name_en','name_ar','lkp_active_status.status'
               // DB::raw('count(volunteer_opportunities.user_id) AS total_opportunities')
            )
        ->groupBy('users.id','name','users.email','contact_number','organization_id',
            'activeStatus_id','name_en','name_ar','lkp_active_status.status');

        if (request()->ajax()) {
            return datatables()->of($Select_db)->make(true);
        }

        return view('Dashboard.Volunteers.index');
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

    public function showVolunteers($id)
    {
        $volunteers= User::where(['users.role_id'=>User::TYPE_VOLUNTEER,'organization_id'=>$id])
            ->orderBy('id','DESC')->get();
        return view('Dashboard.VolunteerReports.report_volunteers',compact('volunteers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $statuses=DB::table('lkp_active_status')->get();

        $user= User::where(['users.id'=>$id,'users.role_id'=>User::TYPE_VOLUNTEER,'organization_id'=>Auth::user()->organization_id])
            ->leftJoin('organizations','users.organization_id','=','organizations.id')
            ->leftJoin('lkp_active_status','users.activeStatus_id','=','lkp_active_status.id')
            ->leftJoin('volunteer_opportunities','users.id','=','volunteer_opportunities.user_id')
            ->select('users.id as id','name','users.email','contact_number','organization_id',
                'activeStatus_id','name_en','name_ar','lkp_active_status.status','users.city','users.address')
            ->first();

        return view('Dashboard.Volunteers.edit',compact('user','statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $user= User::where(['users.role_id'=>User::TYPE_VOLUNTEER,'users.id'=>$id])->first();
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users,email,'.$user->id],
            'contact_number' => ['required', 'max:20'],
            'city' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:100'],
            'activeStatus_id'=>'required'

        ]);

        $data=array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact_number' => $request->input('contact_number'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'organization_id' => Auth::user()->organization_id,
            'activeStatus_id'=>$request->input('activeStatus_id')
        );

        User::where('id',$id)->update($data);
        return redirect('dashboard/volunteers')->with('success', 'Done Volunteer is successfully updated!!');
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
}

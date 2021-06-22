<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Organization;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Gate;

class VolunteerOpportunityOfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Factory|View
     * @throws Exception
     */
    public function index()
    {
        Gate::authorize('allowedUsers',collect('volunteer_opportunity_officers_access'));

        $Select_db= User::where([
                                'users.role_id'=>User::TYPE_VOLUNTEER_OPPORTUNITY_OFFICER,
                                'organization_id'=>Auth::user()->organization_id
            ])->leftJoin('lkp_active_status','users.activeStatus_id','=','lkp_active_status.id')
            ->leftJoin('organizations','users.organization_id','=','organizations.id')
            ->leftJoin('roles','users.role_id','=','roles.id')
            ->select(  'users.id as id' ,'name', 'users.email','contact_number','role_id','organization_id','activeStatus_id','lkp_active_status.status','organizations.name_en','organizations.name_ar','role')
            ->orderBy('users.id','DESC');

        if (request()->ajax()) {
            return datatables()->of($Select_db)->make(true);
        }
        return view('Dashboard.VolunteerOpportunityOfficers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $organizations=Organization::all();
        return view('Dashboard.VolunteerOpportunityOfficers.create')->with(['organizations'=>$organizations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_number' => ['required', 'max:20'],
            'city' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:100'],
            'password'=>'required',
        ]);

        $data=array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'contact_number' => $request->input('contact_number'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'organization_id' => Auth::user()->organization_id,
            'role_id'=>User::TYPE_VOLUNTEER_OPPORTUNITY_OFFICER
        );

        $file = $request->file('person_picture');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {
            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/users/opportunityOfficers/', $filename);
            $data['person_picture'] = $filename;
        }

        $file = $request->file('passport_picture');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {
            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/users/opportunityOfficers/passport/', $filename);
            $data['passport_picture'] = $filename;
        }

        User::create($data);
        return redirect('dashboard/opportunityOfficers')->with('success', 'Done Volunteer Opportunity Officer is successfully Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show($id)
    {
        $user= User::where(['users.role_id'=>User::TYPE_VOLUNTEER_OPPORTUNITY_OFFICER,'users.id'=>$id,'organization_id'=>Auth::user()->organization_id])
            ->leftJoin('lkp_active_status','users.activeStatus_id','=','lkp_active_status.id')
            ->leftJoin('organizations','users.organization_id','=','organizations.id')
            ->leftJoin('roles','users.role_id','=','roles.id')
            ->select(  'users.id as id' ,'name', 'users.email','contact_number','role_id','organization_id','address','city','person_picture','passport_picture','activeStatus_id','lkp_active_status.status','organizations.name_en','organizations.name_ar','role')->get()->first();

        return view('Dashboard.VolunteerOpportunityOfficers.show')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $user= User::where(['users.role_id'=>User::TYPE_VOLUNTEER_OPPORTUNITY_OFFICER,'users.id'=>$id, 'organization_id'=>Auth::user()->organization_id])
            ->leftJoin('lkp_active_status','users.activeStatus_id','=','lkp_active_status.id')
            ->leftJoin('organizations','users.organization_id','=','organizations.id')
            ->leftJoin('roles','users.role_id','=','roles.id')
            ->select(  'users.id as id' ,'name', 'users.email','contact_number','role_id','address','city','organization_id','activeStatus_id','lkp_active_status.status','organizations.name_en','organizations.name_ar','role','person_picture','passport_picture')->first();
        $organizations=Organization::all();
        return view('Dashboard.VolunteerOpportunityOfficers.edit')->with(['user'=>$user,'organizations'=>$organizations]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */

    public function update(Request $request, $id)
    {
        $user= User::where(['users.role_id'=>User::TYPE_VOLUNTEER_OPPORTUNITY_OFFICER,'users.id'=>$id])->first();
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'max:255','unique:users,email,'.$user->id],
            'contact_number' => ['required', 'max:20'],
            'city' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:100'],
        ]);

        $data=array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'contact_number' => $request->input('contact_number'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'organization_id' => Auth::user()->organization_id,
        );

        $file = $request->file('person_picture');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {

            $image_path = "public/images/users/opportunityOfficers/".$user->person_picture;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/users/opportunityOfficers/', $filename);
            $data['person_picture'] = $filename;
        }

        $file = $request->file('passport_picture');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {
            $image_path = "public/images/users/opportunityOfficers/passport/".$user->passport_picture;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/users/opportunityOfficers/passport/', $filename);
            $data['passport_picture'] = $filename;
        }

        User::where('id',$id)->update($data);
        return redirect('dashboard/opportunityOfficers')->with('success', 'Done Volunteer Opportunity Officer is successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $officer=User::where('id',$id)->first();
        if (!empty($officer))
        {
            try {

                $image_path = "public/images/users/opportunityOfficers/".$officer->person_picture;  // Value is not URL but directory file path
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }

                $image_path = "public/images/users/opportunityOfficers/passport/".$officer->passport_picture;  // Value is not URL but directory file path
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }

                $officer->delete();
                return redirect('dashboard/opportunityOfficers')->with('success', 'Done Volunteer Opportunity Officer is successfully Deleted!!');
            }
            catch (\Exception $exception)
            {
                return redirect('dashboard/opportunityOfficers')->with('error', 'you can not made this operation Because the record is linked with other records '.$exception->getMessage());
            }
        }
    }
}

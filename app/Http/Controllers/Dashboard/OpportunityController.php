<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Opportunity;
use App\Organization;
use App\User;
use App\VolunteeringField;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;
use Gate;


class OpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     * @throws \Exception
     */
    public function index()
    {
        Gate::authorize('allowedUsers',collect('opportunities_access'));

        $Select_db= Opportunity::where('opportunities.organization_id',Auth::user()->organization_id)->leftJoin('users','opportunities.officer_id','=','users.id')
            ->leftJoin('lkp_active_status','opportunities.status_id','=','lkp_active_status.id')
            ->leftJoin('organizations','opportunities.organization_id','=','organizations.id')
            ->select( 'opportunities.id', 'title','users.name','opportunities.organization_id','opportunities.status_id','lkp_active_status.status','organizations.name_en','organizations.name_ar','opportunities.city')
            ->orderBy('opportunities.id','DESC');


        if (request()->ajax()) {
            return datatables()->of($Select_db)->make(true);
        }
        return view('Dashboard.VolunteerOpportunities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $organizations=Organization::all();
        $types=DB::table('lkp_opportunity_types')->get();
        $memberTypes=DB::table('lkp_member_types')->get();
        $volunteeringFields=VolunteeringField::all();
        $ageTypes=DB::table('lkp_age_types')->get();
        $activeStatus=DB::table('lkp_active_status')->get();
        $officers=User::where(['organization_id'=>Auth::user()->organization_id,'role_id'=>User::TYPE_VOLUNTEER_OPPORTUNITY_OFFICER])->get();
        return view('Dashboard.VolunteerOpportunities.create')->with([
                'organizations'=>$organizations,
                'types'=>$types,
                'memberTypes'=>$memberTypes,
                'volunteeringFields'=>$volunteeringFields,
                'ageTypes'=>$ageTypes,
                'activeStatus'=>$activeStatus,
                'officers'=>$officers
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $current_date_time=Carbon::now()->toDateTimeString();
        $data=array(
            'organization_id'=>$request->input('organization_id'),
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'start_date'=>$request->input('start_date'),
            'end_date'=>$request->input('end_date'),
            'support_for_volunteer'=>$request->input('support_for_volunteer'),
            'benefit_for_volunteer'=>$request->input('benefit_for_volunteer'),
            'issues'=>$request->input('issues'),
            'volunteering_field_id'=>$request->input('volunteering_field_id'),
            'city'=>$request->input('city'),
            'status_id'=>$request->input('status_id'),
            'officer_id'=>$request->input('officer_id'),
            'type_id'=>$request->input('type_id'),
            'member_type_id'=>$request->input('member_type_id'),
            'age_type_id'=>$request->input('age_type_id'),
            'report_image'=>'',
            'opportunity_image'=>'',
            'no_of_volunteers'=>$request->input('no_of_volunteers'),
            'no_of_hours'=>$request->input('no_of_hours'),
            'created_at'=>$current_date_time,
            'updated_at'=>$current_date_time
        );
        $file = $request->file('report_image');
        $current_timestamp = Carbon::now()->timestamp;
        if(Auth::user()->role_id == User::TYPE_VOLUNTEER_OPPORTUNITY_OFFICER)
        {
            $data[ 'officer_id']=Auth::user()->id;
        }
        if (!empty($file)) {
            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/opportunities/reportImage/', $filename);
            $data['report_image'] = $filename;
        }
        $file = $request->file('opportunity_image');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {
            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/opportunities/', $filename);
            $data['opportunity_image'] = $filename;
        }
        Opportunity::create($data);
        return redirect('dashboard/opportunities')->with('success', 'Done Volunteer Opportunity is successfully Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|Response|View
     */
    public function show($id)
    {
        $opportunity=Opportunity::where('opportunities.id',$id)
            ->leftJoin('users','opportunities.officer_id','=','users.id')
            ->leftJoin('lkp_active_status','opportunities.status_id','=','lkp_active_status.id')
            ->leftJoin('lkp_opportunity_types','opportunities.type_id','=','lkp_opportunity_types.id')
            ->leftJoin('lkp_member_types','opportunities.member_type_id','=','lkp_member_types.id')
            ->leftJoin('lkp_age_types','opportunities.age_type_id','=','lkp_age_types.id')
            ->leftJoin('volunteering_fields','opportunities.volunteering_field_id','=','volunteering_fields.id')
            ->leftJoin('organizations','opportunities.organization_id','=','organizations.id')
            ->select( 'opportunities.*','users.name','lkp_active_status.status',
                        'organizations.name_en','organizations.name_ar',
                        'lkp_opportunity_types.type as opportunity_type',
                        'lkp_member_types.type as member_type',
                        'volunteering_fields.field_en','volunteering_fields.field_ar',
                        'lkp_age_types.type as age_type',
                        'lkp_active_status.status'
            )
            ->first();
        $organizations=Organization::all();
        $types=DB::table('lkp_opportunity_types')->get();
        $memberTypes=DB::table('lkp_member_types')->get();
        $volunteeringFields=VolunteeringField::all();
        $ageTypes=DB::table('lkp_age_types')->get();
        $activeStatus=DB::table('lkp_active_status')->get();
        $officers=User::where(['organization_id'=>Auth::user()->organization_id,'role_id'=>User::TYPE_VOLUNTEER_OPPORTUNITY_OFFICER])->get();

        return view('Dashboard.VolunteerOpportunities.show')->with([
            'opportunity'=>$opportunity

        ]);
    }


    public function showOpportunities($id)
    {
        $opportunities= Opportunity::where(['volunteering_field_id'=>$id,'opportunities.organization_id'=>Auth::user()->organization_id])
            ->leftJoin('users','opportunities.officer_id','=','users.id')
            ->leftJoin('lkp_active_status','opportunities.status_id','=','lkp_active_status.id')
            ->leftJoin('organizations','opportunities.organization_id','=','organizations.id')
            ->select( 'opportunities.id', 'title','users.name','opportunities.organization_id','opportunities.status_id','lkp_active_status.status','organizations.name_en','organizations.name_ar','opportunities.city')
            ->orderBy('opportunities.id','DESC')
            ->get();
        return view('Dashboard.VolunteerOpportunities.opportunities_Field_based',compact('opportunities'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|Response|View
     */
    public function edit($id)
    {
        $opportunity=Opportunity::where('id',$id)->first();
        $organizations=Organization::all();
        $types=DB::table('lkp_opportunity_types')->get();
        $memberTypes=DB::table('lkp_member_types')->get();
        $volunteeringFields=VolunteeringField::all();
        $ageTypes=DB::table('lkp_age_types')->get();
        $activeStatus=DB::table('lkp_active_status')->get();
        $officers=User::where(['organization_id'=>Auth::user()->organization_id,'role_id'=>User::TYPE_VOLUNTEER_OPPORTUNITY_OFFICER])->get();

        return view('Dashboard.VolunteerOpportunities.edit')->with([
            'opportunity'=>$opportunity,
            'organizations'=>$organizations,
            'types'=>$types,
            'memberTypes'=>$memberTypes,
            'volunteeringFields'=>$volunteeringFields,
            'ageTypes'=>$ageTypes,
            'activeStatus'=>$activeStatus,
            'officers'=>$officers

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $opportunity=Opportunity::where('id',$id)->first();
        $current_date_time=Carbon::now()->toDateTimeString();
        $data=array(
            'organization_id'=>$request->input('organization_id'),
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'start_date'=>$request->input('start_date'),
            'end_date'=>$request->input('end_date'),
            'support_for_volunteer'=>$request->input('support_for_volunteer'),
            'benefit_for_volunteer'=>$request->input('benefit_for_volunteer'),
            'issues'=>$request->input('issues'),
            'volunteering_field_id'=>$request->input('volunteering_field_id'),
            'city'=>$request->input('city'),
            'status_id'=>$request->input('status_id'),
            'officer_id'=>$request->input('officer_id'),
            'type_id'=>$request->input('type_id'),
            'member_type_id'=>$request->input('member_type_id'),
            'age_type_id'=>$request->input('age_type_id'),
            'no_of_volunteers'=>$request->input('no_of_volunteers'),
            'no_of_hours'=>$request->input('no_of_hours'),
            'created_at'=>$current_date_time,
            'updated_at'=>$current_date_time
        );
        $file = $request->file('report_image');
        $current_timestamp = Carbon::now()->timestamp;

        if(Auth::user()->role_id == User::TYPE_VOLUNTEER_OPPORTUNITY_OFFICER)
        {
            $data[ 'officer_id']=Auth::user()->id;
        }

        if (!empty($file)) {

            $image_path = "public/images/opportunities/reportImage/".$opportunity->report_image;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/opportunities/reportImage/', $filename);
            $data['report_image'] = $filename;
        }

        $file = $request->file('opportunity_image');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {

            $image_path = "public/images/opportunities/".$opportunity->opportunity_image;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/opportunities/', $filename);
            $data['opportunity_image'] = $filename;
        }
        Opportunity::where('id',$id)->update($data);
        return redirect('dashboard/opportunities')->with('success', 'Done Volunteer Opportunity is successfully Updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $opportunity=Opportunity::where('id',$id)->first();
        if (!empty($opportunity))
        {
            try {
                $image_path = "public/images/opportunities/reportImage/".$opportunity->report_image;  // Value is not URL but directory file path
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }

                $image_path = "public/images/opportunities/".$opportunity->opportunity_image;  // Value is not URL but directory file path
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }

                $opportunity->delete();
                return redirect('dashboard/opportunities')->with('success', 'opportunity is successfully Deleted!!');
            }
            catch (\Exception $exception)
            {
                return redirect('dashboard/opportunities')->with('error', 'you can not made this operation Because the record is linked with other records '.$exception->getMessage());
            }
        }
    }


    public function opportunities_Field_based($id)
    {
        Gate::authorize('allowedUsers',collect('opportunities_access'));
        $fieldType=$id;
        $Select_db= Opportunity::where(['opportunities.organization_id'=>Auth::user()->organization_id,'volunteering_field_id'=>$fieldType])
            ->leftJoin('users','opportunities.officer_id','=','users.id')
            ->leftJoin('lkp_active_status','opportunities.status_id','=','lkp_active_status.id')
            ->leftJoin('organizations','opportunities.organization_id','=','organizations.id')
            ->select( 'opportunities.id', 'title','users.name','opportunities.organization_id','opportunities.status_id','lkp_active_status.status','organizations.name_en','organizations.name_ar','opportunities.city')
            ->orderBy('opportunities.id','DESC');


        if (request()->ajax()) {
            return datatables()->of($Select_db)->make(true);
        }
        return view('Dashboard.VolunteerOpportunities.opportunities_Field_based',compact('fieldType'));
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Opportunity;
use App\VolunteeringField;
use Facade\FlareClient\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Gate;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class VolunteerFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        Gate::authorize('allowedUsers',collect('volunteer_fields_access'));

//        $Select_db= VolunteeringField::leftJoin('opportunities','volunteering_fields.id','=','opportunities.volunteering_field_id')
//            ->select('volunteering_fields.id as id','field_en','field_ar',
//                DB::raw("count(opportunities.volunteering_field_id) AS total_opportunities"))
//           // ->where('opportunities.organization_id',Auth::user()->organization_id)
//        ->groupBy('volunteering_fields.id','field_en','field_ar');

        $volunteerFields=VolunteeringField::all();
        foreach ($volunteerFields as $field)
        {
            $field->total_opportunities=Opportunity::where('volunteering_field_id',$field->id)->count();
        }

        if (request()->ajax()) {

            return datatables()->of($volunteerFields)->make(true);
        }
        return view('Dashboard.VolunteerField.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('Dashboard.VolunteerField.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        VolunteeringField::create([
            'field_en' => $request->input('field_en'),
            'field_ar' => $request->input('field_ar')
        ]);

        return redirect('dashboard/volunteerFields')->with('success', 'Done Volunteer Field is successfully Registered');
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
     * @param int $id
     * @return Factory|View
     * @return Application|Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $field= VolunteeringField::where('volunteering_fields.id',$id)
            ->leftJoin('opportunities','volunteering_fields.id','=','opportunities.volunteering_field_id')
            ->select('volunteering_fields.id as id','field_en','field_ar',
                DB::raw("count(opportunities.volunteering_field_id) AS total_opportunities"))
            ->groupBy('volunteering_fields.id','field_en','field_ar')
            ->first();
        return view('Dashboard.VolunteerField.edit')->with('field',$field);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $field=VolunteeringField::where('id',$id)->update([
            'field_en'=>$request->input('field_en'),
            'field_ar'=>$request->input('field_ar')
        ]);
        return redirect('dashboard/volunteerFields')->with('success', 'Done Volunteer Field is successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $field=VolunteeringField::where('id',$id)->first();
        if (!empty($field))
        {
            try {
                $field->delete();
                return redirect('dashboard/volunteerFields')->with('success', 'Volunteering Field is successfully Deleted!!');
            }
            catch (\Exception $exception)
            {
                return redirect('dashboard/volunteerFields')->with('error', 'you can not made this operation Because the record is linked with other records '.$exception->getMessage());
            }
        }
    }
}

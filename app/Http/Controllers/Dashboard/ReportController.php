<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Opportunity;
use App\Organization;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Gate;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
//    public function index()
//    {
//        Gate::authorize('allowedUsers',collect('reports_access'));
//
//        $totalVolunteers=User::where(['role_id'=>User::TYPE_VOLUNTEER,'organization_id'=>Auth::user()->organization_id])->count();
//        $totalVolunteerOpportunities=Opportunity::where('organization_id',Auth::user()->organization_id)->count();
//
//
//
//        $Select_db= Organization::leftJoin('opportunities','organizations.id','=','opportunities.organization_id')
//            ->leftJoin('users','organizations.id','=','users.organization_id')
//            ->select('organizations.id as id','name_en',
//                DB::raw("count(opportunities.organization_id) AS total_opportunities"),
//                DB::raw("count(users.organization_id) AS total_Volunteers ")
//            )
//            // ->where('users.role_id',User::TYPE_VOLUNTEER)
//            ->groupBy('organizations.id','name_en');
//
//        if (request()->ajax()) {
//            return datatables()->of($Select_db)->make(true);
//        }
//        return view('Dashboard.VolunteerReports.index',compact('totalVolunteers','totalVolunteerOpportunities'));
//    }

    public function index()
    {
        Gate::authorize('allowedUsers',collect('reports_access'));

        $totalVolunteers=User::where(['role_id'=>User::TYPE_VOLUNTEER,'organization_id'=>Auth::user()->organization_id])->count();
        $totalVolunteerOpportunities=Opportunity::where('organization_id',Auth::user()->organization_id)->count();

        $organizations=Organization::all();

        foreach ($organizations as $organization)
        {
            $organization->total_opportunities=Opportunity::where('organization_id',$organization->id)->count();
            $organization->total_Volunteers=User::where(['organization_id'=>$organization->id, 'role_id'=>User::TYPE_VOLUNTEER])->count();
        }
        if (request()->ajax()) {
            return datatables()->of($organizations)->make(true);
        }
        return view('Dashboard.VolunteerReports.index',compact('totalVolunteers','totalVolunteerOpportunities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Counter;
use App\Http\Controllers\Controller;
use App\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        $organization=Organization::where('id',Auth::user()->organization_id)->first();
        $counter=Counter::where('id',1)->select('data_selection','no_of_volunteer', 'no_of_volunteer_opportunities', 'no_of_volunteer_hours','no_of_organizations')->first();
        if ($counter->data_selection == 'Database')
        {
            $counter=DB::select("SELECT
                                        (SELECT COUNT(*) FROM users where (role_id=5) ) as no_of_volunteer,
                                        (SELECT COUNT(*) FROM opportunities) as no_of_volunteer_opportunities,
                                        (SELECT COUNT(*) FROM opportunities ) as no_of_volunteer_hours,
                                        (SELECT COUNT(*) FROM organizations) as no_of_organizations")[0];
        }
        return view('Dashboard/home',compact('counter','organization'));
    }



}

<?php

namespace App\Http\Controllers\Website;

use App\AnimatedSlide;
use App\Counter;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebsiteBaseController;
use App\Message;
use App\News;
use App\Opportunity;
use App\Organization;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class HomeController extends WebsiteBaseController
{
    public function index()
    {
        $counters=Counter::select( 'data_selection','no_of_volunteer', 'no_of_volunteer_opportunities', 'no_of_volunteer_hours','no_of_organizations')->first();
        if ($counters->data_selection == 'Database')
        {
            $counters=DB::select("SELECT
                                        (SELECT COUNT(*) FROM users where (role_id=5) ) as no_of_volunteer,
                                        (SELECT COUNT(*) FROM opportunities) as no_of_volunteer_opportunities,
                                        (SELECT COUNT(*) FROM opportunities ) as no_of_volunteer_hours,
                                        (SELECT COUNT(*) FROM organizations) as no_of_organizations")[0];
        }
        $opportunities= Opportunity::leftJoin('organizations','opportunities.organization_id','=','organizations.id')
            ->leftJoin('volunteering_fields','opportunities.volunteering_field_id','=','volunteering_fields.id')
            ->select('opportunities.id','opportunities.start_date','opportunities.title','opportunities.end_date','organizations.name_en','organizations.logo','opportunities.status_id','volunteering_fields.*')
            ->orderBy('opportunities.id','DESC')
            ->paginate(3);

        $slides=AnimatedSlide::where('status_id',1)->get();

        $news=News::where('status_id',1)->select('id','description' , 'image')->orderBy('id','DESC')
            ->paginate(3);
        $organizations=Organization::all();
        return view('Website.home',compact('opportunities','counters','news','slides','organizations'));
    }

    public function about_us()
    {
        return view('Website.aboutUs');
    }

    public function contact_us()
    {
        return view('Website.contact_us');
    }

    public function sendMessage()
    {
        $current_date_time = Carbon::now()->toDateTimeString();
        $user=Auth::user();
        Message::create([
            'user_id'=>$user->id,
            'name'=>request('name'),
            'email'=>request('email'),
            'phone'=>request('phone'),
            'subject'=>request('subject'),
            'message'=>request('message'),
            'created_at'=>$current_date_time,
            'updated_at'=>$current_date_time
        ]);

        Session::flash('message', "Your message is successfully Received, we will contact you as soon as we can.");
        return redirect()->back();
    }
}

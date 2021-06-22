<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebsiteBaseController;
use App\Opportunity;
use App\Page;
use Illuminate\Http\Request;

class OpportunityController extends WebsiteBaseController
{
    public function index()
    {
        $opportunities_page=Page::where(['is_menu_bar'=>1,'status_id'=>1,'id'=>3])->first();

        $opportunities= Opportunity::leftJoin('organizations','opportunities.organization_id','=','organizations.id')
        ->leftJoin('volunteering_fields','opportunities.volunteering_field_id','=','volunteering_fields.id')
        ->select('opportunities.id','opportunities.start_date','opportunities.title','opportunities.end_date','organizations.name_en','organizations.logo','opportunities.status_id')
        ->orderBy('opportunities.id','DESC')
        ->paginate(12);
        return view('Website.Opportunities.index',compact('opportunities','opportunities_page'));
    }


    public function details($id)
    {
        $opportunities_page=Page::where(['is_menu_bar'=>1,'status_id'=>1,'id'=>3])->first();

        $opportunity= $opportunities= Opportunity::leftJoin('organizations','opportunities.organization_id','=','organizations.id')
            ->leftJoin('volunteering_fields','opportunities.volunteering_field_id','=','volunteering_fields.id')
            ->leftJoin('lkp_age_types','opportunities.age_type_id','=','lkp_age_types.id')
            ->leftJoin('users','opportunities.officer_id','=','users.id')
            ->select('opportunities.id','opportunities.start_date','opportunities.title','opportunities.end_date',
                'organizations.name_en','organizations.logo','opportunities.description','volunteering_fields.field_en',
                'volunteering_fields.field_ar','no_of_volunteers','no_of_hours','age_type_id','lkp_age_types.type',
                'users.email','users.contact_number')
            ->where('opportunities.id',$id)->first();
        if (!empty($opportunity))
        {
            return view('Website.Opportunities.details',compact('opportunity','opportunities_page'));
        }
        else
        {
            return view('Website.notFound');
        }
    }
}

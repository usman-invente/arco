<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Organization;
use App\Page;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index($id=1)
    {
        $organization=Organization::where('id',$id)->first();
        $organization_page=Page::where(['is_menu_bar'=>1,'status_id'=>1,'id'=>4])->first();

        $organizations=Organization::all();
        if (!empty($organization))
        {
            return view('Website.organizations',compact('organization','organizations','id','organization_page'));
        }
        else
            return view('Website.notFound');

    }
}

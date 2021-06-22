<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($id)
    {
        $page=Page::where('id',$id)->first();
        if (!empty($page))
        {
            return view('Website.static',compact('page'));
        }
        else
            return view('Website.notFound');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Counter;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $counter =Counter::first();

        return view('home',compact('counter'));
    }
     
}

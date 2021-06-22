<?php

namespace App\Http\Controllers\Dashboard;

use App\Counter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $counter=Counter::where('id',1)->select('data_selection','no_of_volunteer', 'no_of_volunteer_opportunities', 'no_of_volunteer_hours','no_of_organizations')->first();
        return view('Dashboard.staticPages.counter',compact('counter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        Counter::where('id',1)->update([
            'data_selection'=>$request->input('data_selection'),
            'no_of_volunteer'=>$request->input('no_of_volunteer'),
            'no_of_volunteer_opportunities'=>$request->input('no_of_volunteer_opportunities'),
            'no_of_volunteer_hours'=>$request->input('no_of_volunteer_hours'),
            'no_of_organizations'=>$request->input('no_of_organizations')
        ]);
        return redirect('dashboard/counters')->with('success', 'Done Counters are successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Logo;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $logos=Logo::all();
        return view('Dashboard.staticPages.logos',compact('logos'));
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
        //
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
        $logos=Logo::all();
        $file = $request->file('logo_head');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {

//            $image_path = "public/images/".$logos[0]->logo;  // Value is not URL but directory file path
//            if(File::exists($image_path)) {
//                File::delete($image_path);
//            }

            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/', $filename);
            $data['logo'] = $filename;
            Logo::where('id',1)->update(['logo'=>$filename]);
        }

        $file = $request->file('logo_footer');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {

//            $image_path = "public/images/".$logos[1]->logo;  // Value is not URL but directory file path
//            if(File::exists($image_path)) {
//                File::delete($image_path);
//            }

            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/', $filename);
            $data['logo'] = $filename;
            Logo::where('id',2)->update(['logo'=>$filename]);
        }

        return redirect('dashboard/logos')->with('success', 'Done Logos are successfully updated');
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

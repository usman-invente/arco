<?php

namespace App\Http\Controllers\Dashboard;

use App\Footer;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $footer=Footer::where('id',1)->first();
        return view('Dashboard.staticPages.footer',compact('footer'));
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
     * @param Request $request
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
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $footer=Footer::where('id',1)->first();
        $data=[
            'description' => $request->input('description'),
            'facebook' => $request->input('facebook'),
            'twitter' => $request->input('twitter'),
            'instagram' => $request->input('instagram'),
            'youtube' => $request->input('youtube')
        ];

        $file = $request->file('footer_image');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {

            if ($footer->footer_image != "dummy-img-1920x900-3.jpg")
            {
                $image_path = "public/images/".$footer->footer_image;  // Value is not URL but directory file path
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/', $filename);
            $data['footer_image'] = $filename;
        }

        Footer::where('id',1)->update($data);
        return redirect('dashboard/footer')->with('success', 'Done Footer is successfully updated');
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

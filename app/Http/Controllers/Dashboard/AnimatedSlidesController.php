<?php

namespace App\Http\Controllers\Dashboard;

use App\AnimatedSlide;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AnimatedSlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $Select_db= AnimatedSlide::select('animated_slides.id as id', 'animated_slides.name', 'image', 'status_id','created_at','lkp_active_status.status','sequence')
            ->leftJoin('lkp_active_status','animated_slides.status_id','=','lkp_active_status.id');

        if (request()->ajax()) {
            return datatables()->of($Select_db)->make(true);
        }

        return view('Dashboard.AnimatedSlides.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $activeStatus=DB::table('lkp_active_status')->get();
        return view('Dashboard.AnimatedSlides.create')->with([ 'activeStatus'=>$activeStatus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $data=array(
            'name' => $request->input('name'),
            'sequence' => $request->input('sequence'),
            'status_id' => $request->input('status_id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $file = $request->file('image');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {
            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/animatedSlides/', $filename);
            $data['image'] = $filename;
        }



        AnimatedSlide::create($data);
        return redirect('dashboard/animatedSlides')->with('success', 'Done News is successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $slide= AnimatedSlide::where('animated_slides.id',$id)->select( 'animated_slides.id as id', 'name', 'sequence', 'image', 'status_id', 'created_at', 'updated_at','lkp_active_status.status')
            ->leftJoin('lkp_active_status','animated_slides.status_id','=','lkp_active_status.id')
            ->first();
        // Log::info($page);
        return view('Dashboard.AnimatedSlides.show')->with('slide',$slide);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $slide= AnimatedSlide::where('animated_slides.id',$id)->select( 'animated_slides.id as id', 'name', 'sequence', 'image', 'status_id', 'created_at', 'updated_at','lkp_active_status.status')
            ->leftJoin('lkp_active_status','animated_slides.status_id','=','lkp_active_status.id')
            ->first();
        $activeStatus=DB::table('lkp_active_status')->get();
        return view('Dashboard.AnimatedSlides.edit')->with(['slide'=>$slide, 'activeStatus'=>$activeStatus]);
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
        $animatedSlide=AnimatedSlide::where('id',$id)->first();
        $data=array(
            'name' => $request->input('name'),
            'sequence' => $request->input('sequence'),
            'status_id' => $request->input('status_id'),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $file = $request->file('image');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {

            $image_path = "public/images/animatedSlides/".$animatedSlide->image;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/animatedSlides/', $filename);
            $data['image'] = $filename;

        }

        AnimatedSlide::where('id',$id)->update($data);
        return redirect('dashboard/animatedSlides')->with('success', 'Done Slide is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        $animatedSlide=AnimatedSlide::where('id',$id)->first();
        $image_path = "public/images/animatedSlides/".$animatedSlide->image;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        AnimatedSlide::where('id',$id)->delete();
        return redirect('dashboard/animatedSlides')->with('success', 'Done Slide is successfully Deleted!!');

    }
}

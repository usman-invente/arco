<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Page;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $Select_db= Page::select( 'pages.id as id','title_en','title_ar' ,'content','status_id' , 'updated_by_id','lkp_page_status.status','users.name','pages.updated_at','is_menu_bar')
            ->leftJoin('lkp_page_status','pages.status_id','=','lkp_page_status.id')
            ->leftJoin('users','pages.updated_by_id','=','users.id');
        if (request()->ajax()) {
            return datatables()->of($Select_db)->make(true);
        }
        return view('Dashboard.Pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $pageStatus=DB::table('lkp_page_status')->get();
        return view('Dashboard.Pages.create')->with([ 'pageStatus'=>$pageStatus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        //Log::info($request->all());

        $file = $request->file('page_image');
        $current_timestamp = Carbon::now()->timestamp;
        $page_image="dummy-img-1920x300.jpg";
        if (!empty($file)) {
            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/pages/', $filename);
            $page_image = $filename;
        }

        Page::create([
            'title_en' =>$request->input('title_en'),
            'title_ar' =>$request->input('title_ar'),
            'heading'=>$request->input('heading'),
            'content'=>$request->input('content'),
            'status_id'=>$request->input('status_id'),
            'page_image'=>$page_image,
            'updated_by_id'=>Auth::user()->id
        ]);
        return redirect('dashboard/pages')->with('success', 'Done successfully Page is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $page= Page::where('pages.id',$id)->select( 'pages.id as id','title_en','title_ar','page_image','heading' ,'content','status_id' , 'updated_by_id','lkp_page_status.status','users.name','pages.updated_at','pages.created_at')
            ->leftJoin('lkp_page_status','pages.status_id','=','lkp_page_status.id')
            ->leftJoin('users','pages.updated_by_id','=','users.id')
            ->first();
       // Log::info($page);
        return view('Dashboard.Pages.show')->with('page',$page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $page= Page::where('pages.id',$id)->select( 'pages.id as id','title_en','title_ar','page_image','heading' ,'content','status_id','is_menu_bar' , 'updated_by_id','lkp_page_status.status','users.name','pages.updated_at','pages.created_at')
            ->leftJoin('lkp_page_status','pages.status_id','=','lkp_page_status.id')
            ->leftJoin('users','pages.updated_by_id','=','users.id')
            ->first();
        $pageStatus=DB::table('lkp_page_status')->get();
        return view('Dashboard.Pages.edit')->with(['page'=>$page, 'pageStatus'=>$pageStatus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $page=Page::where('id',$id)->first();

        $file = $request->file('page_image');
        $current_timestamp = Carbon::now()->timestamp;
        $page_image=$page->page_image;
        if (!empty($file)) {

            if ($page->page_image != "dummy-img-1920x300.jpg")
            {
                $image_path = "public/images/pages/".$page->page_image;  // Value is not URL but directory file path
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/pages/', $filename);
            $page_image = $filename;

        }
        Page::where('id',$id)->update([
            'title_en' =>$request->input('title_en'),
            'title_ar' =>$request->input('title_ar'),
            'heading'=>$request->input('heading'),
            'content'=>$request->input('content'),
            'status_id'=>$request->input('status_id'),
            'updated_by_id'=>Auth::user()->id,
            'page_image'=>$page_image

        ]);
        return redirect('dashboard/pages')->with('success', 'successfully Updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        $page=Page::where('id',$id)->first();
        if ($page->page_image != "dummy-img-1920x300.jpg") {
            $image_path = "public/images/pages/" . $page->page_image;  // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $page->delete();
        return redirect('dashboard/pages')->with('success', 'successfully Deleted!!');
    }
}

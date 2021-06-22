<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\News;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $Select_db= News::select( 'news.id as id','description' ,'news.address', 'image',  'content', 'status_id', 'updated_by_id','lkp_page_status.status','users.name','news.created_at')
                    ->leftJoin('lkp_page_status','news.status_id','=','lkp_page_status.id')
                    ->leftJoin('users','news.updated_by_id','=','users.id');

        if (request()->ajax()) {
            return datatables()->of($Select_db)->make(true);
        }
        return view('Dashboard.News.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $pageStatus=DB::table('lkp_page_status')->get();
        return view('Dashboard.News.create')->with([ 'pageStatus'=>$pageStatus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse|Redirector
     */

    public function store(Request $request)
    {
        $data=array(
                'address' => $request->input('address'),
                'description' => $request->input('description'),
                'content' => $request->input('content'),
                'status_id' => $request->input('status_id'),
                'created_by_id' => 1,
                'updated_by_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );

        $file = $request->file('image');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {
            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/news/', $filename);
            $data['image'] = $filename;
        }

        News::create($data);
        return redirect('dashboard/news')->with('success', 'Done News is successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $new= News::where('news.id',$id)->select( 'news.id as id','description' ,'news.address', 'image',  'content', 'status_id', 'updated_by_id','lkp_page_status.status','users.name','news.created_at')
            ->leftJoin('lkp_page_status','news.status_id','=','lkp_page_status.id')
            ->leftJoin('users','news.updated_by_id','=','users.id')
            ->first();
        // Log::info($page);
        return view('Dashboard.News.show')->with('new',$new);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $new= News::where('news.id',$id)->select( 'news.id as id','description' ,'news.address', 'image',  'content', 'status_id', 'updated_by_id','lkp_page_status.status','users.name','news.created_at')
            ->leftJoin('lkp_page_status','news.status_id','=','lkp_page_status.id')
            ->leftJoin('users','news.updated_by_id','=','users.id')
            ->first();
        $pageStatus=DB::table('lkp_page_status')->get();
        return view('Dashboard.News.edit')->with(['new'=>$new, 'pageStatus'=>$pageStatus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $news=News::where('id',$id)->first();
        $data=array(
            'address' => $request->input('address'),
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'status_id' => $request->input('status_id'),
            'updated_by_id' => Auth::user()->id,
            'updated_at' => date("Y-m-d H:i:s")
        );


        $file = $request->file('image');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {

            $image_path = "public/images/news/".$news->image;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/news/', $filename);
            $data['image'] = $filename;

        }


        News::where('id',$id)->update($data);
        return redirect('dashboard/news')->with('success', 'Done News is successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        $news=News::where('id',$id)->first();
        $image_path = "public/images/news/".$news->image;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $news=News::where('id',$id)->delete();
        return redirect('dashboard/news')->with('success', 'Done News is successfully Deleted!');

    }
}

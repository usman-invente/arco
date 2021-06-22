<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Organization;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Gate;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     * @throws \Exception
     */
    public function index()
    {

        Gate::authorize('allowedUsers',collect('organizations_access'));

        $Select_db= Organization::select('organizations.id as id', 'organizations.name_en','logo','users.name','users.email')
            ->leftJoin('users','organizations.user_id','=','users.id')
            ->orderBy('id','ASC');
        if (request()->ajax()) {
            return datatables()->of($Select_db)->make(true);
        }
        return view('Dashboard.Organization.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('Dashboard.Organization.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $user=User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact_number' => $request->input('contact_number'),
            'password' => Hash::make($request->input('password')),
        ]);

        $data=array(
            'name_en' => $request->input('assemblyName_en'),
            'name_ar' => $request->input('assemblyName_ar'),
            'banner' => null,
            'logo' => null,
            'user_id' => $user->id,
            'site_url'=>$request->input('site_url'),
            'details'=>$request->input('details'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $file = $request->file('logo');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {
            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/organizations/', $filename);
            $data['logo'] = $filename;
        }

        $file = $request->file('banner');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {
            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/organizations/banner/', $filename);
            $data['banner'] = $filename;
        }

        $organization=Organization::create($data);
        $user->update([
                        'role_id' => 2,
                        'organization_id' => $organization->id
        ]);

        return redirect('dashboard/organizations')->with('success', 'Done organization is successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show($id)
    {
        $organization= Organization::where('organizations.id',$id)->select('organizations.id as id', 'organizations.name_en','organizations.name_ar','logo','banner','users.name','users.email','users.contact_number','site_url','details')
            ->leftJoin('users','organizations.user_id','=','users.id')
            ->first();

        // Log::info($organization);
        return view('Dashboard.Organization.show')->with('organization',$organization);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $organization= Organization::where('organizations.id',$id)->select('organizations.id as id','user_id','organizations.name_en','organizations.name_ar','organizations.site_url','organizations.details','logo','banner','users.name','users.email','users.contact_number')
            ->leftJoin('users','organizations.user_id','=','users.id')
            ->first();

        return view('Dashboard.Organization.edit')->with(['organization'=>$organization]);
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

        $organization=Organization::where('id',$id)->first();
        $data=array(
            'name_en'=>$request->input('assemblyName_en'),
            'name_ar'=>$request->input('assemblyName_ar'),
            'site_url'=>$request->input('site_url'),
            'details'=>$request->input('details'),
        );

        $file = $request->file('logo');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {

            $image_path = "public/images/organizations/".$organization->logo;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/organizations/', $filename);
            $data['logo'] = $filename;
        }

        $file = $request->file('banner');

        if (!empty($file)) {

            $image_path = "public/images/organizations/banner/".$organization->banner;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $extension = $file->getClientOriginalExtension();
            $filename =  $current_timestamp . "." . $extension;
            $file->move('public/images/organizations/banner/', $filename);
            $data['banner'] = $filename;
        }

        Organization::where('id',$id)->update($data);
        return redirect('dashboard/organizations')->with('success', 'Done Organization is successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organization=Organization::where('id',$id)->first();
        if (!empty($organization))
        {
            try {

                $image_path = "public/images/organizations/".$organization->logo;  // Value is not URL but directory file path
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }

                $image_path = "public/images/organizations/banner/".$organization->banner;  // Value is not URL but directory file path
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }

                $organization->delete();
                return redirect('dashboard/organizations')->with('success', 'Organization is successfully Deleted!!');
            }
            catch (\Exception $exception)
            {
                return redirect('dashboard/organizations')->with('error', 'you can not made this operation Because the record is linked with other records '.$exception->getMessage());
            }
        }
    }
}

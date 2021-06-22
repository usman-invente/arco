<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\News;
use App\Opportunity;
use App\Organization;
use App\User;
use App\VolunteeringField;
use Carbon\Carbon;
use DB;
use Gate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        Gate::authorize('allowedUsers', collect('profiles_access'));

        $user = User::where(['users.role_id' => Auth::user()->role_id, 'users.id' => Auth::user()->id])
            ->leftJoin('lkp_active_status', 'users.activeStatus_id', '=', 'lkp_active_status.id')
            ->leftJoin('organizations', 'users.organization_id', '=', 'organizations.id')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.id as id', 'name', 'users.email', 'contact_number', 'role_id', 'organization_id', 'activeStatus_id', 'lkp_active_status.status', 'organizations.name_en', 'organizations.name_ar', 'role', 'users.city', 'users.address', 'person_picture', 'passport_picture')
            ->first();
        $organizations = Organization::all();
        return View('Dashboard.Users.userProfile', compact('user', 'organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
   
        public function create(Request $request)
        {
           $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'contact_number' => 'required',
            'address' => 'required',
            'password' => 'required|confirmed',
           'password_confirmation' => 'required',
            'passport_picture' => 'required',
            'person_picture' => 'required',
        ]);
            $pfilename = "";
    
            if( $request->hasFile('person_picture'))
                    {
                        $image = $request->file('person_picture');
                      //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
                        $path = public_path(). '/upload/personal/';
                        $pfilename = time() . '.' . $image->getClientOriginalExtension();
                        $image->move($path, $pfilename);
                        $request->person_picture = $pfilename ;
                    }
                $pasfilename = "";
            if( $request->hasFile('passport_picture'))
                    {
                        $image = $request->file('passport_picture');
                      //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
                        $path = public_path(). '/upload/passport/';
                        $pasfilename = time() . '.' . $image->getClientOriginalExtension();
                        $image->move($path, $pasfilename);
                        $request->passport_picture = $pasfilename ;
                    }
            $inputs = $request->all();
            $inputs["person_picture"] = $pfilename;
            $inputs["passport_picture"] = $pasfilename;
            $password=Hash::make($inputs['password']);
            $inputs["password"]=$password;
            User::create($inputs);
            return redirect()->route('admin_Volunteer_Supervisor');
        }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $Volunteer_Supervisor = User::find($id);
        $organization = Organization::all();
        return view ('Dashboard.VolunteerSupervisors.edit',compact('Volunteer_Supervisor','organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where(['users.role_id' => Auth::user()->role_id, 'users.id' => $id])->first();

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'max:255', 'unique:users,email,' . $user->id],
            'contact_number' => ['required', 'max:20'],
            'city' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:100'],
        ]);

        $data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact_number' => $request->input('contact_number'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
        );

//        if (!empty($request->input('password')))
        //        {
        //           $data['password']  = Hash::make($request->input('password'));
        //        }

        $file = $request->file('person_picture');
        $current_timestamp = Carbon::now()->timestamp;

        $person_image = null;
        $passport_image = null;
        if ($user->role_id == User::TYPE_ADMIN) {
            $person_image = 'public/images/users/admins';
            $passport_image = 'public/images/users/admins/passport';
        } elseif ($user->role_id == User::TYPE_VOLUNTEER_SUPERVISOR) {
            $person_image = 'public/images/users/volunteerSupervisors';
            $passport_image = 'public/images/users/volunteerSupervisors/passport';
        } elseif ($user->role_id == User::TYPE_VOLUNTEER_OPPORTUNITY_OFFICER) {
            $person_image = 'public/images/users/opportunityOfficers';
            $passport_image = 'public/images/users/opportunityOfficers/passport';
        } elseif ($user->role_id == User::TYPE_VOLUNTEER) {
            $person_image = 'public/images/users/volunteers';
            $passport_image = 'public/images/users/volunteers/passport';
        } elseif ($user->role_id == User::TYPE_SITE_ADMIN) {
            $person_image = 'public/images/users/siteAdmins';
            $passport_image = 'public/images/users/siteAdmins/passport';
        }

        if (!empty($file)) {

            $image_path = $person_image . $user->person_picture; // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $extension = $file->getClientOriginalExtension();
            $filename = $current_timestamp . "." . $extension;
            $file->move($person_image, $filename);
            $data['person_picture'] = $filename;
        }

        $file = $request->file('passport_picture');
        $current_timestamp = Carbon::now()->timestamp;

        if (!empty($file)) {
            $image_path = $passport_image . $user->passport_picture; // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $extension = $file->getClientOriginalExtension();
            $filename = $current_timestamp . "." . $extension;
            $file->move($passport_image, $filename);
            $data['passport_picture'] = $filename;
        }

        User::where('id', $id)->update($data);
        return redirect('dashboard/admins')->with('success', 'Done Admin Profile is successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function changePassword(Request $request, $id)
    {
        $this->validate($request, [
            'currentPassword' => ['required', function ($attribute, $value, $fail) {
                if (!\Hash::check($value, Auth::user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        User::where('id', Auth::user()->id)->update(['password' => Hash::make($request->input('password'))]);
        return redirect('dashboard/admins')->with('success', 'Done Admin Password is successfully updated!!');

    }

    public function Opportunity_Officers(Request $request)
    {
        // $Volunteer_Supervisor = User::where('role_id',4)->get();
        return view('Dashboard.VolunteerOpportunityOfficers.index');
    }

    public function getVoodata(Request $request)
    {

        $columns = array(
            0 => 'name',
            1 => 'email',
            2 => 'role',
            3 => 'status',
            4 => 'created_at',
            5 => 'action',
        );
        $totalData = User::where('role_id', 4)->count();
        $totalFiltered = $totalData;
         if ($request->input('length') == -1) {
            $limit =  $totalData;
        }else{
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            $posts = User::where('role_id', 4)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $posts = User::where(function ($query) use ($search) {
                $query->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhereRaw('DATE_FORMAT(`created_at`, "%d-%m-%Y") LIKE ? ', [$search . '%']);
            })
                ->where('role_id', 4)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = User::where(function ($query) use ($search) {
                $query->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhereRaw('DATE_FORMAT(`created_at`, "%d-%m-%Y") LIKE ? ', [$search . '%']);
            })
                ->where('role_id', 4)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->count();
        }
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $delete = route('admin_delete_Volunteer_Opportunity_Officers', $post->id);
                $edit = route('admin_edit_Volunteer_Opportunity_Officers', $post->id);
                 $nestedData['checkbox'] =  "<input type='checkbox' class='delete_check' id='delcheck_".$post->id."' onclick='checkcheckbox();' value='".$post->id."'>";
                $nestedData['name'] = $post->name;
                $nestedData['email'] = $post->email;
                $nestedData['role'] = "<div class='badge badge-success'>Volunteer Opportunity Officer</div>";
                $nestedData['created_at'] = date('d-m-Y', strtotime($post->created_at));
                $nestedData['action'] = "&emsp;
                   <a class='mr-1 delcomp'  href='{$delete}'> <i class='fa fa-trash-o text-danger'></i><a>
                   <a  style='display: contents;' class='mr-1 delcomp'  href='{$edit}'><i class='fa fa-pencil text-info'></i><a>
                   ";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        echo json_encode($json_data);

    }
    public function getAovpdata(Request $request)
    {

        $columns = array(
            0 => 'name',
            1 => 'domain',
            3 => 'url',
        );
        $totalData = VolunteeringField::count();
        $totalFiltered = $totalData;
        if ($request->input('length') == -1) {
            $limit =  $totalData;
        }else{
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            $posts = VolunteeringField::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $posts = VolunteeringField::where('name', 'LIKE', "%{$search}%")
                ->orWhere('domain', 'LIKE', "%{$search}%")
                ->orWhere('url', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = VolunteeringField::where('name', 'LIKE', "%{$search}%")
                ->orWhere('domain', 'LIKE', "%{$search}%")
                ->orWhere('url', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->count();
        }
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $delete = route('admin_delete_volunteer_field', $post->id);
                $edit = route('admin_edit_volunteer_field', $post->id);
                  $nestedData['checkbox'] =  "<input type='checkbox' class='delete_check' id='delcheck_". $post->id."' onclick='checkcheckbox();' value='". $post->id."'>";
                $nestedData['name'] = $post->name;
                $nestedData['domain'] = $post->domain;
                $nestedData['url'] = $post->url;
                $nestedData['action'] = "&emsp;
                   <a class='mr-1 delcomp'  href='{$delete}'> <i class='fa fa-trash-o text-danger'></i><a>
                   <a class='mr-1 delcomp'   href='{$edit}'><i class='fa fa-pencil text-primary' ></i><a>
                   ";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        echo json_encode($json_data);

    }
    public function getMvodata(Request $request)
    {

        $columns = array(
            0 => 'title',
            1 => 'name_en',
            2 => 'city',
        );
        $totalData = Opportunity::join('users', 'opportunities.officer_id', '=', 'users.id')
        ->join('organizations', 'opportunities.organization_id', '=', 'organizations.id')
        ->select('opportunities.*','users.name','organizations.name_en')
        ->count();
        $totalFiltered = $totalData;
         if ($request->input('length') == -1) {
            $limit =  $totalData;
        }else{
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            $posts =  Opportunity::join('users', 'opportunities.officer_id', '=', 'users.id')
            ->join('organizations', 'opportunities.organization_id', '=', 'organizations.id')
            ->select('opportunities.*','users.name','organizations.name_en')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $posts =  Opportunity::join('users', 'opportunities.officer_id', '=', 'users.id')
            ->join('organizations', 'opportunities.organization_id', '=', 'organizations.id')
                ->select('opportunities.*','users.name','organizations.name_en')
                ->where('opportunities.title', 'LIKE', "%{$search}%")
                ->orWhere('users.name', 'LIKE', "%{$search}%")
                ->orWhere('organizations.name_en', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Opportunity::join('users', 'opportunities.officer_id', '=', 'users.id')
            ->join('organizations', 'opportunities.organization_id', '=', 'organizations.id')
                ->select('opportunities.*','users.name','organizations.name_en')
                ->where('opportunities.title', 'LIKE', "%{$search}%")
                ->orWhere('users.name', 'LIKE', "%{$search}%")
                ->orWhere('organizations.name_en', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->count();
        }
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $delete = route('admin_delete_Volunteer_Opportunity', $post->id);
                $edit = route('admin_edit_Volunteer_Opportunity', $post->id);
                $nestedData['checkbox'] = "<input type='checkbox' class='delete_check' id='delcheck_". $post->id."' onclick='checkcheckbox();' value='". $post->id."'>";
                $nestedData['title'] = $post->title;
                $nestedData['name'] = $post->name;
                $nestedData['name_en'] = $post->name_en;
                $nestedData['city'] = $post->city;
                if($post->status_id ==1){
                    $nestedData['status'] = '<div class="badge badge-success">Active</div>';
                }else{
                    $nestedData['status'] = '<div class="badge badge-danger">Deactive</div>';
                }
               
                $nestedData['action'] = "&emsp;
                   <a class='mr-1 delcomp'  href='{$delete}'> <i class='fa fa-trash-o text-danger'></i><a>
                   <a class='mr-1 delcomp'   href='{$edit}'><i class='fa fa-pencil text-primary' ></i><a>
                   ";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        echo json_encode($json_data);

    }
    public function getOrgandata(Request $request)
    {

        $columns = array(
            0 => 'name_en',
            1 => 'name',
            2 => 'email',
            3 => 'contact',
        );
        $totalData = Organization::select('organizations.id as id', 'organizations.name_en', 'logo', 'users.name', 'users.email')
            ->leftJoin('users', 'organizations.user_id', '=', 'users.id')->count();
        $totalFiltered = $totalData;
         if ($request->input('length') == -1) {
            $limit =  $totalData;
        }else{
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            $posts = Organization::select('organizations.id as id', 'organizations.name_en','organizations.contact', 'organizations.supervisor_name','logo', 'users.name', 'users.email')
                ->leftJoin('users', 'organizations.user_id', '=', 'users.id')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

        } else {
            $search = $request->input('search.value');
            $posts = Organization::select('organizations.id as id', 'organizations.name_en','organizations.contact','organizations.supervisor_name', 'logo', 'users.name', 'users.email')
                ->leftJoin('users', 'organizations.user_id', '=', 'users.id')
                ->where('users.name', 'LIKE', "%{$search}%")
                ->orWhere('organizations.name_en', 'LIKE', "%{$search}%")
                ->orWhere('users.email', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Organization::select('organizations.id as id', 'organizations.name_en', 'organizations.contact','organizations.supervisor_name','logo', 'users.name', 'users.email')
                ->leftJoin('users', 'organizations.user_id', '=', 'users.id')
                ->where('users.name', 'LIKE', "%{$search}%")
                ->orWhere('organizations.name_en', 'LIKE', "%{$search}%")
                ->orWhere('users.email', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->count();
        }
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
             
                $delete = route('admin_delete_organization', $post->id);
                $edit = route('admin_edit_organization', $post->id);
                  $nestedData['checkbox'] = "<input type='checkbox' class='delete_check' id='delcheck_". $post->id."' onclick='checkcheckbox();' value='". $post->id."'>";
                $nestedData['name_en'] = $post->name_en;
                $nestedData['name'] = $post->supervisor_name;
                $nestedData['email'] = $post->email;
                $nestedData['contact'] = $post->contact;
                $nestedData['action'] = "&emsp;
                   <a class='mr-1 delcomp'  href='{$delete}'> <i class='fa fa-trash-o text-danger'></i><a>
                   <a class='mr-1 delcomp'   href='{$edit}'><i class='fa fa-pencil  text-primary' ></i><a>
                   ";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        echo json_encode($json_data);

    }
    public function getVolnpdata(Request $request)
    {

        $columns = array(
            0 => 'name',
            1 => 'email',
            2 => 'number',
            3 => 'status',
            4 => 'created_at',
        );
        $totalData = User::where('role_id', User::TYPE_VOLUNTEER)
            ->count();
        $totalFiltered = $totalData;
         if ($request->input('length') == -1) {
            $limit =  $totalData;
        }else{
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            $posts = User::where('role_id', User::TYPE_VOLUNTEER)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $posts = User::where('role_id', User::TYPE_VOLUNTEER)
                ->where('email', 'LIKE', "%{$search}%")
                ->orWhere('contact_number', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = User::where('role_id', User::TYPE_VOLUNTEER)
                ->where('email', 'LIKE', "%{$search}%")
                ->orWhere('contact_number', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->count();
        }
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {

                $delete = route('admin_delete_volunteer', $post->id);
                $edit = route('admin_edit_volunteer', $post->id);
                $nestedData['checkbox'] = "<input type='checkbox' class='delete_check' id='delcheck_".$post->id."' onclick='checkcheckbox();' value='".$post->id."'>";
                $nestedData['name'] = $post->name;
                $nestedData['email'] = $post->email;
                $nestedData['number'] = $post->contact_number;
                if ($post->login_status == 1) {
                    $nestedData['status'] = '<div class="badge badge-success">Active</div>';
                } else {
                    $nestedData['status'] = '<div class="badge badge-danger">Deactive</div>';
                }
                if($post->login_status  == 1){
                    $nestedData['action'] = "&emsp;
                    <a class='mr-1 delcomp'  href='{$delete}'> <i class='fa fa-trash-o text-danger'></i><a>
                    <a  data-id='{$post->id}' class='mr-1 deactivate' > <i class='fa fa-ban text-danger'></i><a>
                    ";
                }else{
                    $nestedData['action'] = "&emsp;
                    <a class='mr-1 delcomp'  href='{$delete}'> <i class='fa fa-trash-o text-danger'></i><a>
                    <a  data-id='{$post->id}' class='mr-1 active'  > <i class='fa fa-check text-success'></i><a>
                    ";
                }
               
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        echo json_encode($json_data);

    }
    public function getNewsdata(Request $request)
    {

        $columns = array(
            0 => 'description',
            1 => 'address',
            2 => 'status',
            3 => 'name',
            4 => 'created_at',
        );
        $totalData = News::join('users', 'news.created_by_id', '=', 'users.id')
            ->select('news.*', 'users.name')
            ->count();
        $totalFiltered = $totalData;
         if ($request->input('length') == -1) {
            $limit =  $totalData;
        }else{
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            $posts = News::join('users', 'news.created_by_id', '=', 'users.id')
                ->select('news.*', 'users.name')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $posts = News::join('users', 'news.created_by_id', '=', 'users.id')
                ->select('news.*', 'users.name')
                ->where('users.name', 'LIKE', "%{$search}%")
                ->orWhere('news.description', 'LIKE', "%{$search}%")
                ->orWhere('news.address', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = News::join('users', 'news.created_by_id', '=', 'users.id')
                ->select('news.*', 'users.name')
                ->where('users.name', 'LIKE', "%{$search}%")
                ->orWhere('news.description', 'LIKE', "%{$search}%")
                ->orWhere('news.address', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->count();
        }
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $delete = route('admin_delete_news', $post->id);
                $edit = route('admin_edit_news', $post->id);
                $nestedData['checkbox'] = "<input type='checkbox' class='delete_check' id='delcheck_".$post->id."' onclick='checkcheckbox();' value='".$post->id."'>";
                $nestedData['description'] = $post->description;
                $nestedData['address'] = $post->address;
                if ($post->status_id ==1) {
                    $nestedData['status'] = '<div class="badge badge-success">Active</div>';
                } else {
                    $nestedData['status'] = '<div class="badge badge-danger">Deactive</div>';
                }

                $nestedData['name'] = $post->name;
                $nestedData['created_at'] = date('d-m-Y', strtotime($post->created_at));
                $nestedData['action'] = "&emsp;
                   <a class='mr-1 delcomp'  href='{$delete}'> <i class='feather icon-trash  text-danger'></i><a>
                   <a  style='display:contents;' class='mr-1 delcomp'   href='{$edit}'><i class='m-1 feather icon-edit-2 text-primary' ></i><a>
                   ";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        echo json_encode($json_data);

    }
    public function add_Volunteer_Opportunity_Officers(Request $request)
    {
        
        $organizations = Organization::all();
        $volunteer_field = VolunteeringField::pluck('field_en', 'id');
        $countries = DB::table('lkp_country')->get();
        $types = DB::table('lkp_opportunity_types')->get();
        $officer = User::where('role_id',4)->pluck('name','id');
        return view('Dashboard.VolunteerOpportunityOfficers.create',compact('organizations','volunteer_field','officer','countries','types'));
    }
    public function create_Volunteer_Opportunity_Officers(Request $request)
    { 
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'contact_number' => 'required',
            'address' => 'required',
            'password' => 'required|confirmed',
           '(password_confirmation)' => 'required',
            'passport_picture' => 'required',
            'person_picture' => 'required',
        ]);
        
        try {
            
           
            $pfilename = "";

            if ($request->hasFile('person_picture')) {
                $image = $request->file('person_picture');
                //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
                $path = public_path() . '/upload/personal/';
                $pfilename = time() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $pfilename);
                $request->person_picture = $pfilename;
            }
            $pasfilename = "";
            if ($request->hasFile('passport_picture')) {
                $image = $request->file('passport_picture');
                //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
                $path = public_path() . '/upload/passport/';
                $pasfilename = time() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $pasfilename);
                $request->passport_picture = $pasfilename;
            }
            $inputs = $request->all();
            $inputs["person_picture"] = $pfilename;
            $inputs["passport_picture"] = $pasfilename;
            $password = Hash::make($inputs['password']);
            $inputs["password"] = $password;
            User::create($inputs);
            return redirect()->route('admin_Volunteer_Opportunity_Officers');
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }

    }
    public function edit_Volunteer_Opportunity_Officers($id)
    {

        $Volunteer_Supervisor = User::find($id);
        $organization =Organization::all();
        return view('Dashboard.VolunteerOpportunityOfficers.edit', compact('Volunteer_Supervisor','organization'));
    }
    public function volunteer_field()
    {
        // $data = VolunteerField::all();
        // $data =  $Select_db= User::where(['users.role_id'=>User::TYPE_VOLUNTEER,'organization_id'=>Auth::user()->organization_id])
        //     ->leftJoin('organizations','users.organization_id','=','organizations.id')
        //     ->leftJoin('lkp_active_status','users.activeStatus_id','=','lkp_active_status.id')
        //     ->leftJoin('volunteer_opportunities','users.id','=','volunteer_opportunities.user_id')
        //     ->select('users.id as id','name','users.email','contact_number','organization_id',
        //         'activeStatus_id','name_en','name_ar','lkp_active_status.status'
        //     // DB::raw('count(volunteer_opportunities.user_id) AS total_opportunities')
        //     )
        // ->groupBy('users.id','name','users.email','contact_number','organization_id',
        //     'activeStatus_id','name_en','name_ar','lkp_active_status.status');
        return view('Dashboard.VolunteerField.index');
    }
    public function manage_Volunteer_Opportunity()
    {
        return view('Dashboard.VolunteerOpportunities.index');
    }

    public function organization()
    {
        return view('Dashboard.Organization.index');
    }
    public function reports()
    {
        $totalVolunteers = User::where(['role_id' => User::TYPE_VOLUNTEER, 'organization_id' => Auth::user()->organization_id])->count();
        $totalVolunteerOpportunities = Opportunity::where('organization_id', Auth::user()->organization_id)->count();

        $organizations = Organization::all();
        foreach ($organizations as $organization) {
            $organization->total_opportunities = Opportunity::where('organization_id', $organization->id)->count();
            $organization->total_Volunteers = User::where(['organization_id' => $organization->id, 'role_id' => User::TYPE_VOLUNTEER])->count();
        }

        return view('Dashboard.VolunteerReports.index', compact('totalVolunteers', 'totalVolunteerOpportunities', 'organizations'));
    }
    public function volunteer()
    {
        return view('Dashboard.Volunteers.index');
    }

    public function news()
    {
        return view('Dashboard.News.index');
    }
    public function edit_news(Request $request, $id)
    {

        $news = News::select('news.id as id', 'description', 'news.address', 'image', 'content', 'status_id', 'updated_by_id', 'lkp_page_status.status', 'users.name', 'news.created_at')
            ->leftJoin('lkp_page_status', 'news.status_id', '=', 'lkp_page_status.id')
            ->leftJoin('users', 'news.updated_by_id', '=', 'users.id')
            ->where('news.id', $id)->first();
        $organizations = Organization::all();
        return view('Dashboard.News.edit', compact('news','organizations'));
    }
    public function update_news(Request $request, $id)
    {
        $filename = "";

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/news/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $request->image = $filename;

            $inputs = $request->except(['_token']);
            $inputs["image"] = $filename;
            $user = Auth::user()->id;
            $inputs["updated_by_id"] = $user;
            // dd($inputs);
            News::where('id', $id)->update($inputs);
        } else {
            $inputs = $request->except(['_token']);
            $user = Auth::user()->id;
            $inputs["updated_by_id"] = $user;
            // dd($inputs);
            News::where('id', $id)->update($inputs);
        }
        return redirect()->route('admin_news');
    }
    public function add_news()
    {
        return view('Dashboard.News.create');
    }
    public function create_news(Request $request)
    {
        $filename = "";

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/news/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $request->image = $filename;
        }
        $inputs = $request->all();

        $inputs["image"] = $filename;
        $user = Auth::user()->id;
        $inputs["created_by_id"] = $user;
        $inputs["updated_by_id"] = $user;
        // dd($inputs);
        News::create($inputs);
        return redirect()->route('admin_news');
    }
    public function account()
    {
        $user = User::where(['users.role_id' => Auth::user()->role_id, 'users.id' => Auth::user()->id])
            ->leftJoin('lkp_active_status', 'users.activeStatus_id', '=', 'lkp_active_status.id')
            ->leftJoin('organizations', 'users.organization_id', '=', 'organizations.id')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.id as id', 'users.name', 'users.email','users.password', 'contact_number', 'role_id', 'organization_id', 'activeStatus_id', 'lkp_active_status.status', 'organizations.name_en', 'organizations.name_ar', 'role', 'users.city', 'users.address', 'person_picture', 'passport_picture','age','qualification','sex','id_picture','cv','identification_no')
            ->first();
        $organizations = Organization::all();
        $volunteringfiled = VolunteeringField::all();
        return View('Dashboard.Users.userProfile', compact('user', 'organizations','volunteringfiled'));
    }
    public function update_account(Request $request, $id)
    {
        
        $request->validate([
            'cv' => 'mimes:pdf',
    
        ]);
        $pfilename = "";
        $pasfilename = "";
     
        if ($request->hasFile('person_picture') && $request->hasFile('passport_picture')) {
            $image = $request->file('person_picture');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/personal/';
            $pfilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $pfilename);
            $request->person_picture = $pfilename;
            // dd($logofilename);

            $image = $request->file('passport_picture');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/passport/';
            $pasfilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $pasfilename);
            $request->passport_picture = $pasfilename;
            // dd($bannerfilename);
            $inputs = $request->except(['_token']);
            $inputs["passport_picture"] = $pasfilename;
            $inputs["person_picture"] = $pfilename;
            $inputs['password'] = Auth()->user()->password;
            // dd($inputs);
            User::where('id', $id)->update($inputs);
        } if ($request->hasFile('passport_picture')) {
            $image = $request->file('passport_picture');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/passport/';
            $pasfilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $pasfilename);
            $request->passport_picture = $pasfilename;
            // dd($bannerfilename);
            $inputs = $request->except(['_token']);
            $inputs["passport_picture"] = $pasfilename;
            $inputs['password'] = Auth()->user()->password;
            //  dd($inputs);
            User::where('id', $id)->update($inputs);
        } if ($request->hasFile('person_picture')) {
            $image = $request->file('person_picture');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/personal/';
            $pfilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $pfilename);
            $request->person_picture = $pfilename;
            // dd($bannerfilename);
            $inputs = $request->except(['_token']);
            $inputs["person_picture"] = $pfilename;
            $inputs['password'] = Auth()->user()->password;
            //  dd($inputs);
            User::where('id', $id)->update($inputs);
        } 
          if( $request->hasFile('id_picture'))
                {
                    $image = $request->file('id_picture');
                    $path = public_path(). '/upload/id/';
                    $idfilename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move($path, $idfilename);
                    $request->id_picture = $idfilename ;
                    // dd($idfilename);
                    $inputs = $request->except(['_token']);
                    $inputs["id_picture"] = $idfilename;
                    $inputs['password'] = Auth()->user()->password;
                    User::where('id',$id)->update($inputs);
               }
                if( $request->hasFile('cv'))
                {
                    $image = $request->file('cv');
                    $path = public_path(). '/upload/cv/';
                    $cvfilename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move($path, $cvfilename);
                    $request->cv = $cvfilename ;
                    $inputs = $request->except(['_token']);
                    $inputs["cv"] = $cvfilename;
                    
                     User::where('id',$id)->update($inputs);
                } 
                if (!empty($request->password)) {
                    $inputs['password'] =  Hash::make($request->password);        
                }
                if (empty($request->password)) {
                    $inputs['password'] = Auth()->user()->password;
                } 
                
            $inputs = $request->except(['_token']);
            User::where('id', $id)->update($inputs);
        
        return redirect()->route('admin_account');
    }
    public function update_Volunteer_Opportunity_Officers(Request $request, $id)
    {
        $inputs = $request->except(['_token','c_password']);
        if ($request->hasFile('passport_picture')) {
            $image = $request->file('passport_picture');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/passport/');
            $image->move($destinationPath, $name);
            $inputs['passport_picture'] =   $name ;        
        }
        if ($request->hasFile('person_picture')) {
            $image = $request->file('person_picture');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/personal/');
            $image->move($destinationPath, $name);
            $inputs['person_picture'] =   $name ;        
        }
        if (!empty($request->password)) {
            $inputs['password'] =  Hash::make($request->password);        
        }
        if (empty($request->password)) {
            $pass = User::select('password')->where('id',$id)->first();
            $inputs['password'] =    $pass->password;   
        }
      
    
       
        User::where('id',$id)->update($inputs);
        return redirect()->route('admin_Volunteer_Opportunity_Officers');
    }
    public function add_volunteer_field()
    {
        return view('Dashboard.VolunteerField.create');
    }
    public function create_volunteer_field(Request $request)
    {
      
        $validatedData = $request->validate([
            'name' => 'required',
            'url' => 'required',
            'domain' => 'required',
            'image' => 'required',  
        ]);
          $filename = "";
        if( $request->hasFile('image'))
                {
                    $image = $request->file('image');
                    $path = public_path(). '/upload/VolunteerFields/';
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move($path, $filename);
                    
                }

        $field   = new VolunteeringField;
        $field->image =    $filename;
        $field->name =   $request->name;
        $field->domain =      $request->domain;
        $field->url =      $request->url;
        $field->save();
        return redirect()->route('admin_volunteer_field');
    }
    public function edit_volunteer_field(Request $request, $id)
    {
        $volunteer_field = VolunteeringField::find($id);
        return view('Dashboard.VolunteerField.edit', compact('volunteer_field'));
    }
    public function update_volunteer_field(Request $request, $id)
    {
       $filename = "";
        if( $request->hasFile('image'))
                {
                    $image = $request->file('image');
                    $path = public_path(). '/upload/VolunteerFields/';
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move($path, $filename);
                    $request->image = $filename ;
                    $inputs = $request->except(['_token']);
                    $inputs["image"] = $filename;
                    VolunteeringField::where('id', $id)->update($inputs);
                }
                else
                {
                    $inputs = $request->except(['_token']);
                    VolunteeringField::where('id', $id)->update($inputs);
                }
        return redirect()->route('admin_volunteer_field');
    }
    public function edit_Volunteer_Opportunity($id)
    {
        try {
            $data = Opportunity::find($id);
            $oportunity_type = DB::table('lkp_opportunity_types')->get();
            $organizations = Organization::all();
            $volunteer_field = VolunteeringField::pluck('field_en', 'id');
            $officers = User::where('role_id', 4)->get();
            $types = DB::table('lkp_opportunity_types')->get();
            $countries = DB::table('lkp_country')->get();
            $ageTypes =  DB::table('lkp_age_types')->get();
            return view('Dashboard.VolunteerOpportunities.edit', compact('organizations', 'volunteer_field', 'officers', 'data', 'oportunity_type','types','countries','ageTypes'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

    public function update_Volunteer_Opportunity(Request $request, $id)
    {
        $opfilename = "";
        $repofilename = "";
        if ($request->hasFile('opportunity_image') && $request->hasFile('report_image')) {
            $image = $request->file('opportunity_image');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/opportunity_image/';
            $opfilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $opfilename);
            $request->opportunity_image = $opfilename;
            // dd($logofilename);

            $image = $request->file('report_image');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/report_image/';
            $repofilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $repofilename);
            $request->report_image = $repofilename;
            // dd($bannerfilename);
            $inputs = $request->except(['_token']);
            $inputs["report_image"] = $repofilename;
            $inputs = $request->except(['_token']);
            $inputs["opportunity_image"] = $opfilename;
            $inputs["report_image"] = $repofilename;
            // dd($inputs);
            Opportunity::where('id', $id)->update($inputs);
        } elseif ($request->hasFile('report_image')) {
            $image = $request->file('report_image');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/report_image/';
            $repofilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $repofilename);
            $request->report_image = $repofilename;
            // dd($bannerfilename);
            $inputs = $request->except(['_token']);
            $inputs["report_image"] = $repofilename;
            //  dd($inputs);
            Opportunity::where('id', $id)->update($inputs);
        } elseif ($request->hasFile('opportunity_image')) {
            $image = $request->file('opportunity_image');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/opportunity_image/';
            $opfilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $opfilename);
            $request->opportunity_image = $opfilename;
            // dd($bannerfilename);
            $inputs = $request->except(['_token']);
            $inputs["opportunity_image"] = $opfilename;
            //  dd($inputs);
            Opportunity::where('id', $id)->update($inputs);
        } else {
            $inputs = $request->except(['_token']);
            Opportunity::where('id', $id)->update($inputs);
        }
        return redirect()->route('admin_manage_Volunteer_Opportunity');
    }
    public function add_organization()
    {
        return view('Dashboard.Organization.create');
    }
    public function create_organization(Request $request)
    {
        $logofilename = "";

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/logo/';
            $logofilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $logofilename);
            $request->logo = $logofilename;
            // dd($logofilename);
        }
        $inputs = $request->all();
        $user = Auth::user()->id;
        $inputs["user_id"] = $user;
        $inputs["logo"] = $logofilename;
        Organization::create($inputs);
        return redirect()->route('admin_organization');
    }
    public function edit_organization(Request $request, $id)
    {
        $organization = Organization::find($id);
        return view('Dashboard.Organization.edit', compact('organization'));
    }
    public function update_organization(Request $request, $id)
    {
        $logofilename = "";
        $bannerfilename = "";
        if ($request->hasFile('logo') && $request->hasFile('banner')) {
            $image = $request->file('logo');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/logo/';
            $logofilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $logofilename);
            $request->logo = $logofilename;
            // dd($logofilename);

            $image = $request->file('banner');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/banner/';
            $bannerfilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $bannerfilename);
            $request->report_image = $bannerfilename;
            // dd($bannerfilename);
            $inputs = $request->except(['_token']);
            $inputs["banner"] = $bannerfilename;
            $inputs = $request->except(['_token']);
            $inputs["logo"] = $logofilename;
            $inputs["banner"] = $bannerfilename;
            // dd($inputs);
            Organization::where('id', $id)->update($inputs);
        } elseif ($request->hasFile('logo')) {
            $image = $request->file('logo');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/logo/';
            $logofilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $logofilename);
            $request->logo = $logofilename;
            // dd($bannerfilename);
            $inputs = $request->except(['_token']);
            $inputs["logo"] = $logofilename;
            //  dd($inputs);
            Organization::where('id', $id)->update($inputs);
        } elseif ($request->hasFile('banner')) {
            $image = $request->file('banner');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/banner/';
            $bannerfilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $bannerfilename);
            $request->banner = $bannerfilename;
            // dd($bannerfilename);
            $inputs = $request->except(['_token']);
            $inputs["banner"] = $bannerfilename;
            //  dd($inputs);
            Organization::where('id', $id)->update($inputs);
        } else {
            $inputs = $request->except(['_token']);
            Organization::where('id', $id)->update($inputs);
        }

        return redirect()->route('admin_organization');
    }
    public function showVoulenteers($id)
    {
        $volunteers = User::where(['users.role_id' => User::TYPE_VOLUNTEER, 'organization_id' => $id])
            ->orderBy('id', 'DESC')->get();
        return view('Dashboard.VolunteerReports.report_volunteers', compact('volunteers'));
    }
    public function edit_volunteer($id)
    {
        $volunteer = User::find($id);
        return view('Dashboard.Volunteers.edit', compact('volunteer'));
    }
    public function update_volunteer(Request $request, $id)
    {
        $inputs = $request->except(['_token']);
        // dd($inputs);
        User::where('id', $id)->update($inputs);
        return redirect()->route('admin_volunteer');
    }

    public function create_Volunteer_Opportunity(Request $request)
    {
        $opfilename = "";

        if( $request->hasFile('opportunity_image'))
                {
                    $image = $request->file('opportunity_image');
                  //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
                    $path = public_path(). '/upload/opportunity_image/';
                    $opfilename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move($path, $opfilename);
                    $request->opportunity_image = $opfilename ;
                    // dd($logofilename);
                }

        $repofilename = "";
        if( $request->hasFile('report_image'))
                {
                    $image = $request->file('report_image');
                  //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
                    $path = public_path(). '/upload/report_image/';
                    $repofilename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move($path, $repofilename);
                    $request->report_image = $repofilename ;
                    // dd($bannerfilename);
                }
        $inputs = $request->all();
        $inputs["opportunity_image"] = $opfilename;
        $inputs["report_image"] = $repofilename;
        // dd($inputs);
        Opportunity::create($inputs);
        return redirect()->route('admin_manage_Volunteer_Opportunity');
    }
    public function volunteerSupervisor(){
       
        return view('Dashboard.VolunteerSupervisors.index');
    }

    public function getSupervisor(Request $request){
        $columns = array(
            0 => 'name',
            1 => 'email',
            2 => 'contact_number',
            3 => 'created_at',
        );
        $totalData = User::where('role_id',3)->count();
        $totalFiltered = $totalData;
        if ($request->input('length') == -1) {
            $limit =  $totalData;
        }else{
            $limit = $request->input('length');
        }
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            $posts = User::where('role_id',3)
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        } else {
            $search = $request->input('search.value');
            $posts = User::where('role_id',3)
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('contact_number', 'LIKE', "%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
            $totalFiltered = User::where('role_id',3)
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('contact_number', 'LIKE', "%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->count();
        }
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                 $delete = route('admin_delete_Volunteer_Supervisor', $post->id);
                 $edit =  route('admin_edit_Volunteer_Supervisor',$post->id);
                   $nestedData['checkbox'] = "<input type='checkbox' class='delete_check' id='delcheck_".$post->id."' onclick='checkcheckbox();' value='".$post->id."'>";
                $nestedData['name'] = $post->name;
                $nestedData['email'] = $post->email;
                $nestedData['contact_number'] = $post->contact_number;
                  if($post->login_status ==1){
                             $nestedData['role'] ='<div class="badge badge-success">Active</div>';
                  }else{
                       $nestedData['role'] ='<div class="badge badge-danger">Deactive</div>';
                  }
         
                $nestedData['created_at'] = date('d-m-Y', strtotime($post->created_at));
                if($post->login_status ==1){
                     $nestedData['action'] = "&emsp;
                <a class='mr-1 delcomp'  href='{$delete}'> <i class='fa fa-trash-o text-danger' aria-hidden='true' ></i></a>
                <a  style='display:contents;' class='mr-1 delcomp'   href='{$edit}'><i class='fa fa-pencil text-info' aria-hidden='true'></i></a>
                 <a  style='display:contents;' class='mr-1 deactivate'  data-id='{$post->id}'  ><i  class='m-1 feather icon-slash text-danger' ></i></a>
                ";
                }else{
                          $nestedData['action'] = "&emsp;
                <a class='mr-1 delcomp'  href='{$delete}'> <i class='fa fa-trash-o text-danger' aria-hidden='true'></i></a>
                <a  style='display:contents;' class='mr-1 delcomp'   href='{$edit}'><i class='fa fa-pencil text-info' aria-hidden='true'></i></a>
                <a  style='display:contents;' class='mr-1 active'  data-id='{$post->id}'  ><i  class='m-1 feather icon-check text-succcess' ></i></a>
              
                "; 
                }
               
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        echo json_encode($json_data);

    }
    public function add(Request $request)
    {
        $organizations = Organization::all();
        return view ('Dashboard.VolunteerSupervisors.create',compact('organizations'));
    }

    public function updatevolunteersup(Request $request, $id)
    {
               $inputs = $request->except(['_token','c_password']);
                if ($request->hasFile('passport_picture')) {
                    $image = $request->file('passport_picture');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/upload/passport/');
                    $image->move($destinationPath, $name);
                    $inputs['passport_picture'] =   $name ;        
                }
                if ($request->hasFile('person_picture')) {
                    $image = $request->file('person_picture');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/upload/personal/');
                    $image->move($destinationPath, $name);
                    $inputs['person_picture'] =   $name ;        
                }
                if (!empty($request->password)) {
                    $inputs['password'] =  Hash::make($request->password);        
                }
                if (empty($request->password)) {
                    $pass = User::select('password')->where('id',$id)->first();
                    $inputs['password'] =    $pass->password;   
                }
              
            
               
                User::where('id',$id)->update($inputs);
                return redirect()->route('admin_Volunteer_Supervisor');
    }
    public function delete_news($id)
    {
        News::find($id)->delete();
        return redirect()->route('admin_news')->with('message', 'News Deleted Successfully!');
    }
    public function delete_Volunteer_Opportunity_Officers($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin_Volunteer_Opportunity_Officers');
    }
    public function delete_volunteer($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin_volunteer');
    }
    public function delete($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin_Volunteer_Supervisor');
    }
    public function delete_volunteer_field($id)
    {
        VolunteeringField::find($id)->delete();
        return redirect()->route('admin_volunteer_field');
    }
    public function delete_Volunteer_Opportunity($id)
    {
        Opportunity::find($id)->delete();
        return redirect()->route('admin_manage_Volunteer_Opportunity');
    }
    public function delete_organization($id)
    {
        Organization::find($id)->delete();
        return redirect()->route('admin_organization');
    }
    
       public function deletesupervisorvolunteer(Request $request){
        try {
            $deleteids_arr = array();

            if($request->deleteids_arr){
               $deleteids_arr =$request->deleteids_arr;
            }
            foreach($deleteids_arr as $deleteid){
                User::where('id',$deleteid)->delete();
            }

            return response()->json([
                'success' =>true,
                'message' => 'Data Deleted'
            ]);
         
        } catch (\Throwable $th) {
            return response()->json([
                'success' =>false,
                'message' => $th->getMessage()
            ]);
        }
    }
    public function deletevoo(Request $request){
        try {
            $deleteids_arr = array();

            if($request->deleteids_arr){
               $deleteids_arr =$request->deleteids_arr;
            }
            foreach($deleteids_arr as $deleteid){
                User::where('id',$deleteid)->delete();
            }

            return response()->json([
                'success' =>true,
                'message' => 'Data Deleted'
            ]);
         
        } catch (\Throwable $th) {
            return response()->json([
                'success' =>false,
                'message' => $th->getMessage()
            ]);
        }
    }
    public function deletevolunterfield(Request $request){
        try {
            $deleteids_arr = array();

            if($request->deleteids_arr){
               $deleteids_arr =$request->deleteids_arr;
            }
            foreach($deleteids_arr as $deleteid){
                VolunteeringField::where('id',$deleteid)->delete();
            }

            return response()->json([
                'success' =>true,
                'message' => 'Data Deleted'
            ]);
         
        } catch (\Throwable $th) {
            return response()->json([
                'success' =>false,
                'message' => $th->getMessage()
            ]);
        }
    }
    public function deleteorganization(Request $request){
        try {
            $deleteids_arr = array();

            if($request->deleteids_arr){
               $deleteids_arr =$request->deleteids_arr;
            }
            foreach($deleteids_arr as $deleteid){
                Organization::where('id',$deleteid)->delete();
            }

            return response()->json([
                'success' =>true,
                'message' => 'Data Deleted'
            ]);
         
        } catch (\Throwable $th) {
            return response()->json([
                'success' =>false,
                'message' => $th->getMessage()
            ]);
        }
    }
     public function deletevo(Request $request){
        try {
            $deleteids_arr = array();

            if($request->deleteids_arr){
               $deleteids_arr =$request->deleteids_arr;
            }
            foreach($deleteids_arr as $deleteid){
                User::where('id',$deleteid)->delete();
            }

            return response()->json([
                'success' =>true,
                'message' => 'Data Deleted'
            ]);
         
        } catch (\Throwable $th) {
            return response()->json([
                'success' =>false,
                'message' => $th->getMessage()
            ]);
        }
    }
    
    public function deletevolunteeer(Request $reques){
         try {
            $deleteids_arr = array();

            if($request->deleteids_arr){
               $deleteids_arr =$request->deleteids_arr;
            }
            foreach($deleteids_arr as $deleteid){
                User::where('id',$deleteid)->delete();
            }

            return response()->json([
                'success' =>true,
                'message' => 'Data Deleted'
            ]);
         
        } catch (\Throwable $th) {
            return response()->json([
                'success' =>false,
                'message' => $th->getMessage()
            ]);
        }
    }
    
    public function deletenews(Request $reques){
         try {
            $deleteids_arr = array();

            if($request->deleteids_arr){
               $deleteids_arr =$request->deleteids_arr;
            }
            foreach($deleteids_arr as $deleteid){
                News::where('id',$deleteid)->delete();
            }

            return response()->json([
                'success' =>true,
                'message' => 'Data Deleted'
            ]);
         
        } catch (\Throwable $th) {
            return response()->json([
                'success' =>false,
                'message' => $th->getMessage()
            ]);
        }
    }
    
    public function deactivatevolunteersupervisor(Request $request){
          try {
           
           User::where('id',$request->id)->update([
               
               'login_status' => 0
               
               ]);

            return response()->json([
                'success' =>true,
                'message' => 'User Deactivated'
            ]);
         
        } catch (\Throwable $th) {
            return response()->json([
                'success' =>false,
                'message' => $th->getMessage()
            ]);
        }
        
        
    }
    
    public function activatevolunteersupervisor(Request $request){
          try {
           
           User::where('id',$request->id)->update([
               
               'login_status' => 1
               
               ]);

            return response()->json([
                'success' =>true,
                'message' => 'User Deactivated'
            ]);
         
        } catch (\Throwable $th) {
            return response()->json([
                'success' =>false,
                'message' => $th->getMessage()
            ]);
        }
        
        
    }
    public function add_manage_Volunteer_Opportunity()
    {
        $organizations = Organization::all();
        $volunteer_field = VolunteeringField::all();
        $countries = DB::table('lkp_country')->get();
        $types = DB::table('lkp_opportunity_types')->get();
        $officers = User::where('role_id',4)->get();
        $ageTypes  = DB::table('lkp_age_types')->get();
        return view('Dashboard.VolunteerOpportunities.create',compact('organizations','volunteer_field','countries','types','officers','ageTypes'));
    }

    public function callUs(){
        $contactus = DB::table('call_us')->get();
        return view('Dashboard.callus.call_us',compact('contactus'));
    }




}

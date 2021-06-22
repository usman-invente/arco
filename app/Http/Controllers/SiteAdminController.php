<?php

namespace App\Http\Controllers;

use App\AnimatedSlide;
use App\ContactUs;
use App\Footer;
use App\Logo;
use App\News;
use App\Counter;
use App\Organization;
use App\Page;
use App\VolunteeringField;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use Str;

class SiteAdminController extends Controller
{
    public function __construct()
    {

        $this->middleware('SiteAdmin');

    }
    public function page()
    {
        return view('Dashboard.Pages.index');
    }
    public function get_page_data(Request $request)
    {
        $columns = array(
            0 => 'title_en',
            1 => 'title_ar',
            2 => 'name',
            4 => 'status',
            5 => 'updated_at',
        );
        $totalData = Page::join('users', 'pages.updated_by_id', '=', 'users.id')
            ->select('pages.*', 'users.name')
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
            $posts = Page::join('users', 'pages.updated_by_id', '=', 'users.id')
                ->select('pages.*', 'users.name')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $posts = Page::join('users', 'pages.updated_by_id', '=', 'users.id')
                ->select('pages.*', 'users.name')
                ->where('title_en', 'LIKE', "%{$search}%")
                ->orWhere('title_ar', 'LIKE', "%{$search}%")
                ->orWhere('users.name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Page::join('users', 'pages.updated_by_id', '=', 'users.id')
                ->select('pages.*', 'users.name')
                ->offset($start)
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('title_ar', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('contact_number', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->count();
        }
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $edit = route('edit_page', $post->id);
                $delete = route('delete_page', $post->id);
                $nestedData['checkbox'] =  "<input type='checkbox' class='delete_check' id='delcheck_".$post->id."' onclick='checkcheckbox();' value='".$post->id."'>";
                $nestedData['title_en'] = $post->title_en;
                $nestedData['title_ar'] = $post->title_ar;
                if ($post->status_id == 1) {
                    $nestedData['status'] = '<div class="badge badge-success">Published</div>';
                } else {
                    $nestedData['status'] = '<div class="badge badge-success">Non Published</div>';
                }

                $nestedData['name'] = $post->name;
                $nestedData['updated_at'] = date('d-m-Y', strtotime($post->updated_at));
                /* $nestedData['industry'] = $post->industry;*/
                // $nestedData['created_at'] = date('d-m-Y', strtotime($post->created_at));
                $nestedData['action'] = "&emsp;
                <a class='mr-1 delcomp'  href='{$delete}'> <i class='fa fa-trash-o text-danger'></i><a>
                <a class='mr-1 delcomp'  href='{$edit}'> <i class='fa fa-pencil text-primary'></i><a>
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
    public function add_page()
    {
        
        return view('Dashboard.Pages.create');
    }
    public function create_page(Request $request)
    {
      if($request->action == "preview"){
        if ($request->hasFile('page_image')) {
            $image = $request->file('page_image');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/page_image/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $request->page_image = $filename;
        }
        $data = [
            'image' =>      $filename,
            'address' => $request->title_en,
            'description' => $request->content,
        ];

      $request->session()->put('news',  $data);
    return  redirect()->route('preview',$request->address);
      }
      else{
        $filename = "";

        if ($request->hasFile('page_image')) {
            $image = $request->file('page_image');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/page_image/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $request->page_image = $filename;
        }
        $inputs = $request->all();
        $inputs["page_image"] = $filename;
        $user = Auth::user()->id;
        $inputs["updated_by_id"] = $user;
        //  dd($inputs);
        Page::create($inputs);
        return redirect()->route('page')->with('message', 'Page Created Successfully!');
      }
        
    }
    public function edit_page(Request $request, $id)
    {
        $data = Page::find($id);
        return view('Dashboard.Pages.edit', compact('data'));
    }
    public function update_page(Request $request, $id)
    {
       
        $filename = "";

        if ($request->hasFile('page_image')) {
            $image = $request->file('page_image');
            $path = public_path() . '/upload/page_image/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $request->page_image = $filename;

            $inputs = $request->except(['_token']);
            $inputs["page_image"] = $filename;
            $user = Auth::user()->id;
            $inputs["updated_by_id"] = $user;
            // dd($inputs);
            Page::where('id', $id)->update($inputs);
        } else {
            $inputs = $request->except(['_token']);
            $user = Auth::user()->id;
            $inputs["updated_by_id"] = $user;
            // dd($inputs);
            Page::where('id', $id)->update($inputs);
        }
        return redirect()->route('page')->with('message', 'Page Updated Successfully!');
    }
    public function delete_page($id)
    {
        Page::find($id)->delete();
        return redirect()->route('page')->with('message', 'Page Deleted Successfully!');
    }

    public function news()
    {
        return view('Site-Admin.News.index');
    }
    public function get_news_data(Request $request)
    {
        $columns = array(
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
                $nestedData['checkbox'] =  "<input type='checkbox' class='delete_check' id='delcheck_".$post->id."' onclick='checkcheckbox();' value='".$post->id."'>";
                $nestedData['address'] =Str::limit($post->address,30);
                if ($post->status_id ==1) {
                    $nestedData['status'] = '<div class="badge badge-success">Active</div>';
                } else {
                    $nestedData['status'] = '<div class="badge badge-danger">Deactive</div>';
                }
                $nestedData['name'] = $post->name;
                $nestedData['created_at'] = date('d-m-Y', strtotime($post->created_at));
                $nestedData['action'] = "&emsp;
                   <a class='mr-1 delcomp'  href='{$delete}'> <i class='fa fa-trash-o  text-danger'></i><a>
                   <a  style='display:contents;' class='mr-1 delcomp'   href='{$edit}'><i class='fa fa-pencil text-primary' ></i><a>
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
    public function add_news()
    {
        $organizations = Organization::all();
        return view('Site-Admin.News.add',compact('organizations'));
    }
    public function create_news(Request $request)
    {
        if($request->action=="preview"){
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
                $path = public_path() . '/upload/news/';
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $filename);
              
            }
            $data = [
                'image' =>      $filename,
                'address' => $request->address,
                'description' => $request->description,
            ];

          $request->session()->put('news',  $data);
        return  redirect()->route('preview',$request->address);

        }else{
            $validatedData = $request->validate([
                'description' => 'required',
                'address' => 'required',
                'image' => 'required',
            ]);
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
            return redirect()->route('site_news')->with('message', 'news Created Successfully!');
        }
        
    }
    public function edit_news(Request $request, $id)
    {
        $news = News::find($id);
        // dd($organization);
        return view('Site-Admin.News.edit', compact('news'));
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
        return redirect()->route('site_news')->with('message', 'News Updated Successfully!');
    }
    public function delete_news($id)
    {
        News::find($id)->delete();
        return redirect()->route('site_news')->with('message', 'News Deleted Successfully!');
    }

    public function animated_slide()
    {
        return view('Site-Admin.Animated-Slide.index');
    }
    public function get_animated_slide(Request $request)
    {
        $columns = array(
            0 => 'name',
            1 => 'sequence',
            2 => 'created_at',
        );
        $totalData = AnimatedSlide::select('animated_slides.id as id', 'animated_slides.name', 'image', 'status_id', 'created_at', 'lkp_active_status.status', 'sequence')
            ->leftJoin('lkp_active_status', 'animated_slides.status_id', '=', 'lkp_active_status.id')->count();
        
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
            $posts = AnimatedSlide::select('animated_slides.id as id', 'animated_slides.name', 'image', 'status_id', 'created_at', 'lkp_active_status.status', 'sequence')
                ->leftJoin('lkp_active_status', 'animated_slides.status_id', '=', 'lkp_active_status.id')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $posts = AnimatedSlide::select('animated_slides.id as id', 'animated_slides.name', 'image', 'status_id', 'created_at', 'lkp_active_status.status', 'sequence')
                ->leftJoin('lkp_active_status', 'animated_slides.status_id', '=', 'lkp_active_status.id')
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('sequence', 'LIKE', "%{$search}%")
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = AnimatedSlide::select('animated_slides.id as id', 'animated_slides.name', 'image', 'status_id', 'created_at', 'lkp_active_status.status', 'sequence')
                ->leftJoin('lkp_active_status', 'animated_slides.status_id', '=', 'lkp_active_status.id')
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('sequence', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $edit = route('edit_animated_slide', $post->id);
                $delete = route('delete_animated_slide', $post->id);
                $picture = asset('public/upload/Animated-Slide') . '/' . $post->image;
                 $nestedData['checkbox'] =  "<input type='checkbox' class='delete_check' id='delcheck_".$post->id."' onclick='checkcheckbox();' value='".$post->id."'>";
                $nestedData['name'] = $post->name;
                $nestedData['image'] = "<img src='{$picture}' height='80' width='180' style='margin-top: 10px'>";
                $nestedData['sequence'] = $post->sequence;
                if ($post->status_id == 1) {
                    $nestedData['status'] = '<div class="badge badge-success">Active</div>';
                } else {
                    $nestedData['status'] = '<div class="badge badge-danger">Deactive</div>';
                }

                $nestedData['created_at'] = date('d-m-Y', strtotime($post->created_at));
                /* $nestedData['industry'] = $post->industry;*/
                // $nestedData['created_at'] = date('d-m-Y', strtotime($post->created_at));
                $nestedData['action'] = "&emsp;
                <a class='mr-1 delcomp'  href='{$delete}'> <i class='fa fa-trash-o text-danger'></i><a>
                <a class='mr-1 delcomp'  href='{$edit}'> <i class='fa fa-pencil text-primary'></i><a>
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

    public function add_animated_slide()
    {
        return view('Site-Admin.Animated-Slide.add');
    }

    public function create_animated_slide(Request $request)
    {
      
        $filename = "";

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/Animated-Slide/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $request->image = $filename;
        }
        $inputs = $request->all();
        $inputs["image"] = $filename;
        $user = Auth::user()->id;
        $inputs["user_id"] = $user;
        // dd($inputs);
        AnimatedSlide::create($inputs);
        return redirect()->route('animated_slide')->with('message', 'Animated Slide Creaed Successfully!');
    }

    public function edit_animated_slide(Request $request, $id)
    {
        $data = AnimatedSlide::find($id);
        // dd($organization);
        return view('Site-Admin.Animated-Slide.edit', compact('data'));
    }

    public function update_animated_slide(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'sequence' => 'required',
        ]);
        $filename = "";

        if (!empty($request->hasFile('image'))) {
            $image = $request->file('image');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/Animated-Slide/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $request->image = $filename;

            $inputs = $request->except(['_token']);
            $inputs["image"] = $filename;
            // dd($inputs);
            AnimatedSlide::where('id', $id)->update($inputs);
        } else {
            $inputs = $request->except(['_token']);
            // dd($inputs);
            AnimatedSlide::where('id', $id)->update($inputs);
        }
        return redirect()->route('animated_slide')->with('message', 'Animated Slide Updated Successfully!');
    }

    public function delete_animated_slide($id)
    {
        AnimatedSlide::find($id)->delete();
        return redirect()->route('animated_slide')->with('message', 'Animated Slide Deleted Successfully!');
    }
    public function contact_us(Request $request)
    {
        $call = ContactUs::first();
        $organization = Organization::all();
        // dd($call);
        return view('Site-Admin.Contact-us.index', compact('call','organization'));
    }
    public function create_call_us(Request $request)
    {
        $input = $request->except(['_token']);
  
        if(!empty($input['main_address_checkbox'])){
           $input['main_address_checkbox'] =  $input['main_address_checkbox'];
        }
        if(!empty($input['second_address_checkbox'])){
            $input['second_address_checkbox'] = 1;
         }
         if(!empty($input['main_phone_checkbox'])){
            $input['main_phone_checkbox'] = 1;
         }
         if(!empty($input['second_phone_checkbox'])){
            $input['second_phone_checkbox'] = 1;
         }
         if(!empty($input['email_checkbox'])){
            $input['email_checkbox'] = 1;
         }
         if(!empty($input['second_email_checkbox'])){
            $input['second_email_checkbox'] = 1;
         }
         if(!empty($input['location_checkbox'])){
            $input['location_checkbox'] = 1;
         }
         if(!empty($input['time_checkbox'])){
            $input['time_checkbox'] = 1;
         }
       
        ContactUs::where('id',1)->update($input);
        return redirect()->route('contact_us')->with('message', 'Data Creaed Successfully!');
    }
    public function footer()
    {
        $footer = Footer::first();
        return view('Site-Admin.Footer.index', compact('footer'));
    }
    public function create_footer(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'youtube' => 'required',
        ]);
        $footer = "";
        if ($request->hasFile('footer_image')) {
            $image = $request->file('footer_image');
            $path = public_path() . '/upload/footer-image/';
            $footer = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $footer);
            $request->footer_image = $footer;

            Footer::where('id', 1)
                ->update([
                    'description' => $request->description,
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'footer_image' => $footer,
                ]);
        } else {
            $footer = Footer::select('footer_image')->where('id',1)->first();
            Footer::where('id', 1)
                ->update([
                    'description' => $request->description,
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'footer_image' => $footer->footer_image
                ]);
        }
        return redirect()->route('footer')->with('message', 'Data Creaed Successfully!');
    }

    public function sit_account()
    {
         $user = User::where(['users.role_id' => Auth::user()->role_id, 'users.id' => Auth::user()->id])
        ->leftJoin('lkp_active_status', 'users.activeStatus_id', '=', 'lkp_active_status.id')
        ->leftJoin('organizations', 'users.organization_id', '=', 'organizations.id')
        ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
        ->select('users.id as id', 'name', 'users.email', 'contact_number', 'role_id', 'organization_id', 'activeStatus_id', 'lkp_active_status.status', 'organizations.name_en', 'organizations.name_ar', 'role', 'users.city', 'users.address', 'person_picture', 'passport_picture')
        ->first();
        return view('Site-Admin.Accounts.index', compact('user'));
    }
    public function site_update_account(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
            'address' => 'required',
            'city' => 'required',
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
            // dd($inputs);
            User::where('id', $id)->update($inputs);
        } elseif ($request->hasFile('passport_picture')) {
            $image = $request->file('passport_picture');
            $path = public_path() . '/upload/passport/';
            $pasfilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $pasfilename);
            $request->passport_picture = $pasfilename;
            $inputs = $request->except(['_token']);
            $inputs["passport_picture"] = $pasfilename;
            User::where('id', $id)->update($inputs);
        } elseif ($request->hasFile('person_picture')) {
            $image = $request->file('person_picture');
            //  $path = '/home/traximpanel/public_html/home_capital_direct/public/upload';
            $path = public_path() . '/upload/personal/';
            $pfilename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $pfilename);
            $request->person_picture = $pfilename;
            // dd($bannerfilename);
            $inputs = $request->except(['_token']);
            $inputs["person_picture"] = $pfilename;
            //  dd($inputs);
            User::where('id', $id)->update($inputs);
        } else {
            $inputs = $request->except(['_token']);
            User::where('id', $id)->update($inputs);
        }
        return redirect()->route('sit_account')->with('message', 'Account  Updated  Successfully!');
    }
    public function logo()
    {
        $flogo = Logo::select('logo')->where('position','head')->first();
        $slogo = Logo::select('logo')->where('position','footer')->first();
        return view('Site-Admin.logo.index', compact('flogo','slogo'));
    }
    public function create_logo(Request $request)
    {

        $header = "";
        $footer = "";
        if ($request->hasFile('web_footer_logo') && $request->hasFile('web_header_logo')) {
            $image = $request->file('web_footer_logo');
            $path = public_path() . '/upload/web-logo/';
            $footer = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $footer);

            $image = $request->file('web_header_logo');
            $path = public_path() . '/upload/web-logo/';
            $header = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $header);

            Logo::where('position','head')
            ->update([
                 'logo' => $header
            ]);
            Logo::where('position','footer')
            ->update([
                 'logo' => $footer
            ]);
            
        } elseif ($request->hasFile('web_header_logo')) {
            $image = $request->file('web_header_logo');
            $path = public_path() . '/upload/web-logo/';
            $header = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $header);


            Logo::where('position','head')
            ->update([
                 'logo' => $header
            ]);
            
        } elseif ($request->hasFile('web_footer_logo')) {
            $image = $request->file('web_footer_logo');
            $path = public_path() . '/upload/web-logo/';
            $footer = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $footer);

             Logo::where('position','footer')
            ->update([
                 'logo' => $footer
            ]);
        } else {
            return redirect()->route('logo')->with('message', 'Logo Updates Successfully!');
        }
        return redirect()->route('logo')->with('message', 'Logo Updated Successfully!');
    }
    public function user_registration()
    {
        $country = DB::table('lkp_country')->get();
        $volunteer_field = VolunteeringField::all();
        $organization = Organization::all();
        return view('Site-Admin.User-Registration.index',compact('country','volunteer_field','organization'));
    }
    public function create_user_registration(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'contact_number' => 'required',
            'address' => 'required',
            'city' => 'required',
            'nationality_id' => 'required',
            'qualification' => 'required',
            'volunteer_field_id' => 'required',
            'password' => 'required',
            'role_id' => 'required',
        ]);
        $password = Hash::make($request['password']);
        $inputs = $request->all();
        $inputs['password'] = $password;
        User::create($inputs);
        return redirect()->back()->with('message', 'User Created Successfully!');
    }
    public function counter()
    {
        $counter = Counter::first();
        return view ('Site-Admin.Counter.index',compact('counter'));
    }
    public function create_counter(Request $request)
    {
       
       
        Counter::updateOrCreate(
            ['id' =>  1],
            [
            'data_selection' =>  $request->get('data_selection'),
            'no_of_volunteer' => $request->get('no_of_volunteer'),
            'no_of_volunteer_opportunities' => $request->get('no_of_volunteer_opportunities'),
            'no_of_volunteer_hours' => $request->get('no_of_volunteer_hours'),
            'no_of_organizations' => $request->get('no_of_organizations'),
        ],
        );
    
        return redirect()->route('counter')->with('message', 'Counter Data Updated Successfully!');
    }
    
    public function deleteslide(Request $request){
        try {
            $deleteids_arr = array();

            if($request->deleteids_arr){
               $deleteids_arr =$request->deleteids_arr;
            }
            foreach($deleteids_arr as $deleteid){
                AnimatedSlide::where('id',$deleteid)->delete();
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
     public function deletepages(Request $request){
        try {
            $deleteids_arr = array();

            if($request->deleteids_arr){
               $deleteids_arr =$request->deleteids_arr;
            }
            foreach($deleteids_arr as $deleteid){
                Page::where('id',$deleteid)->delete();
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
      public function deletenews(Request $request){
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

  
    
}

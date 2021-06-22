<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use App\UserPermission;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        Gate::authorize('allowedUsers',collect('roles_access'));
        $roles= Role::all();

        foreach ($roles as $role)
        {
            $permissions=UserPermission::where('user_permissions.role_id',$role->id)->leftJoin('permissions', 'user_permissions.permission_id','=','permissions.id')->select('permission')->get();
            $permissions=$permissions->toArray();
            $role->permissions=$permissions;
        }

//        foreach ($roles as $roless)
//        {
//            print_r($roless->role);
//            echo "<br>";
//            foreach ($roless->permissions as $role){
//                print_r($role['permission']);
//                echo "<br>";
//
//            }
//
//        }

        return view('Dashboard.Roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
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
        $role=Role::where('id',$id)->first();

//            $permissions=Permission::select('permission')
//                ->whereExists( function ($query) use ($role) {
//                $query->select(DB::raw(1))
//                    ->from('user_permissions')
//                    ->where('user_permissions.role_id', '=', $role->id);
//            })
//            ->get();
//            $permissions=$permissions->toArray();
//            $role->permissions=$permissions;
//
//            print_r($role->toArray());
//            die;

        return view('Dashboard.Roles.edit',compact('role'));
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
        $user= Role::where('id',$id)->first();
        $this->validate($request,[
            'role' => ['required', 'string', 'max:255']
        ]);

        Role::where('id',$id)->update(['role' => $request->input('role')]);
        return redirect('dashboard/roles')->with('success', 'Done Role Name is successfully updated!!');
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
}

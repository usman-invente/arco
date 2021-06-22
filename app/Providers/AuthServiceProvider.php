<?php

namespace App\Providers;

use App\Permission;
use App\Role;
use App\User;
use App\UserPermission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('isAllowed',function ($user){
            $role=Role::where('id',$user->role_id)->first();
            if ($role->id == User::TYPE_VOLUNTEER)
            {
                return false;
            }
            return true;
        });

        Gate::define('siteAdmin',function ($user){
            $role=Role::where('id',$user->role_id)->first();
            if ($role->id == User::TYPE_SITE_ADMIN || $role->id ==User::TYPE_SUPER_ADMIN)
            {
                return true;
            }
            return false;
        });


        Gate::define('allowedUsers',function ($user,$ability=NULL){


            $role=Role::where('id',$user->role_id)->first();
            if(!empty($role))
            {
                if ( $role->id ==User::TYPE_VOLUNTEER)
                {
                    return false;
                }
                if ($role->id == User::TYPE_SUPER_ADMIN)
                {
                    return true;
                }
                if ($ability[0]=='isAllowed')
                {
                    return true;
                }

                $permission=Permission::where('permission',$ability[0])->first();

                if (!empty($permission))
                {
                    $user_permission=UserPermission::where(['role_id'=>$role->id,'permission_id'=>$permission->id])->first();
                    if (!empty($user_permission))
                        return true;
                }
                return false;
            }
            return false;
        });
    }
}

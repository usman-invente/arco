<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const TYPE_SUPER_ADMIN = '1';
    const TYPE_ADMIN = '2';
    const TYPE_VOLUNTEER_SUPERVISOR = '3';
    const TYPE_VOLUNTEER_OPPORTUNITY_OFFICER = '4';
    const TYPE_VOLUNTEER = '5';
    const TYPE_SITE_ADMIN = '6';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','nationality_id','contact_number','qualification','address','city','volunteer_field_id','role_id','gender_id','organization_id','activeStatus_id','person_picture','id_picture','passport_picture','cv', 'password','age','sex','identification_no','login_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table="organizations";
    protected $fillable=['id','user_id', 'name_en','name_ar', 'email', 'contact', 'banner', 'logo','site_url' ,'details', 'created_at', 'updated'];
    public $timestamps=false;
}

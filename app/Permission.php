<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table="permissions";
    protected $fillable=['id','permission','created_at', 'updated'];
    public $timestamps=false;
}

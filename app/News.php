<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $table='news';
    protected $fillable=[  'id', 'description', 'address', 'image', 'content', 'status_id', 'organization_id', 'created_by_id', 'updated_by_id', 'created_at', 'updated_at'];
    public $timestamps=false;

}

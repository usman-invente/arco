<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table='pages';
    protected $fillable=[ 'id ', 'title_en','title_ar','page_image' ,'heading','content','status_id' ,'is_menu_bar', 'updated_by_id',  'created_at',  'updated_at'];
    public $timestamps=false;
}

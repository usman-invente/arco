<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimatedSlide extends Model
{
    protected $table='animated_slides';
    protected $fillable=['id', 'name','data_selection','no_of_days','sequence', 'image', 'status_id','slide_text','sub_text','topic','created_at', 'updated_at'];
    public $timestamps=false;

}

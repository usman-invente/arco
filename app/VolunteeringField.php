<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VolunteeringField extends Model
{
    protected $table="volunteering_fields";
    protected $fillable=['id', 'field_en', 'field_ar','image','url'];
    public $timestamps=false;
}

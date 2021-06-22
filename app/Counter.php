<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{

    protected $table="counters";
    protected $fillable=['id','data_selection','no_of_volunteer', 'no_of_volunteer_opportunities', 'no_of_volunteer_hours','no_of_organizations'];
    public $timestamps=false;


}

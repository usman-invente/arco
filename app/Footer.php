<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $table="footers";
    protected $fillable=['id','footer_image', 'description', 'facebook', 'twitter', 'instagram', 'youtube'];
    public $timestamps=false;
}

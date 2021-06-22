<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table="contact_us";
    protected $fillable=['id', 'main_address', 'second_address', 'main_phone', 'second_phone', 'email', 'second_email', 'location','time'];
    public $timestamps=false;
}

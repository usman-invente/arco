<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table="messages";
    protected $fillable=['id', 'user_id', 'name', 'email', 'phone', 'subject', 'message', 'created_at', 'updated_at'];
    public $timestamps=false;
}

<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebsiteBaseController;
use Illuminate\Http\Request;

class LoginController extends WebsiteBaseController
{
    public function login()
    {
        return view('Website.Auth.login');
    }

    public function get_signUp_form()
    {
        return view('Website.Auth.signup');
    }

    public function signUp()
    {

    }

}

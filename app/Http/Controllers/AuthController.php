<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AuthController extends Controller
{


    public function forget_password(Request $request)
    {
        return view('frontend/forget_password');
    }

}
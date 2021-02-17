<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class UserController extends Controller
{
    public function AuthUser(){
        return Auth::user();
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Debugbar;

class UserController extends Controller
{
    public function index($id)
    {
    	return view('frontend.users.index', ['user' => User::find($id)]);
    }
}

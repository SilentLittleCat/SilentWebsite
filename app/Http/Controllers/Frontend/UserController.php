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
    	if(! User::userExist($id)) {
    		redirect('/');
    	}

    	$info = User::getUserInfo($id);

    	return view('frontend.users.index', $info);
    }
}

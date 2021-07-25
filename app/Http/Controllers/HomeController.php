<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        if($role == "admin"){
            return redirect()->route('admin');
        }else if($role == "user"){
            return redirect()->route('user');
        }else {
            return redirect()->route('logout');
        }
    }
}

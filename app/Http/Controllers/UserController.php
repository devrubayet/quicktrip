<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function Dashboard(){
         if (Auth::check() && Auth::user()->user_type == 'user') {
        return view('dashboard');
    } elseif (Auth::check() && Auth::user()->user_type == 'admin') {
        return redirect()->route('admin.dashboard'); // 👈 এখানে redirect করো
    } else {
        return redirect('/');
    }

    }
}

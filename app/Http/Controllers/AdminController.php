<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user_type = Auth::user()->user_type;

        if ($user_type == 1) {  // 1 is user
            return view('home.homepage');
        } else if ($user_type == 2) {  // 2 is admin
            return view('admin.index');
        }

        return redirect()->route('login');
    }
}

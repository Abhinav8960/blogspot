<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->status == 10 && $user->is_admin) {
            return view('admin.index');
        }
        // return view('home.homepage');
        return redirect()->route('home');
    }
}

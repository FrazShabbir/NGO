<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        if ($user->is_admin==1) {
            //dd($user);
            return redirect()->route('isAdmin');
        }else{
            return redirect()->route('isUser');
        }
    }

    public function isAdmin(){
        dd('Admin');
    }
    public function isUser(){
        dd('User');
    }
}

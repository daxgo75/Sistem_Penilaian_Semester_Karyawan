<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if($user->role == 'generalmanager'){
            return view('generalmanager.dashboard');
        }elseif($user->role == 'seniormanager') {
            return view('seniormanager.dashboard');
        } elseif ($user->role == 'manager') {
            return view('manager.dashboard');
        } 
    }
}

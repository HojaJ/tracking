<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function redirects() {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $role = Auth::user()->is_permission;
        
        if ($role === 1) {
            return redirect()->route('admin.storage', '1');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        if(!session()->has('searched')){
            session()->put('searched', []);
        }
        return view('user.dashboard');
    }
}

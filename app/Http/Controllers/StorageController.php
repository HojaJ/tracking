<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use App\Models\User;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function index($id)
    {
        $storage = Storage::find($id);
        $allstorages = Storage::all();
        $users = User::where('is_permission',2)->select('id','firstname','code')->get();
        return view('admin.storage', compact('allstorages', 'storage','users'));
    }
}

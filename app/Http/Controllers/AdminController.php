<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
         $usersCount = User::count();

    return view('admin.index', compact('usersCount'));
       
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        $users = User::query()->where('type', '!=', 'admin')->get();
        return view('dashboard', compact('users'));
    }
}

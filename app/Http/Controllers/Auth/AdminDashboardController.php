<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:1']); // Solo usuarios con el rol 'admin' podrán acceder
    }

    public function index()
    {
        return view('auth.dashboard');
    }
}

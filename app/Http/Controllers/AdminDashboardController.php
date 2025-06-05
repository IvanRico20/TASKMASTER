<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User; // Importa el modelo User

class AdminDashboardController extends Controller
{
    /**
     * Muestra el dashboard de administrador.
     */
    public function index()
    {
        // Obtener los datos de las tablas 'visits', 'visit_logs' y 'users'
        $visits = DB::table('visits')->get();
        $visitLogs = DB::table('visit_logs')->get();
        $users = User::all(); // Obtener todos los usuarios

        // Pasar los datos a la vista 'Admin.dashboard'
        return view('Admin.dashboard', compact('visits', 'visitLogs', 'users'));
    }

    /**
     * Muestra la lista de usuarios.
     */
    public function showUsers()
    {
        // Obtener todos los usuarios
        $users = User::all();

        // Pasar los datos a la vista 'admin.users'
        return view('Admin.users', compact('users'));
    }
}

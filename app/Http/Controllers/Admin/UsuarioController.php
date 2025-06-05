<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

    class UsuarioController extends Controller
    {
        public function index()
        {
            $usuarios = User::all(); // Puedes agregar paginación si quieres
            return view('Admin.users', compact('usuarios'));
        }
    
        public function toggleEstado(Request $request, User $user)
{
    // Cambiar el estado (activo a inactivo o viceversa)
    $user->estado = !$user->estado;
    $user->save(); // Guardar el cambio en la base de datos

    // Retornar la respuesta en formato JSON
    return response()->json([
        'success' => true,
        'estado' => $user->estado,
    ]);
}

    }


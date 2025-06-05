<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login()
    {
        // Redirigir si ya está logueado
        if (Auth::check()) {
            $user = Auth::user();
            // Verificamos si el usuario tiene el rol de administrador
            if ($user->isAdmin()) {
                return redirect()->route('Admin.dashboard');
            }

            // Si el usuario no es administrador, redirigimos al panel de usuario
            return redirect()->route('mis-tareas');
        }        

        // Si no está logueado, mostramos la vista de login
        return view('auth.login'); 
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Intentamos autenticar al usuario con las credenciales proporcionadas
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate(); // 🔐 Importante para seguridad y sesión válida

            $user = Auth::user();
            Log::info("✅ Usuario autenticado con rol: {$user->getRoleNames()->first()}");

            // Redirigimos según el rol del usuario
            if ($user->isAdmin()) {
                return redirect()->route('Admin.dashboard')->with('success', 'Bienvenido, administrador!');
            }

            return redirect()->route('mis-tareas')->with('success', 'Inicio de sesión exitoso!');
        }

        // Si las credenciales no coinciden, devolvemos un mensaje de error
        Log::warning('❌ Falló el intento de login');
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    public function logout(Request $request)
    {
        // Cerrar sesión, invalidar la sesión y regenerar el token de seguridad
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Sesión cerrada correctamente.');
    }
}

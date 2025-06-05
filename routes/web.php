<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetpasswordController;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\UsuarioController;

// 🟢 Rutas públicas (no requieren login)
Route::get('/', [IndexController::class, 'index']);
Route::get('/registro', [RegistroController::class, 'registro'])->name('registro');
Route::post('/registro', [RegistroController::class, 'registrado'])->name('registro.submit');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginPost'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::view('/tratamiento-datos', 'tratamiento-datos')->name('tratamiento.datos');

// 🔒 Rutas protegidas (usuarios autenticados)
Route::middleware(['auth', 'verificar.sesion'])->group(function () {
    Route::get('/tareas', [TareasController::class, 'tareas'])->name('tareas');
    Route::post('/tareas', [TareasController::class, 'store'])->name('tareas.store');
    Route::get('/mis-tareas', [TareasController::class, 'mis_tareas'])->name('mis-tareas');
    Route::post('/tareas/{id}/cambiar-prioridad', [TareasController::class, 'cambiarPrioridad'])->name('tareas.cambiarPrioridad');


    // 🧭 Dashboard general
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// 🔐 Rutas exclusivas para administradores (rol 'admin')
Route::get('/Admin/dashboard', [AdminDashboardController::class, 'index'])->name('Admin.dashboard');
Route::get('/Admin/users', [AdminDashboardController::class, 'showUsers'])->name('Admin.users');

// Rutas para mostrar usuarios y cambiar estado
Route::prefix('Admin')->name('Admin.')->middleware(['auth', 'role:admin'])->group(function () {
    // Mostrar usuarios
    Route::get('/users', [UsuarioController::class, 'index'])->name('users'); 

    // Cambiar estado del usuario
    Route::post('/users/{user}', [UsuarioController::class, 'toggleEstado'])->name('toggleEstado'); 
});


// 🔁 Reset de contraseñas
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', [
        'token' => $token,
        'email' => request()->query('email'),
    ]);
})->middleware('guest')->name('password.reset');

// 🗑️ Eliminar tareas
Route::delete('/tareas/{tarea}', [TareasController::class, 'destroy'])->name('tareas.destroy');

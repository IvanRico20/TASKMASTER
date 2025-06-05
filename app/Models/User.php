<?php

namespace App\Models;

use App\Http\Controllers\TareasController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        // 'role_id', // ✅ Opcional: comentar si usas Spatie nativamente
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tareas()
    {
        return $this->hasMany(TareasController::class);
    }

    /**
     * Verifica si el usuario tiene el rol de administrador.
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Asigna rol automáticamente al crear un usuario:
     * El primer usuario es admin, los demás son user.
     */
    protected static function booted()
    {
        static::created(function ($user) {
            $roleName = User::count() === 1 ? 'admin' : 'user';
            $role = \Spatie\Permission\Models\Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);

            $user->assignRole($role); // ✅ Usa el método de Spatie
        });
    }
}

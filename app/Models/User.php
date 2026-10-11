<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Indicamos el nombre exacto de la tabla en la base de datos
    protected $table = 'users';

    // Indicamos cuál es la llave primaria de la tabla
    protected $primaryKey = 'user_id';

    // Si user_id NO es un número entero auto-incremental,
    // y es generado por mi o de otro tipo, desactiva el incremento automático (si fuera el caso):
    // public $incrementing = false;
    // protected $keyType = 'int';

    // Si la tabla no usa las columnas created_at y updated_at estándar de Laravel,
    // puedo desactivarlas con:
    // public $timestamps = false;

    protected $fillable = [
        'user_name',
        'email',
        'password_hash',
        'age',
        'phone_number',
        'is_active',
        'domicilio',
    ];

    protected $hidden = [
        'password_hash',
    ];

    // IMPORTANTE: Como en la tabla la contraseña se llama 'password_hash'
    // en lugar de 'password', le decimos a Laravel qué columna usar para el login:
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}

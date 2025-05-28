<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol'; // Asegúrate de que el nombre de la tabla sea correcto

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

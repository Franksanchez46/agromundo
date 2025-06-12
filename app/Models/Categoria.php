<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categoria extends Model
{

    use HasFactory;
    protected $table = 'categorias'; // Nombre de la tabla
    protected $fillable = [
        'nombre',
        'slug',
        'imagen',
        'descripcion',
        'icono'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    protected static function booted()
    {
        static::creating(function ($categoria) {
            // Generar slug automáticamente
            $categoria->slug = Str::slug($categoria->nombre);
        });

        static::updating(function ($categoria) {
            // Actualizar slug si el nombre cambia
            $categoria->slug = Str::slug($categoria->nombre);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug'; // Usar el slug para las rutas
    }
}

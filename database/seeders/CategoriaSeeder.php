<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Pesticidas',
                'descripcion' => 'Productos para el control de plagas.',
                'icono' => 'fa-solid fa-bug-slash',
                'imagen' => 'categorias/pesticidas.jpeg',
            ],
            [
                'nombre' => 'Abonos',
                'descripcion' => 'Fertilizantes orgánicos y químicos.',
                'icono' => 'fas fa-leaf me-2',
                'imagen' => 'categorias/abono.jpg',
            ],
            [
                'nombre' => 'Animales',
                'descripcion' => 'Productos para animales.',
                'icono' => 'fas fa-cow me-2',
                'imagen' => 'categorias/animales1.png',
            ],
            [
                'nombre' => 'Concentrado granja',
                'descripcion' => 'Comida para animales de granja.',
                'icono' => 'fas fa-box me-2',
                'imagen' => 'categorias/concentradoC.jpeg',
            ],
            [
                'nombre' => 'Concentrado mascotas',
                'descripcion' => 'Comida para mascotas.',
                'icono' => 'fas fa-paw me-2',
                'imagen' => 'categorias/concentradoM2.jpeg',
            ],
            [
                'nombre' => 'Medicamentos',
                'descripcion' => 'Medicamentos veterinarios.',
                'icono' => 'fas fa-capsules me-2',
                'imagen' => 'categorias/medicamentos.jpeg',
            ],
            [
                'nombre' => 'Herramientas',
                'descripcion' => 'Herramientas para el agro.',
                'icono' => 'fas fa-tractor me-2',
                'imagen' => 'categorias/herramientas.jpeg',
            ],
        ];

        foreach ($categorias as $categoria) {
            DB::table('categorias')->insert([
                'nombre' => $categoria['nombre'],
                'slug' => Str::slug($categoria['nombre']),
                'descripcion' => $categoria['descripcion'],
                'icono' => $categoria['icono'],
                'imagen' => $categoria['imagen'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
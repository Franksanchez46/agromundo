<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('ofertas', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->text('descripcion');
        $table->string('descripcion_breve')->nullable();
        $table->string('imagen'); // Ruta de la imagen
        $table->integer('descuento'); // Porcentaje
        $table->string('alt'); // Texto alternativo
        $table->string('url')->default('/comprar'); // Link del botón
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofertas');
    }
};

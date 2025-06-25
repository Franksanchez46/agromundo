 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('variante_id'); // se relaciona con variantes
            $table->foreign('variante_id')->references('id')->on('variantes')->onDelete('cascade');

            $table->string('titulo');
            $table->text('descripcion');
            $table->string('descripcion_breve')->nullable();

            $table->integer('descuento'); // Porcentaje de descuento

            $table->string('imagen'); // Ruta de imagen relacionada a la oferta
            $table->string('alt')->nullable(); // Texto alternativo para accesibilidad

            $table->string('url')->default('/productos'); // Ruta donde se encuentra el producto

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

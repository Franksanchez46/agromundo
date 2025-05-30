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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained('productos')->onDelete('cascade');

            // Nuevos campos agregados directamente
            $table->unsignedBigInteger('variante_id')->nullable();
            $table->string('nombre')->nullable();
            $table->string('tamaño')->nullable();
            $table->string('imagen')->nullable();

            $table->integer('quantity')->default(1);
            $table->decimal('price', 8, 2);
            $table->timestamps();

            // Clave foránea para variante_id
            $table->foreign('variante_id')->references('id')->on('variantes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};

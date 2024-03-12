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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sesion_cine_id'); // Relación con la sesión de cine
            $table->foreign('sesion_cine_id')->references('id')->on('sesiones_cine');
            $table->integer('cantidad'); // Cantidad de entradas compradas en esta transacción
            $table->decimal('precio', 8, 2); // Precio unitario de cada entrada
            $table->timestamps(); // Fechas de creación y actualización del registro
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};

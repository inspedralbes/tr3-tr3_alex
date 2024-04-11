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
            $table->foreign('sesion_cine_id')->references('id')->on('Sessions');
            $table->string('Butaca'); // Fila+asiento
            $table->string('Fila'); // Fila de la sala
            $table->string('Asiento'); // Asiento de la sala
            $table->string('email');
            $table->decimal('precio', 8, 2); // Decimal con 8 dígitos en total y 2 decimales
            $table->unique(['sesion_cine_id', 'Butaca']); // Clave única para evitar entradas duplicadas         
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

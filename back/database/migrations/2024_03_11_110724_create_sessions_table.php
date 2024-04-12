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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelicula_id');
            $table->foreign('pelicula_id')->references('id')->on('peliculas');
            $table->datetime('fecha_hora'); // Fecha y hora de la sesión
            // $table->integer('asientos_disponibles');
            $table->string('tipo_sesion'); // Por ejemplo, 2D, 3D, IMAX
            $table->boolean('subtitulada'); // Indica si la sesión es subtitulada
            $table->integer('precio'); // Precio de la entrada
            $table->integer('precio_Vip'); // Precio de la entrada VIP
            $table->boolean('Vip'); // Indica si la sesión es VIP
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};

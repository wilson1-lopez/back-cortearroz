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
        Schema::create('trabajadores_corte', function (Blueprint $table) {
            $table->id();

            //Relaciones
            $table->foreignId('corte_id')->constrained('cortes')->onDelete('restrict')->comment('Referencia al corte en el que trabajó');
            $table->foreignId('trabajador_id')->constrained('trabajadores')->onDelete('restrict')->comment('Referencia al trabajador asignado al corte');
            $table->decimal('precio_acordado', 10, 2)->comment('Monto acordado para el trabajador en este corte');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadores_corte');
    }
};

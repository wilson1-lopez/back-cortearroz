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
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 250);
            $table->string('apellido', 250);
            $table->string('telefono', 250)->nullable();
            $table->string('cedula', 250)->nullable();
            $table->string('direccion', 250)->nullable();

             // Foreignkeys
            $table->foreignId('tipo_id')->constrained('tipos_trabajadores')->onDelete('restrict')->comment('Relacion con la tabla tipos_trabajadores');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('restrict')->comment('Relacion con la tabla users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadores');
    }
};

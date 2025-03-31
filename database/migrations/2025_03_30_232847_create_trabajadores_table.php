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
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('telefono', 20)->nullable();
            $table->string('cedula', 20)->nullable();
            $table->string('direccion')->nullable();

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

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
        Schema::create('maquinas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 250);
            $table->string('descripcion', 250)->nullable();
            $table->string('estado', 250)->default('activa');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('restrict')->comment('Relacion con la tabla users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maquinas');
    }
};

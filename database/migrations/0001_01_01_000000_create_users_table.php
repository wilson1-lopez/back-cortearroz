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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 250);
            $table->string('apellido', 250);
            $table->string('direccion', 250)->nullable();
            $table->string('email', 250)->unique();
            $table->string('password', 250)->nullable();
            $table->string('google_id', 250)->nullable()->unique()->comment('Para login con Google');
            $table->string('avatar', 250)->nullable()->comment('Foto de perfil que trae de Google'); 
            $table->timestamps();
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
       
    }
};

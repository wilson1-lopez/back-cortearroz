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
        Schema::create('cortes', function (Blueprint $table) {
            $table->id();
    // Datos del corte
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->decimal('valor_bulto', 10, 2);
            $table->string('descripcion', 250)->nullable();

    // Claves foráneas
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('restrict')->comment('Referencia al cliente que solicita el corte');
            $table->foreignId('temporada_id')->constrained('temporadas')->onDelete('restrict')->comment('Referencia a la temporada de corte');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cortes');
    }
};

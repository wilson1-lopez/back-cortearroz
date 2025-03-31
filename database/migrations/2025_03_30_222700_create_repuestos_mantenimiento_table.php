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
        Schema::create('repuestos_mantenimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mantenimiento_id')->constrained('mantenimientos')->onDelete('restrict')->comment('Relacion con el mantenimiento');
            $table->foreignId('repuestos_proveedores_id')->constrained('repuestos_proveedores')->onDelete('restrict')->comment('Relacion con la tabla repuestos_proveedores');
            $table->integer('cantidad');
            $table->decimal('valor', 10, 2);
            $table->string('forma_pago', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repuestos_mantenimiento');
    }
};

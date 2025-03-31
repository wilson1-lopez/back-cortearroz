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
        Schema::create('pagos_trabajadores', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->comment('Fecha en que se realizó el pago');
            $table->decimal('valor', 10, 2)->comment('Monto pagado al trabajador');
            $table->decimal('saldo', 10, 2)->comment('Saldo después del pago');

            // Relación 
            $table->foreignId('trabajadores_corte_id')->constrained('trabajadores_corte')->onDelete('restrict')->comment('Referencia al trabajador y corte al que pertenece el pago');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos_trabajadores');
    }
};

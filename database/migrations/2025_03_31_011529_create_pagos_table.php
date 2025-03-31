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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('corte_id')->constrained('cortes')->onDelete('restrict')->comment('Referencia al corte asociado al pago');

            $table->date('fecha');
            $table->decimal('valor', 10, 2);
            $table->string('forma_pago', 250);
            $table->string('soporte', 250)->nullable();
            $table->string('pagado_por', 250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};

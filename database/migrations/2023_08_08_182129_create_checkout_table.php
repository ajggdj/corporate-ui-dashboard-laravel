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
        Schema::create('checkout', function (Blueprint $table) {
            $table->id();
            $table->string('Idempleado');
            $table->string('observacion_checkout');
            $table->string('fecha_entrega');
            $table->string('fecha_salida');
            $table->string('idmaquinaria');
            $table->string('cantidad');
            $table->integer('idproducto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout');
    }
};

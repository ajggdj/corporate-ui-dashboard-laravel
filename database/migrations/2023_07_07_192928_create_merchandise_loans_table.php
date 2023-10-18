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
        Schema::create('merchandise_loans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_stock');
            $table->integer('id_empleado');
            $table->integer('id_user');
            $table->double('cantidad');
            $table->integer('id_tipo_medida');
            $table->string('fecha_entrga');
            $table->string('fecha_recibido');
            $table->integer('id_user_recibido');
            $table->integer('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchandise_loans');
    }
};

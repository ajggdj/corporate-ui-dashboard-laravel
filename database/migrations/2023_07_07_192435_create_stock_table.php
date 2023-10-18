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
        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->double('cantidad');
            $table->integer('tipo_cantidad_id');
            $table->string('observaciones');
            $table->integer('tipo_mercancia_id');
            $table->string('imagen');
            $table->integer('baja_id');
            $table->integer('baja_user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};

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
            $table->string('metodo_pago');
            $table->unsignedBigInteger('id_venta');
            $table->unsignedBigInteger('id_cliente');
            $table->string('estado')->default('a');
            $table->timestamps();

            $table->foreign('id_venta')->references('id')->on('ventas');
            $table->foreign('id_cliente')->references('id')->on('clientes');
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

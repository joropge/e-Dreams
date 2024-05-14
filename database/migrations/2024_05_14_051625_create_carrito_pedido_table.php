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
        Schema::create('carrito_pedido', function (Blueprint $table) {
            $table->id();
            //carrito
            $table->unsignedBigInteger('carrito_id');
            $table->foreign('carrito_id')->references('id')->on('carritos')->onDelete('cascade');
            //pedido
            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');

            $table->integer('cantidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito_pedido');
    }
};

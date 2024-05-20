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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->on('users')->nullOnDelete();
            $table->foreignId('carrito_id')->nullable()->constrained()->on('carritos')->nullOnDelete();
            $table->foreignId('producto_id')->nullable()->constrained()->on('productos')->nullOnDelete();
            $table->foreignId('direccion_id')->nullable()->constrained()->on('direcciones')->nullOnDelete();
            $table->integer('total');
            $table->enum('estado', ['pendiente', 'enviado', 'entregado', 'cancelado']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};

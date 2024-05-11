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
            $table->foreignId('user_id')->nullable()->on('users')->nullOnDelete();
            $table->foreignId('direccion_id')->nullable()->on('direcciones')->nullOnDelete();
            $table->foreignId('producto_id')->nullable()->on('productos')->nullOnDelete();
            $table->integer('total');
            $table->enum('estado', ['pendiente', 'enviado', 'entregado', 'cancelado']);
            //$table->integer('cantidad_productos');
            // $table->string('metodo_pago');
            // $table->string('comentario')->nullable();
            // $table->string('codigo_seguimiento')->nullable();
            // $table->timestamp('fecha_envio')->nullable();
            // $table->timestamp('fecha_entrega')->nullable();
            // $table->timestamp('fecha_cancelacion')->nullable();
            // $table->timestamp('fecha_devolucion')->nullable();
            // $table->timestamp('fecha_reclamacion')->nullable();
            // $table->timestamp('fecha_reclamacion_resuelta')->nullable();
            // $table->timestamp('fecha_devolucion_resuelta')->nullable();
            // $table->timestamp('fecha_cancelacion_resuelta')->nullable();
            // $table->timestamp('fecha_resolucion')->nullable();
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

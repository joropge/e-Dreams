<?php

use App\Models\Producto;
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
        Schema::create('producto_pedido', function (Blueprint $table) {
            $table->id();

            $table->foreignId('producto_id')
                ->nullable()
                ->constrained('productos')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('pedido_id')
                ->nullable()
                ->constrained('pedidos')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            //producto
            // $table->unsignedBigInteger('producto_id');
            // $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            //pedido
            // $table->unsignedBigInteger('pedido_id');
            // $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_pedido');
    }
};

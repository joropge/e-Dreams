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
        Schema::create('pedido_carrito', function (Blueprint $table) {
            $table->id();
            //carrrito
            $table->unsignedBigInteger('carrito_id');
            $table->foreign('carrito_id')->references('id')->on('carritos')->onDelete('cascade');
            //pedido
            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
        });


        // Schema::table('pedidos', function (Blueprint $table) {
        //     $table->foreignId('carrito_id')->nullable()->constrained('carritos')->nullOnDelete();
        // });

        // Schema::table('carritos', function (Blueprint $table) {
        //     $table->foreignId('pedido')->nullable()->constrained('pedidos')->nullOnDelete();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfesxists('pedidos_carritos');

        // Schema::table('pedidos', function (Blueprint $table) {
        //     $table->dropForeign(['carrito_id']);
        //     $table->dropColumn('carrito_id');
        // });

        // Schema::table('carritos', function (Blueprint $table) {
        //     $table->dropForeign(['pedido']);
        //     $table->dropColumn('pedido');
        // });
    }
};

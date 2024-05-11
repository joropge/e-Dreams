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
            $table->foreignId('pedido_id')->nullable()->on('pedidos')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->on('users')->nullOnDelete();
            $table->string('metodo_pago');
            $table->decimal('total', 8, 2);
            $table->string('numero_tarjeta');
            $table->string('nombre_tarjeta');
            $table->string('fecha_caducidad');
            $table->string('codigo_seguridad');
            // $table->string('direccion_facturacion');
            $table->enum('estado', ['pendiente', 'pagado', 'rechazado']);
            // $table->timestamp('updated_at')->useCurrent();
            // $table->timestamp('deleted_at')->nullable();
            $table->softDeletes();
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

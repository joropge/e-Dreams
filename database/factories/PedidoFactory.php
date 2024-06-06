<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    protected $model = \App\Models\Pedido::class;
    
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'producto_id' => \App\Models\Producto::factory(),
            'direccion_id' => \App\Models\Direccion::factory(),
            'total' => $this->faker->numberBetween(100, 1000),
            'nombreProducto' => $this->faker->sentence(3),
            'estado' => $this->faker->randomElement(['pendiente', 'enviado', 'entregado', 'cancelado']),
        ];
    }
}

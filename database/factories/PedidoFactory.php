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
            'total' => $this->faker->numberBetween(100, 1000),
            'estado' => $this->faker->randomElement(['pendiente', 'enviado', 'entregado', 'cancelado']),
        ];
    }
}

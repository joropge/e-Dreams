<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Producto;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'descripcion' => $this->faker->sentence,
            'precio' => $this->faker->numberBetween(100, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'imagen' => 'product_image.jpg', // Cambia esto por el nombre de tu imagen por defecto
            'talla' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL']),
            'color' => $this->faker->colorName,
        ];
    }
}

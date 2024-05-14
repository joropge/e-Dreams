<?php

namespace Database\Factories;

use App\Models\Direccion;
use Illuminate\Database\Eloquent\Factories\Factory;

class DireccionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Direccion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'calle' => $this->faker->streetName,
            'numero' => $this->faker->buildingNumber,
            'piso' => $this->faker->randomElement([null, $this->faker->randomDigit]),
            'puerta' => $this->faker->randomElement([null, $this->faker->randomLetter]),
            'codigo_postal' => $this->faker->postcode,
            'ciudad' => $this->faker->city,
            'provincia' => $this->faker->state,
            'pais' => $this->faker->country,
        ];
    }
}

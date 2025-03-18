<?php

namespace Database\Factories;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'carMark' => fake()->word(),
            'carModel' => fake()->word(),
            'consumption' => fake()->numberBetween(10, 20),
            'Kilometrage' => fake()->numberBetween(100, 200),
            'Gearbox' => fake()->randomElement(['Manual', 'Automatic']),
            'petrolType' => fake()->randomElement(['Essance', 'Disel']),
            'price' => fake()->numberBetween(60, 100),
            'photo' => 'car.png',
            'nofplaces' => fake()->numberBetween(2, 5),
            'agency_id' => Agency::factory()
        ];
    }
}

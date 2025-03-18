<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agency>
 */
class AgencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['accepted', 'pending']);
        $password = ($status === 'accepted') ? Hash::make('agcy1234') : null;
        return [
            'agencyName' => fake()->name(),
            'ownerName' => fake()->name(),
            'phone' => fake()->regexify('/^[2597]\d{7}$/'),
            'email' => fake()->unique()->safeEmail(),
            'status' => $status,
            'password' => $password,
            'location' => fake()->randomElement(['Ariana', 'Béja', 'Ben Arous', 'Bizerte', 'Gabès',
                'Gafsa', 'Jendouba', 'Kairouan', 'Kasserine', 'Kébili', 'Kef', 'Mahdia', 'Manouba', 'Médenine', 
                'Monastir', 'Nabeul', 'Sfax', 'Sidi Bouzid', 'Siliana', 'Sousse', 'Tataouine', 
                'Tozeur', 'Tunis', 'Zaghouan']),
            'license' => 'license.gpeg',
            
        ];
    }
}

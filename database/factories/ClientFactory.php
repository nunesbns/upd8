<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['female', 'male']);
        return [
            'name' => fake()->name($gender),
            'identity' => fake()->numerify('###########'),
            'birthdate' => fake()->dateTimeBetween('-75 years', '-18 years'),
            'gender' => $gender,
            'city_id' => City::all()->random()->id
        ];
    }
}

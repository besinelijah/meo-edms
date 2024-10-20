<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
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
        return [
            'fname' => $this->faker->name,
            'mname' => $this->faker->name,
            'lname' => $this->faker->name,
            'sex' => $this->faker->randomElement(['Male', 'Female']),
            'street' => $this->faker->address,
            'brgy' => $this->faker->address,
            'municipality' => $this->faker->address,
            'province' => $this->faker->address,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Specialist;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'specialist_id' => Specialist::factory(),
            'status' => fake()->randomElement(['aktif', 'tidak aktif']),
            'no_hp' => fake()->phoneNumber(),
        ];
    }
}

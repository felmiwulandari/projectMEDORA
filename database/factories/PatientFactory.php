<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama'          => fake()->name(),
            'nik'           => fake()->nik(),
            'tanggal_lahir' => fake()->date('Y-m-d', '2005-01-01'),
            'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'alamat'        => fake()->address(),
            'no_hp'         => fake()->phoneNumber(),
        ];
    }
}

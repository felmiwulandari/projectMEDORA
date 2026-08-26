<?php

namespace Database\Factories;
use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal' => fake()->date(),
            'jam_mulai' => fake()->time(),
            'jam_selesai' => fake()->time(),
            'kuota' => fake()->numberBetween(),
            'status' => fake()->randomElement(['aktif', 'tidak aktif']),
            'doctor_id' => Doctor::inRandomOrder()->first()->id,
        ];
    }
}

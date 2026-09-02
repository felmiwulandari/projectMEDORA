<?php

namespace Database\Factories;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 
        $patient = Patient::inRandomOrder()->first() ?? Patient::factory()->create();
        
        //
        $schedule = Schedule::inRandomOrder()->first() ?? Schedule::factory()->create();

        return [
            'patient_id' => $patient->id,
            'schedule_id' => $schedule->id,
            'tanggal_daftar' => fake()->dateTimeBetween('now', '+1 month'),
            'status' => fake()->randomElement(['menunggu', 'Di konfirmasi', 'Di tolak']),
            'keluhan' => fake()->sentence(10),
        ];
    }
}

       
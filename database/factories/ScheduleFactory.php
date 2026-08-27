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
    public function definition(): array
    {
        // 
        $start   = fake()->dateTimeBetween('today 07:00', 'today 16:00');
        $end     = clone $start;
        $end    ->modify('+' . fake()->numberBetween(1, 4) . ' hours');

        return [
            'tanggal'       => fake()->dateTimeBetween('now', '+1 month'),
            'jam_mulai'     => $start->format('H:i:s'),
            'jam_selesai'   => $end->format('H:i:s'),
            'kuota'         => fake()->numberBetween(1, 20),
            'status'        => fake()->randomElement(['aktif', 'tidak aktif']),
            'doctor_id'     => Doctor::inRandomOrder()->first()->id ?? Doctor::factory(),
        ];
    }
}
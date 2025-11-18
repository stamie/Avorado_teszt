<?php

namespace Database\Factories;

use App\Models\Work;
use App\Models\User; // Feltételezve, hogy van User modell
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkFactory extends Factory
{
    /**
     * A Factory-hez tartozó modell neve.
     *
     * @var string
     */
    protected $model = Work::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_place' => $this->faker->sentence(400),
            'end_place' => $this->faker->paragraph(400), 
            'recipient_name' =>  $this->faker->paragraph(250),
            'recipient_phone' => $this->faker->paragraph(20),
            'created_at' => now(),
            'updated_at' => $this->faker->dateTimeBetween('now', '+10 day'),
            'carrier' => User::factory()->carrier(), 
            'status' => $this->faker->randomElement([1, 2, 3, 4]), 
            
            'id' => $this->faker->unique()->randomNumber(5), 
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Work $work) {
            // Frissítés az ID-val (mivel a Factory már elmentette a sort):
            $work->update([
                'id' => $work->id,
            ]);
        });
    }
}
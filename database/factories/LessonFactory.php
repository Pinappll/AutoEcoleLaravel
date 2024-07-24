<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition()
    {
        $start_time = $this->faker->dateTimeBetween('now', '+1 week');
        $end_time = (clone $start_time)->modify('+1 hour');

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'date' => $start_time->format('Y-m-d'),
            'start_time' => $start_time,
            'end_time' => $end_time,
            'moniteur_id' => User::factory(), // Assurez-vous d'avoir des utilisateurs créés
            'student_id' => User::factory(),  // Assurez-vous d'avoir des utilisateurs créés
            'car_id' => Car::factory(),       // Assurez-vous d'avoir des voitures créées
        ];
    }
}

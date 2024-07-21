<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'marque' => $this->faker->company,
            'modele' => $this->faker->word,
            'immatriculation' => strtoupper($this->faker->bothify('??-####-??')),
            'annee' => $this->faker->year,
        ];
    }
}

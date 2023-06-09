<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserva>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1,10000), // como vincular un vehiculo,100
            'email' => $this->faker->unique()->email, //'email' => $faker->random(8).'@gmail.com';
            'fecha_inicio'=> $this->faker->dateTime('now'),
            'fecha_final'=> $this->faker->dateTime('now'),
        ];
    }
}

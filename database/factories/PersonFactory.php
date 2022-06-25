<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $birthDate = $this->faker->dateTimeBetween('-50 years', '-5 years');
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'birth_date' => $birthDate,
            'pesel' => $this->faker->boolean(80) ? $this->faker->pesel($birthDate) : null,
            'phone' => $this->faker->boolean(80) ? $this->faker->phoneNumber() : null,
        ];
    }
}

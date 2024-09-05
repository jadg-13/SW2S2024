<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

class StudentFactory extends Factory
{

    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'cif' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->email(),
            'career' => $this->faker->randomElement(['Ingeniería en Sistemas', 
            'Medicina', 'Derecho', 'Administración de Empresas', 'Arquitectura']),
            'grade' => $this->faker->randomElement(['I', 'II', 'III', 'IV', 'V']),
            'average' => $this->faker->numberBetween(1, 100),
        ];
    }
}

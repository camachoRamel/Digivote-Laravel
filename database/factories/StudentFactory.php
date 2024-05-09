<?php

namespace Database\Factories;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stud_id' => $this->faker->unique()->numerify('####-#####'),
            'stud_firstname' => $this->faker->firstName(),
            'stud_middlename' => $this->faker->randomElement(['Camacho', 'Tugano', 'Tabuzo', 'Avila', 'Sarmiento', 'Million']),
            'stud_lastname' => $this->faker->lastName(),
            'stud_course' => $this->faker->randomElement(['BSIT', 'BSIS']),
            'stud_year' => $this->faker->randomElement([1, 2, 3, 4]),
            'stud_cp_num' => $this->faker->unique()->numerify('###########')
        ];
    }
}

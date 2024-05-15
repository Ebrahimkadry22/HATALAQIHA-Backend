<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'catergory_id' => fake()->numberBetween(1,5),
            'job_type_id' => fake()->numberBetween(1,4),
            'user_id' => fake()->numberBetween(1,3),
            'location' =>  fake()->city(),
            'status' => fake()->numberBetween(0,1),
            'experience' => fake()->numberBetween(1,10),
            'vacancy' => fake()->numberBetween(2000),
            'salary' => fake()->numberBetween(2000),
            'description' => fake()->city(),
            'responsibility' => fake()->text(),
            'qualifications' => fake()->text(),
            'keywords' => fake()->word(),
            'company_name' => fake()->name(),
            'company_location' => fake()->city(),
            'company_website' => fake()->title(),
        ];
    }
}

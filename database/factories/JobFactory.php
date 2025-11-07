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
            'title' => $this->faker->jobTitle(),
            'salary' => $this->faker->numberBetween(30000, 100000),
            'employer_id' => \App\Models\Employer::factory(),
        ];
    }

    /**
     * Indicate that the job should have a high salary (premium job).
     */
    public function premium(): static
    {
        return $this->state(fn (array $attributes) => [
            'salary' => $this->faker->numberBetween(150000, 300000),
        ]);
    }

    /**
     * Indicate that the job should have an entry-level salary.
     */
    public function entryLevel(): static
    {
        return $this->state(fn (array $attributes) => [
            'salary' => $this->faker->numberBetween(25000, 45000),
        ]);
    }

    /**
     * Indicate that the job should be in the tech industry.
     */
    public function tech(): static
    {
        $techJobs = [
            'Software Developer',
            'Frontend Developer', 
            'Backend Developer',
            'Full Stack Developer',
            'DevOps Engineer',
            'Data Scientist',
            'Product Manager',
            'UX Designer',
            'System Administrator',
            'Mobile App Developer'
        ];

        return $this->state(fn (array $attributes) => [
            'title' => $this->faker->randomElement($techJobs),
            'salary' => $this->faker->numberBetween(60000, 150000),
        ]);
    }
}

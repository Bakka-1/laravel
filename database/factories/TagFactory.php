<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Frontend', 'Backend', 'Full-Stack', 'PHP', 'Laravel', 
                'JavaScript', 'React', 'Vue.js', 'Node.js', 'Python',
                'Remote', 'On-site', 'Hybrid', 'Part-time', 'Full-time',
                'Senior', 'Junior', 'Mid-level', 'Intern', 'Lead',
                'Web Development', 'Mobile Development', 'DevOps', 'UI/UX', 'Database'
            ])
        ];
    }
}

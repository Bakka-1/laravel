<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 200 jobs for extensive pagination and performance testing
        \App\Models\Job::factory(200)->create()->each(function ($job) {
            // Attach 2-5 random tags to each job
            $tags = \App\Models\Tag::inRandomOrder()->take(rand(2, 5))->pluck('id');
            $job->tags()->attach($tags);
        });
    }
}

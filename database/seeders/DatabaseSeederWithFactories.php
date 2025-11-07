<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeederWithFactories extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some users
        User::factory()->count(10)->create();
        
        // Create some unverified users
        User::factory()->unverified()->count(3)->create();
        
        // Create a variety of jobs
        Job::factory()->count(20)->create();
        
        // Create some premium jobs
        Job::factory()->premium()->count(5)->create();
        
        // Create some entry-level jobs
        Job::factory()->entryLevel()->count(8)->create();
    }
}

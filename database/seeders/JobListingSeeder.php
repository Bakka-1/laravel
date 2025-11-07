<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_listings')->insert([
            [
                'title' => 'Director',
                'salary' => 50000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Programmer',
                'salary' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Teacher',
                'salary' => 40000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

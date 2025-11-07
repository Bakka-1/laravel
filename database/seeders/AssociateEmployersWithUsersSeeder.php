<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssociateEmployersWithUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all employers without user_id
        $employersWithoutUsers = Employer::whereNull('user_id')->get();
        
        foreach ($employersWithoutUsers as $employer) {
            // Create a new user for each employer or use an existing one
            $user = User::factory()->create();
            $employer->update(['user_id' => $user->id]);
        }
        
        $this->command->info('Associated ' . $employersWithoutUsers->count() . ' employers with users.');
    }
}

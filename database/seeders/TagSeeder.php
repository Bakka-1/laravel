<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create specific tags to ensure we have good variety
        $tags = [
            'Frontend', 'Backend', 'Full-Stack', 'PHP', 'Laravel', 
            'JavaScript', 'React', 'Vue.js', 'Node.js', 'Python',
            'Remote', 'On-site', 'Hybrid', 'Part-time', 'Full-time',
            'Senior', 'Junior', 'Mid-level', 'Intern', 'Lead',
            'Web Development', 'Mobile Development', 'DevOps', 'UI/UX', 'Database'
        ];

        foreach ($tags as $tagName) {
            \App\Models\Tag::firstOrCreate(['name' => $tagName]);
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    
    protected $table = 'job_listings';
    
    protected $fillable = ['title', 'salary', 'employer_id'];

    /**
     * Get the employer that owns the job.
     */
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    /**
     * The tags that belong to the job.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'job_tag', 'job_listing_id', 'tag_id');
    }
}
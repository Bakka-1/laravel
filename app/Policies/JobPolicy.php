<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Anyone can view the job listings
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Job $job): bool
    {
        return true; // Anyone can view individual jobs
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Any authenticated user can create jobs
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Job $job): bool
    {
        // Step 6: Policy authorization logic - same as gates
        // Load employer and user relationship if not already loaded
        if (!$job->relationLoaded('employer')) {
            $job->load('employer.user');
        }
        
        // Check if the user owns the job through the employer relationship
        return $job->employer && $job->employer->user && $job->employer->user->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Job $job): bool
    {
        // Same logic as update - user must own the job
        return $this->update($user, $job);
    }

    /**
     * Determine whether the user can edit the model.
     * Custom method for our edit gate.
     */
    public function edit(User $user, Job $job): bool
    {
        // Same logic as update - user must own the job
        return $this->update($user, $job);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Job $job): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Job $job): bool
    {
        return false;
    }
}

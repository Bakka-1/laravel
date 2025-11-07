<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\User;
use App\Policies\JobPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Prevent lazy loading in development to catch N+1 problems
        \Illuminate\Database\Eloquent\Model::preventLazyLoading(!app()->isProduction());

        // Step 3: Define Gates for Authorization
        Gate::define('edit-job', function (User $user, Job $job) {
            // Load employer and user relationship if not already loaded
            if (!$job->relationLoaded('employer')) {
                $job->load('employer.user');
            }
            
            // Check if the user owns the job through the employer relationship
            return $job->employer && $job->employer->user && $job->employer->user->is($user);
        });

        Gate::define('update-job', function (User $user, Job $job) {
            // Same logic as edit-job
            return Gate::forUser($user)->allows('edit-job', $job);
        });

        Gate::define('delete-job', function (User $user, Job $job) {
            // Same logic as edit-job  
            return Gate::forUser($user)->allows('edit-job', $job);
        });

        // Step 6: Register Policies
        Gate::policy(Job::class, JobPolicy::class);
    }
}

# Laravel Authorization - Episode 19

This guide demonstrates the complete implementation of Laravel's authorization system, showcasing six different approaches from simple inline checks to sophisticated policies.

## Overview

Laravel Authorization provides multiple ways to control user access to resources:

1. **Inline Authorization** - Direct checks in controllers
2. **Gates** - Reusable authorization logic  
3. **can/cannot Methods** - User model convenience methods
4. **Middleware Authorization** - Route-level protection
5. **Policies** - Class-based authorization for models
6. **Blade Directives** - View-level conditional display

## Database Relationships

### User → Employer → Job

To enable user-based job authorization, we established this relationship chain:

```php
// User has one Employer
User::hasOne(Employer::class)

// Employer belongs to User  
Employer::belongsTo(User::class)

// Job belongs to Employer
Job::belongsTo(Employer::class)
```

**Migration Added:**
```php
// employers table
$table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
```

## Authorization Implementations

### 1. Inline Authorization (Step 2)

Direct authorization checks in controller methods:

```php
public function edit(Job $job)
{
    // Redirect guests to login
    if (!Auth::check()) {
        return redirect('/login');
    }

    // Load employer and user relationships
    $job->load('employer.user');

    // Check ownership via relationships
    if (!$job->employer || !$job->employer->user || !$job->employer->user->is(Auth::user())) {
        abort(403, 'You are not authorized to edit this job.');
    }

    return view('jobs.edit', ['job' => $job]);
}
```

### 2. Gates (Step 3)

Centralized authorization logic in `AppServiceProvider`:

```php
// AppServiceProvider::boot()
Gate::define('edit-job', function (User $user, Job $job) {
    if (!$job->relationLoaded('employer')) {
        $job->load('employer.user');
    }
    
    return $job->employer && $job->employer->user && $job->employer->user->is($user);
});

Gate::define('update-job', function (User $user, Job $job) {
    return Gate::forUser($user)->allows('edit-job', $job);
});

Gate::define('delete-job', function (User $user, Job $job) {
    return Gate::forUser($user)->allows('edit-job', $job);
});
```

**Controller Usage:**
```php
public function edit(Job $job)
{
    Gate::authorize('edit-job', $job); // Auto-aborts with 403
    return view('jobs.edit', ['job' => $job]);
}
```

### 3. can/cannot Methods (Step 4)

User model convenience methods for authorization checks:

**Controller:**
```php
public function show(Job $job)
{
    $job->load(['employer', 'tags']);
    
    $canEdit = Auth::check() && Gate::allows('edit-job', $job);
    $canDelete = Auth::check() && Gate::allows('delete-job', $job);
    
    return view('jobs.show', [
        'job' => $job,
        'canEdit' => $canEdit,
        'canDelete' => $canDelete
    ]);
}
```

**Blade Template:**
```blade
@if($canEdit)
    <a href="/jobs/{{ $job->id }}/edit">Edit Job</a>
@endif

@if($canDelete)
    <form method="POST" action="/jobs/{{ $job->id }}">
        @csrf @method('DELETE')
        <button type="submit">Delete Job</button>
    </form>
@endif
```

### 4. Middleware Authorization (Step 5)

Route-level authorization using middleware:

```php
// routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    
    // Authorization middleware for job modification routes
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
        ->middleware('can:edit-job,job')
        ->name('jobs.edit');
    Route::patch('/jobs/{job}', [JobController::class, 'update'])
        ->middleware('can:update-job,job')
        ->name('jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])
        ->middleware('can:delete-job,job')
        ->name('jobs.destroy');
});
```

**Benefits:**
- Authorization handled before controller method execution
- Cleaner controller methods
- Automatic 403 responses for unauthorized access

### 5. Policies (Step 6)

Class-based authorization for complex logic:

**JobPolicy.php:**
```php
class JobPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // Anyone can view job listings
    }

    public function view(User $user, Job $job): bool
    {
        return true; // Anyone can view individual jobs
    }

    public function create(User $user): bool
    {
        return true; // Any authenticated user can create jobs
    }

    public function update(User $user, Job $job): bool
    {
        if (!$job->relationLoaded('employer')) {
            $job->load('employer.user');
        }
        
        return $job->employer && $job->employer->user && $job->employer->user->is($user);
    }

    public function delete(User $user, Job $job): bool
    {
        return $this->update($user, $job);
    }

    public function edit(User $user, Job $job): bool
    {
        return $this->update($user, $job);
    }
}
```

**Policy Registration:**
```php
// AppServiceProvider::boot()
Gate::policy(Job::class, JobPolicy::class);
```

### 6. Blade Directives (Alternative)

Direct authorization checks in templates:

```blade
{{-- Direct @can directives in Blade --}}
@can('edit-job', $job)
    <a href="/jobs/{{ $job->id }}/edit">Edit Job (Direct)</a>
@endcan

@can('delete-job', $job)
    <form method="POST" action="/jobs/{{ $job->id }}">
        @csrf @method('DELETE')
        <button type="submit">Delete Job (Direct)</button>
    </form>
@endcan
```

## Best Practices

### For Simple Applications
- Use **Gates** for basic authorization logic
- Apply **Middleware** to routes for automatic protection
- Use **@can directives** in Blade for conditional display

### For Complex Applications
- Implement **Policies** for model-specific authorization
- Use **Policy methods** for complex business rules
- Organize authorization logic in dedicated Policy classes

### General Guidelines
1. **Establish proper relationships** between User and resources
2. **Start with inline checks**, then extract to Gates/Policies
3. **Use middleware** for route-level protection
4. **Leverage can/cannot methods** for conditional UI elements
5. **Choose Policies** for scalable, maintainable authorization

## Security Considerations

- Always load required relationships to avoid N+1 queries
- Use `->is($user)` method for secure user comparison
- Apply authorization at multiple layers (routes, controllers, views)
- Test authorization scenarios thoroughly
- Handle guest users appropriately

## Authorization Flow

1. **Route Middleware** → Checks authorization before controller
2. **Controller Gates** → Additional checks within methods
3. **Policy Methods** → Complex model-specific logic
4. **Blade Directives** → Conditional UI rendering

This layered approach ensures comprehensive security while maintaining clean, maintainable code.
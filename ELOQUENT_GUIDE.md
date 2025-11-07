# Eloquent ORM - Episode 9

This implementation follows Laravel episode 9, introducing Eloquent ORM (Object Relational Mapper).

## What is Eloquent?

Eloquent is Laravel's ORM that maps database rows to PHP objects, allowing you to work with your data in an object-oriented way instead of dealing with raw arrays.

## Job Model Conversion

The `Job` class has been converted from a simple class to an Eloquent model:

### Before (Episode 8):
```php
class Job
{
    public static function all(): array
    {
        return DB::table('job_listings')->get()->map(function ($job) {
            return (array) $job;
        })->toArray();
    }

    public static function find(int $id): ?array
    {
        $job = DB::table('job_listings')->where('id', $id)->first();
        return $job ? (array) $job : null;
    }
}
```

### After (Episode 9):
```php
class Job extends Model
{
    protected $table = 'job_listings';
    protected $fillable = ['title', 'salary'];
}
```

## Key Changes

### 1. **Extends Model**
- `extends Illuminate\Database\Eloquent\Model`
- Provides all Eloquent functionality automatically

### 2. **Table Name**
- `protected $table = 'job_listings';`
- Tells Eloquent which table to use (default would be `jobs`)

### 3. **Mass Assignment Protection**
- `protected $fillable = ['title', 'salary'];`
- Specifies which attributes can be mass assigned via `create()` or `update()`

### 4. **Views Updated**
- Changed from array syntax: `$job['title']` 
- To object syntax: `$job->title`

## Eloquent Methods

### Retrieving Data:
```php
// Get all jobs
$jobs = Job::all();

// Find specific job by ID
$job = Job::find(1);

// Access attributes
echo $job->title;
echo $job->salary;
```

### Creating Data:
```php
// Create new job
Job::create([
    'title' => 'Software Engineer',
    'salary' => 75000
]);
```

## Using Tinker

Laravel Tinker is a REPL (interactive shell) for testing:

```bash
php artisan tinker
```

### Tinker Examples:
```php
// Get all jobs
App\Models\Job::all()

// Find specific job
App\Models\Job::find(1)

// Create new job
App\Models\Job::create(['title' => 'Designer', 'salary' => 65000])

// Access properties
App\Models\Job::find(1)->title
```

## Generating Models and Migrations

Create model with migration:
```bash
php artisan make:model Post -m
```

This creates:
- `app/Models/Post.php` (Eloquent model)
- `database/migrations/xxxx_create_posts_table.php` (migration)

## Benefits of Eloquent

1. **Object-Oriented**: Work with objects instead of arrays
2. **Clean API**: Simple, expressive methods
3. **Relationships**: Easy to define model relationships
4. **Mass Assignment Protection**: Built-in security
5. **Automatic Timestamps**: Handles `created_at` and `updated_at`
6. **Collection Methods**: Powerful collection operations

## Migration from Arrays to Objects

Views were updated to use object syntax:
- `{{ $job['title'] }}` → `{{ $job->title }}`
- `{{ $job['salary'] }}` → `{{ $job->salary }}`
- `{{ $job['id'] }}` → `{{ $job->id }}`

The application now uses true Eloquent models with all the benefits of Laravel's ORM system!
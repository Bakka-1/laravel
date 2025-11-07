# Laravel Factories - Episode 10

This implementation follows Laravel episode 10, introducing Model Factories for generating fake data.

## What are Factories?

Factories allow you to scaffold or generate fake data for your models. They're essential for:
- Testing your application
- Populating local development environment
- Creating demo data
- Seeding databases quickly

## JobFactory Implementation

### Generated Factory:
```bash
php artisan make:factory JobFactory --model=Job
```

### Factory Definition:
```php
class JobFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'salary' => $this->faker->numberBetween(30000, 100000),
        ];
    }
}
```

### Job Model Updates:
Added the `HasFactory` trait to enable factory usage:
```php
class Job extends Model
{
    use HasFactory;
    // ... rest of model
}
```

## Using Factories

### Basic Usage:
```php
// Create single job
Job::factory()->create();

// Create multiple jobs
Job::factory()->count(10)->create();

// Create job without persisting to database
Job::factory()->make();
```

### With Tinker:
```bash
php artisan tinker
```

```php
// Create one job
App\Models\Job::factory()->create()

// Create 5 jobs
App\Models\Job::factory()->count(5)->create()

// Check the results
App\Models\Job::all()
```

## Factory States

Factory states allow you to create variations of your models:

### Premium Jobs State:
```php
public function premium(): static
{
    return $this->state(fn (array $attributes) => [
        'salary' => $this->faker->numberBetween(150000, 300000),
    ]);
}
```

### Entry Level Jobs State:
```php
public function entryLevel(): static
{
    return $this->state(fn (array $attributes) => [
        'salary' => $this->faker->numberBetween(25000, 45000),
    ]);
}
```

### Using States:
```php
// Create premium job
Job::factory()->premium()->create();

// Create entry-level job
Job::factory()->entryLevel()->create();

// Create multiple premium jobs
Job::factory()->premium()->count(5)->create();
```

## UserFactory (Built-in)

Laravel includes a UserFactory by default:

### Features:
- Generates fake name, email, password
- Includes `unverified()` state for testing
- Uses secure password hashing
- Generates unique emails

### Usage:
```php
// Create verified user
User::factory()->create();

// Create unverified user
User::factory()->unverified()->create();

// Create multiple users
User::factory()->count(50)->create();
```

## Database Seeding with Factories

### DatabaseSeederWithFactories Example:
```php
public function run(): void
{
    // Create users
    User::factory()->count(10)->create();
    User::factory()->unverified()->count(3)->create();
    
    // Create jobs
    Job::factory()->count(20)->create();
    Job::factory()->premium()->count(5)->create();
    Job::factory()->entryLevel()->count(8)->create();
}
```

### Run the seeder:
```bash
php artisan db:seed --class=DatabaseSeederWithFactories
```

## Faker Methods Used

The JobFactory uses these Faker methods:
- `$this->faker->jobTitle()` - Generates realistic job titles
- `$this->faker->numberBetween(min, max)` - Random numbers in range

Other useful Faker methods:
- `fake()->name()` - Person's name
- `fake()->email()` - Email address
- `fake()->unique()->safeEmail()` - Unique email
- `fake()->text()` - Random text
- `fake()->dateTime()` - Random date/time

## Benefits of Factories

1. **Quick Data Generation**: Create lots of test data instantly
2. **Realistic Data**: Uses Faker for believable fake data
3. **Consistent Testing**: Same data structure every time
4. **Local Development**: Populate dev environment easily
5. **States**: Create variations for different scenarios
6. **Relationships**: Can handle model relationships (future episodes)

## Best Practices

1. **Use descriptive factory methods** for different scenarios
2. **Keep factory definitions simple** and focused
3. **Use states** for variations rather than separate factories
4. **Test your factories** regularly with Tinker
5. **Use factories in seeders** for consistent database setup

## Interactive Testing with Tinker

Tinker is perfect for testing factories:
```bash
php artisan tinker

# Create and inspect jobs
App\Models\Job::factory()->create()

# Create multiple jobs
App\Models\Job::factory()->count(10)->create()

# Test states
App\Models\Job::factory()->premium()->create()

# Check the database
App\Models\Job::count()
```

Your database now has realistic fake data for development and testing! 🎉
# Database Setup - Episode 8

This implementation follows Laravel episode 8, covering database setup and migrations.

## Database Configuration

Laravel is configured to use SQLite by default (see `.env` file):
```
DB_CONNECTION=sqlite
```

The SQLite database file is located at `database/database.sqlite`.

## Migration

A migration has been created for the `job_listings` table:
```bash
php artisan make:migration create_job_listings_table
```

The migration includes:
- `id` (primary key)
- `title` (string)
- `salary` (integer)
- `created_at` and `updated_at` timestamps

## Running Migrations

To create the database tables:
```bash
php artisan migrate
```

To rollback migrations:
```bash
php artisan migrate:rollback
```

To refresh all migrations:
```bash
php artisan migrate:refresh
```

## Seeding Data

Sample job data is seeded using `JobListingSeeder`:
```bash
php artisan db:seed --class=JobListingSeeder
```

## Job Model

The `Job` model has been updated to fetch data from the database:
- `Job::all()` - Returns all job listings from the database
- `Job::find($id)` - Returns a specific job by ID or null if not found

## Database Tools

For GUI database management, consider using:
- TablePlus (recommended in the episode)  
- DB Browser for SQLite
- phpMyAdmin (for MySQL)

## Artisan Commands

Some useful database-related Artisan commands:
```bash
php artisan migrate            # Run migrations
php artisan migrate:status     # Check migration status  
php artisan db:seed           # Run all seeders
php artisan tinker            # Interactive PHP shell
```
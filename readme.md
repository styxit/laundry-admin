# Laundry admin
[![StyleCI](https://github.styleci.io/repos/89791336/shield?branch=master)](https://github.styleci.io/repos/89791336)

Monitor your laundry.

## Setup

### Installation steps
- Clone the project
- Do a `composer install`
- Duplicate the `.env.example` file to `.env` and adjust the config values.
- Run `php artisan migrate` to create the initial tables.

### Queue configuration
You can run all jobs and listeners in sync or use [Horizon](https://laravel.com/docs/horizon) to process the jobs.
In your `.env` file, set `QUEUE_DRIVER=sync` or `QUEUE_DRIVER=redis`.

## SQLite database
- Create a new SQLite database `touch database/database.sqlite`.
- Update your `.env`.

```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

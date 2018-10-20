# Laundry admin
[![StyleCI](https://github.styleci.io/repos/89791336/shield?branch=master)](https://github.styleci.io/repos/89791336)

Monitor your laundry.

## Setup

### Installation steps
- Clone the project
- Do a `composer install`
- Duplicate the `.env.example` file to `.env` and adjust the config values.
- Run `php artisan migrate` to create the initial tables.
- Create your first user account to get started `php artisan users:create`.
- Register the default laravel cron to run every minute:
    ```
    * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
    ```

### Queue configuration
You can run all jobs and listeners in sync or use [Horizon](https://laravel.com/docs/horizon) to process the jobs.
In your `.env` file, set `QUEUE_DRIVER=sync` or `QUEUE_DRIVER=redis`.

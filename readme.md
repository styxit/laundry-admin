# Laundy admin

Monitor your laundry.

## Setup

### Installation steps
- Clone the project
- Do a `composer install`
- Duplicate the `.env.example` file to `.env` and adjust the config values.
- Run `php artisan migrate` to create the initial tables.

## SQLite database
- Create a new SQLite database `touch database/database.sqlite`.
- Update your `.env`.

```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

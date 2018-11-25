# Laundry admin - Monitor your laundry
[![StyleCI](https://github.styleci.io/repos/89791336/shield?branch=master)](https://github.styleci.io/repos/89791336)

![Laundry Admin header](https://raw.githubusercontent.com/styxit/laundry-admin/master/header.png)

## Application setup

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

### Test/development settings
To have some data to work with while testing, this application comes with database seeds which will insert random data.

**Warning:** This will truncate the tables, do not execute on production environment!  
`php artisan migrate:refresh --seed`

The following credentials can be used to login:
- E-mail: `laundry@example.com` 
- Password: `123456` 

## Pushing machine states
This applications needs data from your (washing) machines. The remaining time in seconds must me pushed so the application knows a job is running and can send notifications upon completion.

### Send new data
A http POST request must be made to `/api/machines/{ID}/machine_states` where `{ID}` is the machine identifier that can be found in the application after registering a machine. To authenticate the request, a `MachineToken` must be send with it in the request header. This token can also be found in the application.

The following curl command is an example of how to push a remaining time of 4 minutes (240 seconds)to your first machine. 
```
curl -X "POST" "http://laundry-host.test/api/machines/1/machine_states" \
     -H 'MachineToken: YourMachineTokenHere' \
     -d $'{
  "seconds_remaining": 240
}'
``` 

### Completing a job
Whenever your machine finished a job/run, push a remaining time of 0 seconds. This will complete the job and send a notification to the user.

Jobs that are in a running state for over 24 hours, will automatically be completed.

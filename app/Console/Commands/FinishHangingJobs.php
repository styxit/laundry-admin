<?php

namespace App\Console\Commands;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class FinishHangingJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:finish {--hours=24 : Active jobs older than $hours will be completed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Finish hanging active jobs';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Determine cut-off time for which jobs to finish.
        $timelimit = Carbon::now()->subHours(
            $this->option('hours')
        );

        $this->info(sprintf(
            'Active jobs created before %s will now be completed.',
            $timelimit->toDateTimeString()
        ));

        dispatch_now(
            new \App\Jobs\FinishHangingJobs($this->option('hours'))
        );
    }
}

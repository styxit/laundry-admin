<?php

namespace App\Console\Commands;

use App\MachineJob;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

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
     * @var \App\MachineJob The MachineJob model.
     */
    private $machineJob;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MachineJob $machineJob)
    {
        $this->machineJob = $machineJob;

        parent::__construct();
    }

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

        $this->machineJob
            ->isActive()
            ->where('created_at', '<', $timelimit)
            ->update(['completed' => 1]);
    }
}

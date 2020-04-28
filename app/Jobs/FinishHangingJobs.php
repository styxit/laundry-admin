<?php

namespace App\Jobs;

use App\MachineJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class FinishHangingJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int The number of hours after which running jobs will be completed.
     */
    private $hours;

    /**
     * FinishHangingJobs constructor.
     *
     * @param int $hours he number of hours after which running jobs will be completed.
     */
    public function __construct(int $hours = 12)
    {
        $this->hours = $hours;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(MachineJob $machineJob)
    {
        // Determine cut-off time for which jobs to finish.
        $timelimit = Carbon::now()->subHours(
            $this->hours
        );

        $machineJob
            ->isActive()
            ->where('created_at', '<', $timelimit)
            ->update(['completed' => 1]);
    }
}

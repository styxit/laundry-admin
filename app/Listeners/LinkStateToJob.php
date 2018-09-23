<?php

namespace App\Listeners;

use App\MachineJob;
use App\Events\MachineJobNewState;
use App\Events\MachineStateCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class LinkStateToJob.
 *
 * Link a MachineState to an existing MachineJob, or create a new MachineJob.
 */
class LinkStateToJob implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  MachineStateCreated  $event
     * @return void
     */
    public function handle(MachineStateCreated $event)
    {
        // Find the latest job for the machine that is active.
        $job = $event->state->machine()->first()->jobs()->orderBy('created_at', 'desc')->isActive()->first();

        // If there is no active job, create a new one.
        if (! $job) {
            $job = new MachineJob();
            // Set the $state->seconds_remaining as the job duration.
            $job->duration = $event->state->seconds_remaining;
            $job->machine()->associate($event->state->machine()->first());
            $job->save();
        }

        // Link the state to the job.
        $event->state->job()->associate($job);
        $event->state->save();

        // A state has been attached to a job, trigger event.
        event(new MachineJobNewState($job));
    }
}

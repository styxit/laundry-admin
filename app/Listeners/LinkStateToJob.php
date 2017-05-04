<?php

namespace App\Listeners;

use App\Events\MachineStateCreated;
use App\MachineJob;

/**
 * Class LinkStateToJob
 *
 * Link a MachineState to an existing MachineJob, or create a new MachineJob.
 *
 * @package App\Listeners
 */
class LinkStateToJob
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
        if (!$job) {
            $job = new MachineJob();
            // Set the $state->seconds_remaining as the job duration.
            $job->duration = $event->state->seconds_remaining;
            $job->machine()->associate($event->state->machine()->first());
            $job->save();
        }

        // Link the state to the job.
        $event->state->job()->associate($job);
        $event->state->save();
    }
}

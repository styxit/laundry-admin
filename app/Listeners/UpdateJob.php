<?php

namespace App\Listeners;

use App\Events\MachineJobNewState;
use App\MachineJob;
use App\Notifications\JobFinished;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class UpdateJob.
 *
 * Update a job after it has received a new state.
 */
class UpdateJob implements ShouldQueue
{
    private $machineJob;

    public function __construct(MachineJob $machineJob)
    {
        $this->machineJob = $machineJob;
    }

    /**
     * Handle the event.
     *
     * @param  MachineJobNewState  $event
     * @return void
     */
    public function handle(MachineJobNewState $event)
    {
        $job = $this->machineJob->with([
            'states' => function ($query) {
                $query->orderBy('created_at', 'desc');
                $query->limit(1);
            },
        ])->isActive()->find($event->machineJob->id);

        // If the latest state has a remaining seconds of 0, finish it.
        if ($job && $job->states()->first()->seconds_remaining === 0) {
            $job->completed = 1;
            $job->save();

            // Notify the user that owns the corresponding machine.
            $job->machine->user->notify(
                new JobFinished($job)
            );
        }
    }
}

<?php

namespace App\Listeners;

use App\Events\MachineJobNewState;
use App\Events\MachineStateCreated;
use App\MachineJob;

/**
 * Class UpdateJob
 *
 * Update a job after it has received a new state.
 *
 * @package App\Listeners
 */
class UpdateJob
{
    private $machineJob;

    public function __construct(MachineJob $machineJob)
    {
        $this->machineJob = $machineJob;
    }
    /**
     * Handle the event.
     *
     * @param  MachineJobNewState $event
     * @return void
     */
    public function handle(MachineJobNewState $event)
    {
        $job = $this->machineJob->with([
            'states' => function($query) {
                $query->orderBy('created_at', 'desc');
                $query->limit(1);
            }
        ])->isActive()->find($event->machineJob->id);

        dump($job);

        // If there is no active job, create a new one.
        if ($job && $job->isActive() && $job->states()->first()->seconds_remaining === 0) {
            dump('job is active and timer is 0');
            $job->completed = 1;
            $job->save();
        }
    }
}

<?php

namespace App\Events;

use App\MachineJob;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class MachineJobNewState
{
    use Dispatchable, SerializesModels;

    /**
     * @var MachineJob The machine job that got a new state.
     */
    public $machineJob;

    /**
     * Event when a MachineState was added to a job.
     *
     * @param MachineJob $machineJob The machine job that got a new state.
     */
    public function __construct(MachineJob $machineJob)
    {
        $this->machineJob = $machineJob;
    }
}

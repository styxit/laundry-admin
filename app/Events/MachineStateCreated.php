<?php

namespace App\Events;

use App\MachineState;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MachineStateCreated
{
    use Dispatchable, SerializesModels;

    /**
     * @var MachineState The state that has been created.
     */
    public $state;

    /**
     * Event when a new Machine state has been created.
     *
     * @param  MachineState  $state  The state that has been created.
     */
    public function __construct(MachineState $state)
    {
        $this->state = $state;
    }
}

<?php

namespace App\Http\Controllers;

use App\MachineJob;
use App\MachineState;
use Illuminate\Http\Request;
use App\Events\MachineStateCreated;

class MachineStateController extends Controller
{
    /**
     * Store a new machine state.
     *
     * @return Response
     */
    public function store(Request $request, MachineJob $machineJob, $machineId)
    {
        // Validate.
        $this->validate(
            $request,
            [
                'seconds_remaining' => [
                    'required',
                    'int',
                    'max:65535',
                ],
            ]
        );
        // If the remaining time is 0 and there is no active job; ignore this state.
        if ($request->get('seconds_remaining') == 0 && $machineJob->where('machine_id', $machineId)->isActive()->get()->isEmpty()) {
            return;
        }

        // Store machine state in database.
        $state = new MachineState;
        $state->seconds_remaining = $request->get('seconds_remaining');
        $state->machine()->associate($machineId);
        $state->save();

        event(new MachineStateCreated($state));

        return $state->id;
    }
}

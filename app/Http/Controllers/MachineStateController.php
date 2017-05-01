<?php

namespace App\Http\Controllers;

use App\Events\MachineStateCreated;
use App\MachineState;
use Illuminate\Http\Request;

class MachineStateController extends Controller
{
    /**
     * Store a new machine state.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // validate
        $this->validate(
            $request,
            [
                'seconds_remaining' => 'required',
                'machine_id' => 'exists:machines,id',
            ]
        );

        // Store machine state in database.
        $state = new MachineState;
        $state->seconds_remaining = $request->get('seconds_remaining');
        $state->machine()->associate($request->get('machine_id'));
        $state->save();

        event(new MachineStateCreated($state));

        return $state->id;
    }
}

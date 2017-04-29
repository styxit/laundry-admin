<?php

namespace App\Http\Controllers;

use App\Machine;

class MachineController extends Controller
{

    public function index()
    {
        return view(
            'machines.index',
            [
                'machines' => Machine::all(),
            ]
        );
    }

    /**
     * Show the machine details for the given machine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return view(
            'machines.show',
            [
                'machine' => Machine::findOrfail($id),
            ]
        );
    }
}

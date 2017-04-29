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
}

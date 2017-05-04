<?php

namespace App\Http\Controllers;

use App\Machine;
use Illuminate\Http\Request;

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
        $machine = Machine::with([
            'jobs' => function ($query) {
                $query->limit(15);
            },
            'states'=> function ($query) {
                $query->with('job');
                $query->limit(20);
            },
        ])->findOrfail($id);

        return view(
            'machines.show',
            [
                'machine' => $machine,
            ]
        );
    }

    /**
     * Show the form to create a new machine.
     *
     * @return Response
     */
    public function create()
    {
        return view('machines.create');
    }

    /**
     * Store a new machine.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // validate
        $this->validate(
            $request,
            [
                'name' => 'required',
            ]
        );

        // Store machine in database.
        $machine = new Machine;
        $machine->name = $request->get('name');
        $machine->brand = $request->get('brand');
        $machine->model = $request->get('model');
        $machine->save();

        return redirect()->route('machine.show', [$machine->id]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MachineController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view,machine', ['except' => ['index', 'create', 'store']]);
    }

    /**
     * Display a listing of machines for a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'machines.index',
            [
                'machines' => Auth::user()->machines,
            ]
        );
    }

    /**
     * Show the form for creating a new machine.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('machines.create');
    }

    /**
     * Store a newly created machine.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate.
        $this->validate(
            $request,
            [
                'name' => 'required',
            ]
        );

        // Store machine in database.
        $machine = new Machine();
        $machine->name = $request->get('name');
        $machine->brand = $request->get('brand');
        $machine->model = $request->get('model');
        $machine->user_id = Auth::id();
        $machine->save();

        return redirect()->route('machines.show', [$machine->id]);
    }

    /**
     * Show the machine details for the given machine.
     *
     * @param  \App\Machine  $machine
     * @return \Illuminate\Http\Response
     */
    public function show(Machine $machine)
    {
        $machine->load([
            'jobs' => function ($query) {
                $query->limit(15);
            },
            'states'=> function ($query) {
                $query->with('job');
                $query->limit(20);
            },
        ]);

        return view(
            'machines.show',
            [
                'machine' => $machine,
            ]
        );
    }
}

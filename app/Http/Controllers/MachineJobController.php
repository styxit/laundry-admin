<?php

namespace App\Http\Controllers;

use App\MachineJob;

class MachineJobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show a machine job.
     *
     * @param  int $id The machine job id.
     *
     * @return Response
     */
    public function show($id)
    {
        return view(
            'machine_jobs.show',
            [
                'job' => MachineJob::with('states', 'machine')->findOrfail($id),
            ]
        );
    }
}

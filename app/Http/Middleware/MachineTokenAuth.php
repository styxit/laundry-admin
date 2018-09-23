<?php

namespace App\Http\Middleware;

use Closure;
use App\Machine;

class MachineTokenAuth
{
    /**
     * Handle an incoming request.
     * Check if the provided MachineToken header contains a token that matches the machine id from the route.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Find the machine that matches the id and token.
        $machines = Machine::where([
            'id' => (int) $request->route('machineId'),
            'token' => $request->header('MachineToken'),
        ])->limit(1)->get();

        // Return unauthorized if no machine was found.
        if ($machines->isEmpty()) {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}

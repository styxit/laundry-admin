<?php

namespace App\Policies;

use App\Machine;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MachinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the machine.
     *
     * @param  \App\User  $user
     * @param  \App\Machine  $machine
     * @return bool
     */
    public function view(User $user, Machine $machine)
    {
        return $user->id === $machine->user_id;
    }
}

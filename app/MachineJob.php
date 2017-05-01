<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MachineJob extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'completed',
        'duration',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'duration',
    ];

    /**
     * Get the machine that owns the state.
     */
    public function machine()
    {
        return $this->belongsTo('App\Machine');
    }

    /**
     * Get the machine states for a machine.
     */
    public function states()
    {
        return $this->hasMany('App\MachineState');
    }
}

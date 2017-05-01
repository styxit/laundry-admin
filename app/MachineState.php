<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MachineState extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seconds_remaining',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the machine that owns the state.
     */
    public function machine()
    {
        return $this->belongsTo('App\Machine');
    }

    /**
     * Get the job for the state.
     */
    public function job()
    {
        return $this->belongsTo('App\MachineJob', 'machine_job_id');
    }
}

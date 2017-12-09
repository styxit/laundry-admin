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
        return $this->hasMany('App\MachineState')->orderBy('created_at', 'DESC');
    }

    /**
     * Scope a query to only include jobs that are not yet completed.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsActive($query)
    {
        return $query->where('completed', false);
    }
}

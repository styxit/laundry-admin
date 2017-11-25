<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'brand',
        'model',
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
     * Relation to the User that owns the machine.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the machine states for a machine.
     */
    public function states()
    {
        return $this->hasMany('App\MachineState')->orderBy('created_at', 'DESC');
    }

    /**
     * Get the jobs for a machine.
     */
    public function jobs()
    {
        return $this->hasMany('App\MachineJob')->orderBy('created_at', 'DESC');
    }
}

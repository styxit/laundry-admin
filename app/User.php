<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Route notifications for the mail channel.
     *
     * @param Notification $notification The Notification.
     *
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }

    /**
     * Route notifications for the Pushover channel.
     *
     * @return string
     */
    public function routeNotificationForPushover()
    {
        return $this->pushover_user_key;
    }

    /**
     * Relation to the Machines owned by this User.
     */
    public function machines()
    {
        return $this->hasMany('App\Machine');
    }
}

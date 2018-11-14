<?php

namespace App\Http\Controllers;

use App\User;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * View a users details.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        // Get a list of supported timezones.
        $timezones = collect(DateTimeZone::listIdentifiers(DateTimeZone::ALL))->keyBy(function ($value) {
            return $value;
        });

        return view('users.view')->with(compact('timezones'));
    }

    /**
     * Update a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        if ($request->has('pushover_user_key')) {
            $user->pushover_user_key = $request->get('pushover_user_key');
        }
        if ($request->has('timezone')) {
            $user->timezone = $request->get('timezone');
        }

        if ($user->save()) {
            flash('Settings saved.')->success();
        } else {
            flash('Failed to save settings.')->error();
        }

        return redirect()->route('user.view');
    }
}

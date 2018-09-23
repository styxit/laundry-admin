<?php

namespace App\Http\Controllers;

use App\User;
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
        return view('users.view');
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
        $user->pushover_user_key = $request->get('pushover_user_key');

        if ($user->save()) {
            flash('Settings saved.')->success();
        } else {
            flash('Failed to save settings.')->error();
        }

        return redirect()->route('user.view');
    }
}

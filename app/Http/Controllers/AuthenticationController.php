<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function getUser(User $user): User
    {
        return $user;
    }

    public function authenticateUser(Request $request)
    {
        //TODO Request validation
        $user = User::where('email', $request->get('email'))->with('roles')->first();

        if (!empty($user))
        {
            if (!password_verify($request->get('password'), $user->password))
            {
                return response('User/password combination not found', 401);
            }
        }

        return response($user);
    }
}

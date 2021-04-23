<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        //TODO Request validation
        $existingUser = User::where('email', $request->get('email'))->first();

        if (!empty($existingUser))
        {
            return response('User already exists', 409);
        }

        User::create([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'password' => password_hash($request->get('password'), PASSWORD_DEFAULT),
            'vat' => $request->get('vat')
        ]);

        return response('User created', 201);
    }
}

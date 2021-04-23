<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        //TODO Request validation
        $existingUser = User::where('email', $request->input('email'))->first();

        if (!empty($existingUser))
        {
            return response('User already exists', 409);
        }

        User::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'vat' => $request->input('vat')
        ]);

        return response('User created', 201);
    }
}

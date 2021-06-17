<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|max:255',
            'vat' => 'required|unique:users|max:255'
        ]);

        if ($validator->fails()) {
            return response('Validation failed', 422);
        }

        $existingUser = User::where('email', $request->input('email'))->first();

        if (!empty($existingUser))
        {
            return response('User already exists', 409);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'vat' => $request->input('vat')
        ]);

        try {
            Http::post(env('NOTIFICATIONS_URL').'/registrationSuccess', [
                'name' => $user->name . ' ' . $user->surname,
                'to' => $user->email,
            ]);
        } catch (\Exception $e) {}

        return response('User created', 201);
    }
}

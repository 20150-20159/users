<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserByVat(Request $request)
    {
        $user = User::where('vat', $request->get('vat'))->first();

        if (empty($user)) {
            return response('User not found', 400);
        }

        return $user;
    }
}

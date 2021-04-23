<?php

namespace App\Http\Controllers;

use App\Models\User;

class AuthenticationController extends Controller
{
    public function getUser(User $user): User
    {
        return $user;
    }
}

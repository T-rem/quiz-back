<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;

class AuthController extends Controller
{
    public function auth() {
        $user_email = request('email');
        $user = User::where('email', $user_email)->get();

        return ['user_id' => $user->id, "user_name" => $user->name];
    }
}

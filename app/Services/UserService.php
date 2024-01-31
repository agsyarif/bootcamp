<?php

namespace App\Services;

use App\Models\User;

class UserService {

    public function __construct()
    {

    }

    public function createUser($request) {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password_hash,
        ]);
        $user->assignRole($request->role);

        return $user;
    }
}

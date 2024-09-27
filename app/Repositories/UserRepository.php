<?php

namespace App\Repositories;

use App\Models\User;
use Hash;

class UserRepository

{
    public function storeUser(array $data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']) // bcrypt()
        ]);

        return $user;
    }
}

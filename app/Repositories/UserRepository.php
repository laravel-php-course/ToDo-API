<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


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

    public function LoginUser(array $data)
    {
        $user = User::where('email',$data['email'])->first();
        if (!Hash::check($data['password'] , $user->password)){
            return False;
        }else{
       return  $user ;
        }
    }
}

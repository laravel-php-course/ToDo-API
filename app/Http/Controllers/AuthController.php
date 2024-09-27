<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Trait\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct(private UserRepository $userRepository)
    {
    }
    public function register(StoreUserRequest $request)
    {
        $user = $this->userRepository->storeUser($request->all());

        return $this->success('welcome to our apps. you are registered', [
            //TODO send refresh token
            'token' => $user->createToken('user todo token', ['*'], now()->addWeek())->plainTextToken,
            'user'  => $user
        ]);
    }

    //TODO logout
    //TODO refresh token
    //Todo add login
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginRequest;
use App\Repositories\UserRepository;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct(private UserRepository $userRepository)
    {
    }

    public function register(StoreUserRequest $request)
    {
        try {
            $user = $this->userRepository->storeUser($request->all());

            return $this->success('Welcome to our app. You are registered', [
                'token' => $user->createToken('user todo token', ['*'], now()->addWeek())->plainTextToken,
                'user'  => $user
            ]);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                return $this->success('Login successful', [
                    'token' => $user->createToken('user todo token', ['*'], now()->addWeek())->plainTextToken,
                    'user'  => $user
                ]);
            }

            return $this->error('Invalid credentials', 401);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), 500);
        }
    }

    public function logout(Request $request)
    {
        try {

            $request->user()->currentAccessToken()->delete();
            return $this->success('Logout successful');
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), 500);
        }
    }

    public function refreshToken(Request $request)
    {
        try {
            $user = Auth::user();
            $request->user()->currentAccessToken()->delete();
            $token = $user->createToken('user todo token', ['*'], now()->addWeek())->plainTextToken;
            return $this->success('Token refreshed', [
                'token' => $token,
                'user'  => $user
            ]);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Trait\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            'token' => $user->createToken('access_token', ['access-api'], Carbon::now()->addMinutes(config('sanctum.ac_expiration')))->plainTextToken,
            'refresh_token' => $user->createToken('refresh_token',['issue-access-token'] , Carbon::now()->addMinutes(config('sanctum.rt_expiration')))->plainTextToken,
            'user'  => $user
        ]);
    }
    public function login(loginRequest $request)
    {
        $user = $this->userRepository->LoginUser($request->all());

      if ($user !== false) {
          return $this->success('welcome to our apps. you are login', [

              'token' => $user->createToken('user todo token', ['access-api'], Carbon::now()->addMinutes(config('sanctum.ac_expiration')))->plainTextToken,
              'refresh_token' => $user->createToken('refresh_token',['issue-access-token'] , Carbon::now()->addMinutes(config('sanctum.rt_expiration')))->plainTextToken,
              'user'  => $user
        ]); }else{
         return $this->error('رمز عبور غلط است' , 401);
      }
    }

    public function refreshToken(Request $request)
    {
        $accessToken = $request->user()->createToken('access_token', ['access-api'], Carbon::now()->addMinutes(config('sanctum.ac_expiration')));
        return $this->success("Token generated" , $accessToken->plainTextToken);
    }
    public function logOut(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success('شما از حسابتان خارج شدید');
    }

}

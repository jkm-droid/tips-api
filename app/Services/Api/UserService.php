<?php

namespace App\Services\Api;

use App\Exceptions\CustomException;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @param $request
     * @return JsonResponse
     */
    public function registerUser($request)
    {
        if ($request['phone_number'] == null)
            $phone = "no phone_number";
        else
            $phone = $request['phone_number'];

        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'phone_number' => $phone,
            'password' => Hash::make($request['password']),
        ]);

        return response()->json([
            'message' => 'Registered successfully',
            'user' => new UserResource($user)
        ],200);
    }

    /**
     * @return AnonymousResourceCollection
     * @throws CustomException
     */
    public function getAllUsers()
    {
        $users = User::all();
        if ($users->isEmpty())
            throw new CustomException("No users were found", 404);

        return UserResource::collection($users);
    }
    /**
     * @param $loginRequest
     * @return JsonResponse
     */
    public function loginUser($loginRequest)
    {
        $credentials = filter_var($loginRequest['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if(Auth::attempt(array($credentials=>$loginRequest['username'], 'password'=>$loginRequest['password']))){
            $user = User::where('email', $loginRequest['username'])
                ->orWhere('username',$loginRequest['username'])
                ->firstOrFail();

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => "logged in successfully",
                'accessToken' => $token,
                'tokenType' => 'Bearer'
            ], 200);
        }

        return response()->json([
            'message' => 'Login information is invalid.'
        ], 401);
    }

    /**
     * @return JsonResponse
     */
    public function logoutUser(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message'=>'logged out successfully'
        ]);
    }
}

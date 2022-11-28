<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    public function login_customer(LoginRequest $request){
        $validated = $request->validated();
        $check = User::where('email', $validated['email'])->where('role_id', 4)->first();

        if($check == null){
            return $this->apiError('You`re not user customer!', 400);
        }else{
            if(!Auth::attempt($validated)){
                return $this->apiError('Credentials not match', Response::HTTP_UNAUTHORIZED);
            }
            $user = User::where('email', $validated['email'])->first();
            $token = $user->createToken($validated['email'])->plainTextToken;
    
            return $this->apiSuccess([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]);
        }
    }

    public function login_driver(LoginRequest $request){
        $validated = $request->validated();
        $check = User::where('email', $validated['email'])->where('role_id', 3)->first();

        if($check == null){
            return $this->apiError('You`re not user driver!', 400);
        }else{
            if(!Auth::attempt($validated)){
                return $this->apiError('Credentials not match', Response::HTTP_UNAUTHORIZED);
            }
            $user = User::where('email', $validated['email'])->first();
            $token = $user->createToken($validated['email'])->plainTextToken;
    
            return $this->apiSuccess([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]);
        }
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id']
        ]);

        $token = $user->createToken($validated['email'])->plainTextToken;

        return $this->apiSuccess([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    public function logout()
    {
        try{
            auth()->user()->tokens()->delete();
            return $this->apiSuccess('Tokens Revoked');
        } catch(\Throwable $e){
            throw new HttpResponseException($this->apiError(
                null,
                Response::HTTP_INTERNAL_SERVER_ERROR
            ));
        }
    }
}

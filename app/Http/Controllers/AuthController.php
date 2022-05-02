<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param RegisterRequest $request
     * @return \JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type' => $request->type
        ]);
        $token = $user->createToken('Default');
 
        return ['token' => $token->plainTextToken];
    }

    /**
     * Login an existing user.
     *
     * @param LoginRequest $request
     * @return \JsonResponse
     */
    public function login(LoginRequest $request)
    {
        //
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            Auth::user()->tokens()->delete();
            return ['token' => Auth::user()->createToken('Default')->plainTextToken];
        }
    }
}

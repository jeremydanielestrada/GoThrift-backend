<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthService{


    public function login(array $credentials){

       $user = User::where('email', $credentials['email'])->first();

       if(!$user || !Hash::check($credentials['password'], $user->password)){
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ]);
    }

    return[
        'user'=> $user,
        'token' => $user->createToken('auth')->plainTextToken,
    ];

    }


    public function register(array $credentials){

        $credentials['password'] = Hash::make($credentials['password']);

        $user =  User::Create($credentials);



        return [
            'user' => $user,
            'token' => $user->createToken($user['name'])->plainTextToken,
        ];
    }


    public function logout($user){

        $user->tokens()->delete();

        return [
            "message" => "User logged out successfully"
        ];
    }
}

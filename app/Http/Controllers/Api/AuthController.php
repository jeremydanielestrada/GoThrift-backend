<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Services\AuthService;
class AuthController extends Controller
{


    public function __construct(private AuthService $authService) {}

    public function login(UserRequest $request)
    {
        $data = $request->validated();

        return response()->json($this->authService->login($data));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register(UserRequest $request)
    {
        $data =  $request->validated();

        return response()->json($this->authService->register($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function logout(Request $request)
    {
        return $this->authService->logout($request->user());
    }


}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\{LoginRequest, RegisterRequest};
use App\Models\User;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * Register new user
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return response()->json(["user" => $user]);
    }

    /**
     * Login user
     * 
     * @param LoginRequest $request
     * 
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            return response()->json(["user" => auth()->user()]);
        }
    }
}

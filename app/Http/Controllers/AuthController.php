<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Responses\ApiResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /**
     * Admin creates user
     *
     * @param Request $request
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    function register(Request $request): Response
    {
        $this->validate($request, [
            "email" => "required|unique:users,email",
            "password" => "required|string"
        ]);
        return User::register($request);
    }

    /**
     * returns jwt token of user with email and password
     *
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|string',
        ]);

        Auth::factory()->setTTL(3600);
        $credentials = $request->only(['email', 'password']);
        if (!$token = Auth::attempt($credentials)) {
            return "token is invalid";
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(): Response
    {
        auth()->logout();
        return ApiResponses::successResponse(null,"Logout success",200);
    }
}

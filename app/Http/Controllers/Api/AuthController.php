<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Repositries\AuthRepository;


class AuthController extends Controller
{
    protected $authRepository;
    /**
     * Create a new AuthController instance.
     *
     * @param  \App\Repositories\AuthRepository  $authRepository
     * @return void
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * Handle user login.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \App\Http\Resources\AuthResource|null
     */

    public function login(LoginRequest $request)
    {
        // Call auth_login method from repository to handle user login
        $user = $this->authRepository->auth_login($request->only('email', 'password'));

        // Return resource if login is successful
        if ($user) {
            return new AuthResource(auth()->user());
        }
    }
}

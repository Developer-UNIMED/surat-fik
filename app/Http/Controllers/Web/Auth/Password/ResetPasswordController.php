<?php

namespace App\Http\Controllers\Web\Auth\Password;

use App\Http\Requests\Auth\Password\ResetPasswordRequest;
use App\Services\AuthenticationService;
use Illuminate\Cache\RateLimiter;
use Illuminate\Validation\ValidationException;

class ResetPasswordController
{
    public function __construct(private readonly AuthenticationService $authService)
    {
    }

    public function index()
    {
        return view('auth.password.reset');
    }

    public function store(ResetPasswordRequest $request)
    {
        try {
            $request->ensureIsNotRateLimited();
            $form = $request->validated();
            $status = $this->authService->resetPassword(
                email: $form['email'], password: $form['password'], token: $form['token']
            );
        } catch (ValidationException $e) {
            RateLimiter::hit($request->throttleKey());
            throw $e;
        }
        return redirect()->route('login')->with('status', __($status));
    }
}

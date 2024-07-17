<?php

namespace App\Http\Controllers\Web\Auth\Password;

use App\Http\Requests\Auth\Password\ForgotPasswordRequest;
use App\Services\AuthenticationService;
use Illuminate\Support\Facades\RateLimiter;

class ForgotPasswordController
{
    public function __construct(private readonly AuthenticationService $authService)
    {
    }

    public function index()
    {
        return view('auth.password.forgot');
    }

    public function store(ForgotPasswordRequest $request)
    {
        $request->ensureIsNotRateLimited();
        $form = $request->validated();

        $status = $this->authService->sendResetPasswordLink($form->only('email'));

        RateLimiter::hit($request->throttleKey());
        return back()->with(['status' => __($status)]);
    }
}

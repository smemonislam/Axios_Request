<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminEmailVerificationRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(AdminEmailVerificationRequest $request): RedirectResponse
    {

        if ($request->user('admin')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME . '?verified=1');
        }

        if ($request->user('admin')->markEmailAsVerified()) {
            //event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::ADMIN_HOME . '?verified=1');
    }
}

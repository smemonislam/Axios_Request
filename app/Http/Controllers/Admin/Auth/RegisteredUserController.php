<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Events\AdminEmailVerificationEvent;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {

        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['string'],
        ]);

        $admin = Admin::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'terms' => $request->terms
        ]);

        event(new AdminEmailVerificationEvent($admin));

        Auth::guard('admin')->login($admin);

        return redirect(RouteServiceProvider::ADMIN_HOME);
    }
}

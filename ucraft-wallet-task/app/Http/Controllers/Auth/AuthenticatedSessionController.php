<?php

namespace App\Http\Controllers\Auth;

use App\Common\AuthManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->back(302, [], RouteServiceProvider::HOME);
    }

    public function destroy(): RedirectResponse
    {
        app(AuthManager::class)->logout();

        return redirect(RouteServiceProvider::HOME);
    }
}

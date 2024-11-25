<?php

namespace App\Traits;

use App\Common\AuthManager;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Livewire\Redirector;

trait CanLogOut
{
    public function logout(): RedirectResponse|Redirector
    {
        app(AuthManager::class)->logout();

        return redirect()->to(RouteServiceProvider::HOME);
    }
}

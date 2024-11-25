<?php

namespace App\Http\Controllers\Auth;

use App\Common\AuthManager;
use App\Common\Exception\SocialiteEmailMissingException;
use App\Events\RegisteredThroughSocial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController
{
    public function __construct(private AuthManager $authManager) {}

    public function redirect(string $driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function callback(string $driver): RedirectResponse
    {
        if (request('error')) {
            return redirect('/');
        }

        /** @var \Laravel\Socialite\Two\User $socialiteUser */
        $socialiteUser = Socialite::driver($driver)->user();

        try {
            $user = $this->authManager->getUserFromSocialite($socialiteUser, $driver);
        } catch (SocialiteEmailMissingException) {
            return redirect()->route('register')->withErrors([
                'email' => 'Must provide access to the email address.',
            ]);
        }

        if ($user->wasRecentlyCreated) {
            event(new RegisteredThroughSocial($user));
        }

        Auth::login($user);

        return redirect('/');
    }
}

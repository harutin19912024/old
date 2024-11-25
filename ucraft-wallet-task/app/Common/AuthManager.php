<?php

namespace App\Common;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Laravel\Socialite\Two\User as SocialiateUser;

class AuthManager
{
    public function getUserFromSocialite(SocialiateUser $socialiteUser, string $type): User
    {
        // $socialiteUser->email = null;
        $this->validateType($type);

        $user = $this->findOrCreateUserFromSocialite($socialiteUser, $type);

        if (!$user->exists) {
            $user->fill(['name' => $socialiteUser->getName()]);

            // User can subscribe to newsletter on the register page, prior to clicking on social login.
            if (Cookie::get(Cookies::SUBSCRIBED_TO_NEWSLETTER_AFTER_REGISTRATION)) {
                $user->subscribed_to_newsletter = true;

                Cookie::queue(Cookie::forget(Cookies::SUBSCRIBED_TO_NEWSLETTER_AFTER_REGISTRATION));
            }

            // If we received email from social provider, save it and treat as verified.
            if ($socialiteUser->email) {
                $user->email = $socialiteUser->email;
                $user->markEmailAsVerified();
            }
        } elseif ($socialiteUser->email === $user->email) {
            $user->markEmailAsVerified();
        }

        $user->save();

        $avatar = $user->getFirstMedia('avatar');
        if (!$avatar) {
            $mediaName = Str::slug($socialiteUser->getName());

            $user->addMediaFromUrl($this->getAvatarUrl($socialiteUser))
                ->setName($mediaName)
                ->setFileName("{$mediaName}.jpg")
                ->toMediaCollection('avatar');
        }

        return $user;
    }

    public function login(User $user): void
    {
        Auth::guard('web')->login($user);
        session()->regenerate();
    }

    public function logout(): void
    {
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();
    }

    private function findOrCreateUserFromSocialite(SocialiateUser $socialiteUser, string $type): User
    {
        // First, try searching by external ID, because sometimes the email is not available, when using Facebook.
        $user = User::where($type . '_id', $socialiteUser->id)->first();

        // Secondly, try searching by email, if user first registered through, for example, Facebook, and
        // then tried to login through Google.
        $user ??= User::where('email', $socialiteUser->email)->first();

        // Lastly, create a new user, if none was found.
        $user ??= User::make([
            "{$type}_id" => $socialiteUser->id,
        ]);

        return $user;
    }

    private function getAvatarUrl(SocialiateUser $socialiteUser): string
    {
        $url = data_get($socialiteUser, 'avatar_original');

        if (str_contains($url, 'facebook.com/')) {
            $url .= "&access_token={$socialiteUser->token}";
        }

        return $url;
    }

    private function validateType(string $type): void
    {
        if (!in_array($type, ['google', 'facebook'])) {
            throw new InvalidArgumentException("Invalid socialiate provider: {$type}");
        }
    }
}

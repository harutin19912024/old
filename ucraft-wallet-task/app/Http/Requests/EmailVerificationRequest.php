<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmailVerificationRequest extends \Illuminate\Foundation\Auth\EmailVerificationRequest
{
    public function authorize(): bool
    {
        if (Auth::check()) {
            return parent::authorize();
        }

        if (!hash_equals((string) $this->route('hash'), sha1($this->findUser()->getEmailForVerification()))) {
            return false;
        }

        return true;
    }

    public function findUser(): User
    {
        return User::findOrFail($this->route('id'));
    }
}

<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait GetsUser
{
    private static function user(): ?User
    {
        return Auth::user();
    }
}

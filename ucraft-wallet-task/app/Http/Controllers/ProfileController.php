<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('account.profile.main-information');
    }
}

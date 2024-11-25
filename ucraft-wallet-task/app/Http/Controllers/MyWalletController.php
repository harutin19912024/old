<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;

class MyWalletController extends Controller
{
    public function index(): View
    {
        return view('account.profile.my-wallets');
    }
}

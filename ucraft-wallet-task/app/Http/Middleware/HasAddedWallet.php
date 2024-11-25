<?php

namespace App\Http\Middleware;

use App\Common\Constants\Currency;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasAddedWallet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!in_array($request->path(), [ 'add-wallet', 'livewire/message/add-wallet-page', 'logout', '/']) && $user &&
            !( $user->hasWallet(Currency::WALLET_USD_CURRENCY)
                || $user->hasWallet(Currency::WALLET_EUR_CURRENCY)
                || $user->hasWallet(Currency::WALLET_AMD_CURRENCY))) {
            return redirect('add-wallet');
        }
        return $next($request);
    }
}

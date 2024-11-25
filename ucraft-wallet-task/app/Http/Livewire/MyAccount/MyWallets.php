<?php

namespace App\Http\Livewire\MyAccount;

use App\Forms\Components\NoticeField;
use App\Services\CastService;
use Closure;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/** @property ComponentContainer $form */
class MyWallets extends Component implements HasForms
{
    use InteractsWithForms;

    public array $wallets = [];

    public function mount(CastService $castService): void
    {
        $wallets = user()->wallets;

        foreach($wallets as $wallet){
            $wallet = $castService->getWallet($wallet);
            $this->wallets[] = $wallet;
        }
    }

    public function render(): View
    {
        return view('livewire.my-account.my-wallets', ['wallets' => $this->wallets]);
    }

}

<?php

namespace App\Http\Livewire\MyAccount;

use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/** @property ComponentContainer $form */
class ProductDetailsBlock extends Component implements HasForms
{
    use InteractsWithForms;


    public function render(): View
    {
        return view('livewire.my-account.product-details-block');
    }

}

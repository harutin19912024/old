<?php

namespace App\Http\Livewire\MyAccount;

use App\Common\Constants\Currency;
use App\Common\Constants\UserType;
use App\Common\Constants\WalletType;
use App\Http\Livewire\Modals\FirstWalletAddedModal;
use App\Interfaces\UuidFactoryService;
use App\Repository\WalletRepository;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

/**
 * @property ComponentContainer $form
 */
class AddWalletPage extends Component implements HasForms
{
    use InteractsWithForms;

    public ?string $name = null;

    public ?string $type = null;

    public ?string $uuid = null;

    public ?string $description = null;

    public ?string $meta = null;

    public ?float $balance = null;

    public ?string $currency = null;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function render(): View
    {
        return view('livewire.my-account.add-wallet-page');
    }

    public function saveWallet(WalletRepository $walletRepository, UuidFactoryService $uuidFactoryService): void
    {
        $this->validate();

        $this->meta = json_encode(['currency' => $this->currency]);

        $walletRepository->create([
            'users_type' => UserType::INDIVIDUAL,
            'users_id' => Auth::user()->id,
            'name' => $this->name,
            'type' => $this->type,
            'uuid' => $uuidFactoryService->uuid4(),
            'slug' => $this->currency,
            'description' => $this->description,
            'meta' => $this->meta,
            'balance' => $this->balance,
            'decimal_places' => 0.5
        ]);

        $this->emit('openModal', FirstWalletAddedModal::getName());
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->label('Wallet Name')
                ->required()
                ->minLength(3)
                ->maxLength(255),
            Select::make('type')->options(WalletType::getWalletTypes())
                ->required()
                ->label('Wallet Type'),
            Select::make('currency')->options(Currency::getCurrencies())
                ->required()
                ->label('Wallet Currency'),
            Textarea::make('description')
                ->label('Description')
                ->maxLength(1000),
            TextInput::make('balance')
                ->required()
                ->label('Balance')
                ->maxLength(255),
        ];
    }
}

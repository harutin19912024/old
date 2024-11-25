<div>
    @if(session('flash_notification', collect())->pluck('type')->contains('url_expired'))
        <div class="text-center pt-10 pb-6">
            <p>
                {{ session('flash_notification', collect())->firstWhere('type', 'url_expired')->message }}
            </p>

            <x-button
                onclick="Livewire.emit('openModal', '{{ App\Http\Livewire\Modals\ForgotPasswordModal::getName() }}', {{ json_encode(['email' => request('email')]) }})"
                primary
                medium
                class="mt-4"
            >
                Gauti naują slaptažodžio atkūrimo nuorodą
            </x-button>
        </div>
    @else
        <x-notifications/>

        <form wire:submit.prevent="submit">
            {{ $this->form }}

            <x-button primary medium icon-right="arrow-right">
                Reset
            </x-button>
        </form>
    @endif
</div>

<form
    wire:submit.prevent="saveWallet"
    class="w-full max-w-[380px]"
>
    <div class="mb-5 text-left">
        {{ $this->form }}
    </div>

    <div class="mt-7 flex items-center justify-center">
        <x-button
            primary
            medium
            icon-right="arrow-right"
            class="w-full max-w-[380px]"
        >
            Add
        </x-button>
    </div>
</form>

<div class="flex flex-col items-center justify-center">
    <x-close-livewire-modal-button />

    <h4 class="md:text-heading-h4 text-heading-h5 text-center">
        Change the password
    </h4>

    <div class="flex flex-col px-3 py-5 md:px-[80px] md:py-10">
        <form
            wire:submit.prevent="submit"
            class="w-full max-w-[380px] self-center"
        >
            {{ $this->form }}

            <div class="mt-9 flex flex-col items-center justify-center">
                <x-button
                    primary
                    medium
                    icon-right="arrow-right"
                    class="w-full justify-center"
                >
                    Send
                </x-button>
            </div>
        </form>
    </div>
</div>

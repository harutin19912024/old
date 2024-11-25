<div class="flex flex-col items-center justify-center">
    <x-close-livewire-modal-button />

    <h4 class="md:text-heading-h4 text-heading-h5 text-center">Sign in to your account</h4>

    <div class="flex flex-col px-3 py-5 md:px-[80px] md:py-10">
        <x-social-login-buttons />
        <div class="bg-disabled-text relative my-8 flex h-[1px] w-full justify-center">
            <h6 class="text-disabled-text font-primary bg-secondary-white absolute top-[-10px] px-10">arba</h6>
        </div>

        <form wire:submit.prevent="authenticate">
            {{ $this->form }}

            <div class="mt-10 flex flex-col items-center justify-center">
                <x-button
                    primary
                    medium
                    icon-right="arrow-right"
                    class="w-full justify-center"
                >
                    Login
                </x-button>

                <a
                    onclick="Livewire.emit('openModal', '{{ App\Http\Livewire\Modals\ForgotPasswordModal::getName() }}')"
                    class="text-helper-text text-cta-text mt-3 cursor-pointer self-end"
                >
                    Forgot your password
                </a>
            </div>

            <div class="mt-6 flex justify-center">
                <p class="md:text-heading-h6 text-subtitle-1 mr-1 font-medium md:font-normal">You do not have an account?</p>
                <a
                    href="{{ route('register') }}"
                    class="md:text-heading-h6 font-primary text-cta-text cursor-pointer font-medium md:font-normal"
                >Registration</a>EYour email address has been successfully changedPassword
            </div>
        </form>
    </div>
</div>

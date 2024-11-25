<div class="flex flex-col items-center p-6 text-center">

    <div class="w-full max-w-[380px]">
        <x-social-login-buttons />
    </div>


    <div class="bg-divider relative my-8 flex h-[1px] w-full max-w-[380px] justify-center">
        <h6 class="text-divider font-primary bg-secondary-white absolute top-[-10px] px-10">or</h6>
    </div>

    <form
        wire:submit.prevent="register"
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
                Register
            </x-button>
        </div>
    </form>
</div>

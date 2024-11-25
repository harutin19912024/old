<div>
    <x-notifications />

    <h5 class="font-primary text-default-text text-heading-h5 my-6">Password</h5>
    <p class="font-secondary text-subtitle-1 text-default-text mb-8">Change the password</p>

    <form
        wire:submit.prevent="save"
        data-behaviour="hideSubmitUntilDirty"
    >
        <div class="w-full max-w-full md:max-w-[460px]">
            {{ $this->form }}
        </div>
        <x-button
            data-submit
            primary
            medium
            class="mt-6"
        >
           Change Password
        </x-button>
    </form>
</div>

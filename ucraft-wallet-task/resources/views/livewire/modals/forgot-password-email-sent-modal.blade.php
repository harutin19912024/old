<div class="flex flex-col items-center text-center">
    <x-notifications />

    <x-close-livewire-modal-button />

    <div class="flex flex-col items-center px-0 pb-0 pt-3 text-center md:px-6 md:pb-6">
        <h4 class="md:text-heading-h4 text-heading-h5 mb-3 text-center">
            Link sent
        </h4>

        <p class="text-subtitle-2 mb-2 text-center">
            Check your e-mail and click on the received link for password change instructions.
        </p>

        <div class="">
            <span class="text-subtitle-2 text-center">Didn't receive the email link?</span>
            <a
                wire:click="resend"
                class="text-subtitle-2 text-cta-text cursor-pointer"
            >Resend</a>
        </div>
    </div>
</div>

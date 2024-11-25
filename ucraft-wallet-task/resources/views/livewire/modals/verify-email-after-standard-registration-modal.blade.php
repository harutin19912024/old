<div class="flex flex-col items-center p-0 md:p-6" style="margin-top: 40px">
    <x-notifications />

    <h4 class="md:text-heading-h4 text-heading-h5 font-primary mb-3 text-center">
        Your form is created!
    </h4>

    <p class="text-subtitle-1 font-secondary mb-3 text-center font-medium">
        Confirm your email
    </p>

    <p class="text-subtitle-2 font-secondary mb-2 text-center">
        Check your email address where you should have received the confirmation email with the link and yes
        complete registration.
    </p>

    <p class="text-subtitle-2 text-error-text font-secondary mb-4 text-center">
        If you haven't verified your e-mail email, you will not be able to sign in to your account.
    </p>

    <div>
        <span class="text-subtitle-2 text-center">Didn't get email?</span>
        <a
            wire:click="resend"
            class="text-subtitle-2 text-cta-text cursor-pointer"
        >Resend</a>
    </div>

</div>

<div class="flex flharut.soghomonyan@gmail.comex-col items-center p-0 text-center md:p-6">
    <x-notifications />

    <h4 class="md:text-heading-h4 text-heading-h5 mb-3 text-center">
        Link sent
    </h4>

    <p class="text-subtitle-2 mb-2 text-center">
        Check your e-mail address and click the link you received.
    </p>

    <p class="text-subtitle-2 text-error-text font-secondary mb-4 text-center">
        After confirming your e-mail email, you will not be able to sign in to your account.
    </p>

    <div>
        <span class="text-subtitle-2 text-center">Didn't receive the email link?</span>
        <a
            wire:click="resend"
            class="text-subtitle-2 text-cta-text cursor-pointer"
        >Resend</a>
    </div>

</div>

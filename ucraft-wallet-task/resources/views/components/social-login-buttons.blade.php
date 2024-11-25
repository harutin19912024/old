<div class="social-login-buttons flex w-full flex-col items-center justify-center">
    <a
        href="{{ route('oauth.redirect', ['facebook']) }}"
        class="bg-facebook-blue mb-5 flex w-full rounded-[10px] p-4"
    >
        <x-icon
            name="facebook"
            class="text-secondary-white mr-4"
        />
        <p class="text-secondary-white md:text-heading-h6 text-button-l">Registration via Facebook</p>
    </a>
    <a
        href="{{ route('oauth.redirect', ['google']) }}"
        class="social-login-buttons__google-login-button bg-secondary-white flex w-full rounded-[10px] p-4"
    >
        <x-icon
            name="google"
            class="mr-4"
        />
        <p class="md:text-heading-h6 text-button-l text-[#6A718D]">Registration via Google</p>
    </a>
</div>

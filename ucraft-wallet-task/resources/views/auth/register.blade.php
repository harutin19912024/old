<x-app-layout>
    <x-temporary.auth-card>
        <x-slot name="logo">
            Register
        </x-slot>

        <x-social-login-buttons/>

        <!-- Validation Errors -->
        <x-temporary.auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-temporary.label for="name" :value="__('Name')" />

                <x-temporary.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-temporary.label for="email" :value="__('Email')" />

                <x-temporary.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-temporary.label for="password" :value="__('Password')" />

                <x-temporary.input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-temporary.label for="password_confirmation" :value="__('Confirm Password')" />

                <x-temporary.input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-temporary.buttonn class="ml-4">
                    {{ __('Register') }}
                </x-temporary.buttonn>
            </div>
        </form>
    </x-temporary.auth-card>
</x-app-layout>

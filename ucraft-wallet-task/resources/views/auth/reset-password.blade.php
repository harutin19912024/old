<x-app-layout>
    <x-temporary.auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-temporary.application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-temporary.auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-temporary.label for="email" :value="__('Email')" />

                <x-temporary.label id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-temporary.label for="password" :value="__('Password')" />

                <x-temporary.label id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-temporary.label for="password_confirmation" :value="__('Confirm Password')" />

                <x-temporary.label id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-temporary.auth-card>
</x-app-layout>

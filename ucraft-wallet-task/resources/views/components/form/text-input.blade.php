@php
    $hasErrors = $errors->has($getStatePath());

    if ($isPassword() && !method_exists($field, 'shouldShowRevealButton')) {
        throw new RuntimeException('Use PasswordInput::class instead of TextInput::class for password fields.');
    }
@endphp

<div
    x-data="{ show: false }"
    class="input-field mb-4 flex flex-col items-center justify-center"
>
    <div class="input-field__text-field relative w-full">
        @if ($isPassword() && $shouldShowRevealButton())
            <button
                type="button"
                class="absolute right-2 top-2 cursor-pointer"
                @click="show = !show"
            >
                <x-icon
                    x-show="!show"
                    name="eye"
                    class="text-default-text"
                />
                <x-icon
                    x-show="show"
                    name="eye-slash"
                    class="text-default-text"
                />

            </button>
        @endif

        <input
            {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
            id="{{ $getId() }}"
            :type="show ? 'text' : '{{ $getType() }}'"
            name="{{ $getName() }}"
            placeholder="{{ $getPlaceholder() ?: ' ' }}"
            {!! $isRequired() ? 'required="required"' : '' !!}
            {!! $isAutofocused() ? 'autofocus' : null !!}
            {!! $isDisabled() ? 'disabled' : null !!}
            {!! ($autocomplete = $getAutocomplete()) ? "autocomplete=\"{$autocomplete}\"" : null !!}
            @class([
                'rounded-lg py-2 px-3 text-default-text border border-input outline-0 text-body-1 w-full',
                'border-error' => $hasErrors,
            ])
        >

        <label @class([
            'text-input absolute text-overline px-[0.3rem] mx-[0.5rem] bg-secondary-white left-0 top-[50%]',
            'text-error' => $hasErrors,
        ])>
            {{ $getLabel() }}
        </label>
    </div>

    @if ($hasErrors)
        <p class="text-overline text-error mt-1 self-start pl-2">
            {{ $errors->first($getStatePath()) }}
        </p>
    @endif
</div>

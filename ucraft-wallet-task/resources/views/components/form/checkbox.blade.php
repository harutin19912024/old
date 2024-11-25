<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
    class="checkbox-input"
>
    @if ($isInline())
        <x-slot name="labelPrefix">
    @endif
    <input
        {!! $isAutofocused() ? 'autofocus' : null !!}
        {!! $isDisabled() ? 'disabled' : null !!}
        id="{{ $getId() }}"
        type="checkbox"
        {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
        dusk="filament.forms.{{ $getStatePath() }}"
        @if (!$isConcealed()) {!! $isRequired() ? 'required' : null !!} @endif
        {{ $attributes->merge($getExtraAttributes())->merge($getExtraInputAttributeBag()->getAttributes())->class([
                'border-input mr-2 h-5 w-5 rounded-[2px] border-[2px] checked:bg-[#24292E]',
                'dark:bg-gray-700 dark:checked:bg-primary-500' => config('forms.dark_mode'),
                'border-gray-300' => !$errors->has($getStatePath()),
                'dark:border-gray-600' => !$errors->has($getStatePath()) && config('forms.dark_mode'),
                'border-danger-300 ring-danger-500' => $errors->has($getStatePath()),
            ]) }}
    />
    @if ($isInline())
        </x-slot>
    @endif
</x-dynamic-component>

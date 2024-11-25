@php
    $hasErrors = $errors->has($getStatePath());
@endphp

<div class="input-field">
    <select
        {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
        id="{{ $getId() }}"
        {!! $isDisabled() ? 'disabled' : null !!}
        {!! $isMultiple() ? 'multiple' : null !!}
        {!! $isRequired() ? 'required' : null !!}
        @class([
            'block w-full',
        ])
    >
        @unless ($isPlaceholderSelectionDisabled())
            <option value="">{{ $getPlaceholder() }}</option>
        @endif

        @foreach ($getOptions() as $value => $label)
            <option
                value="{{ $value }}"
                {!! $isOptionDisabled($value, $label) ? 'disabled' : null !!}
            >
                {{ $label }}
            </option>
        @endforeach
    </select>

    <label
        @class([
            'text-input',
            'text-error' => $hasErrors,
        ])
    >
        {{ $getLabel() }}
    </label>

    @if ($hasErrors)
        <p class="self-start text-overline mt-1 pl-2 text-error">
            {{ $errors->first($getStatePath()) }}
        </p>
    @endif
</div>

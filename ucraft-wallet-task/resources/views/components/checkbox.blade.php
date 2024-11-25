@props([
    'id' => null,
    'name' => null,
    'value' => null,
    'label' => null,
    'large' => null,
    'small' => null,
])

<div class='group flex items-start'>
    <input
        {{ $attributes->except('class') }}
        @class([
            'h-[17px] w-[17px]' => $small,
            'h-5 w-5' => $large,
            'border-input mr-3 rounded-[2px] border-[2px] checked:bg-checked-input checked:hover:bg-input hover:border-cta-text disabled:border-disabled-button disabled:checked:bg-disabled-button',
        ])
        type="checkbox"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
    >
    <label
        for="{{ $id }}"
        @class([
            'text-body-2' => $small,
            'text-body-1' => $large,
            'text-disabled-text' => $attributes->get('disabled'),
            'text-default-text font-secondary',
        ])
    >{{ $label }}</label>
</div>

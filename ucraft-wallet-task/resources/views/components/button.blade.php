{{-- blade-formatter-disable --}}
@props([
    'href' => null,
    'primary' => null,
    'secondary' => null,
    'tertiary' => null,
    'small' => null,
    'medium' => null,
    'large' => null,
    'iconLeft' => null,
    'iconRight' => null,
    'iconClass' => null,
])

@php
    $iconClasses = [
        'fill-secondary-white group-hover:fill-secondary-white group-disabled:fill-secondary-white group-disabled:group-hover:fill-secondary-white' => $primary,
        'fill-primary group-hover:fill-primary group-disabled:fill-disabled-text' => $secondary,
        'fill-primary' => $tertiary,
        'w-4 h-4' => $small,
        'w-6 h-6' => $medium,
        'w-10 h-10' => $large,
        'ml-2' => $iconRight,
        'mr-2' => $iconLeft,
        $iconClass,
    ];

    $tag = $href ? 'a' : 'button';
@endphp
{{-- blade-formatter-enable --}}
<{{ $tag }}
    {!! $href ? 'href="' . $href . '"' : '' !!}
    {{ $attributes->except('class') }}
    @class([
        'primary-button text-secondary-white rounded-lg' => $primary,
        'secondary-button text-default-text border-2 border-primary rounded-lg' => $secondary,
        'tertiary-button text-default-text border-b-2 border-transparent hover:border-primary' => $tertiary,
        'px-9 py-2 text-button-l' => $large,
        'px-9 py-1.5 text-button-m' => $medium,
        'px-2.5 py-1 text-button-s' => $small,
        'group inline-flex justify-center items-center font-primary font-medium box-border',
        $attributes->get('class'),
    ])
>
    @if ($iconLeft)
        <x-icon
            :name="$iconLeft"
            class="{{ Arr::toCssClasses($iconClasses) }}"
            defer
        />
    @endif

    {{ $slot }}

    @if ($iconRight)
        <x-icon
            :name="$iconRight"
            class="{{ Arr::toCssClasses($iconClasses) }}"
            defer
        />
    @endif
    </{{ $tag }}>

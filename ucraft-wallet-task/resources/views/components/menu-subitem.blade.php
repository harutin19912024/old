@props([
    'href' => null,
    'iconName' => null,
    'isProfileNotCompleted' => null,
])

<a
    href="{{ $href }}"
    {{ $attributes->except('class') }}
    @class([
        'menu-subitem flex items-center mb-5 group cursor-pointer',
        $attributes->get('class'),
    ])
>

    @if ($iconName)
        <x-icon
            :name="$iconName"
            class="fill-disabled-text text-disabled-text mr-3"
        />
    @endif

    <p class="font-primary text-subtitle-1 font-medium">
        {{ $slot }}
    </p>

    <x-icon
        name="arrow-right"
        class="menu-subitem__menu-icon fill-primary ml-3"
    />
</a>

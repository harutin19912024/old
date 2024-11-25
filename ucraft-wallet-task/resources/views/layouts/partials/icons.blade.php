{{-- If icons are rendered during AJAX call, they are not available in the parent document, therefore must be pre-rendered here. --}}
@php
    $ensureRendered = [
        'bookmark',
        'bookmark-filled',
        'arrow-right',
        // 'arrow-left',
    ];
@endphp

<div class="hidden">
    @foreach($ensureRendered as $name)
        <x-icon :name="$name" defer/>
    @endforeach
</div>

<svg hidden class="hidden">
    @stack('bladeicons')
</svg>

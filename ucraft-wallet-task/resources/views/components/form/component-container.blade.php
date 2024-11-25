<div class="filament-forms-component-container">
    @foreach ($getComponents(withHidden: true) as $formComponent)
        @php
            /**
            * Instead of only rendering the hidden components, we should
            * render the `<div>` wrappers for all fields, regardless of
            * if they are hidden or not. This is to solve Livewire DOM
            * diffing issues.
            *
            * Additionally, any `<div>` elements that wrap hidden
            * components need to have `class="hidden"`, so that they
            * don't consume grid space.
            */
            $isVisible = ! $formComponent->isHidden();
        @endphp

        <div
            @if ($isVisible)
                @class([
                    ($maxWidth = $formComponent->getMaxWidth()) ? match ($maxWidth) {
                        'xs' => 'max-w-xs',
                        'sm' => 'max-w-sm',
                        'md' => 'max-w-md',
                        'lg' => 'max-w-lg',
                        'xl' => 'max-w-xl',
                        '2xl' => 'max-w-2xl',
                        '3xl' => 'max-w-3xl',
                        '4xl' => 'max-w-4xl',
                        '5xl' => 'max-w-5xl',
                        '6xl' => 'max-w-6xl',
                        '7xl' => 'max-w-7xl',
                        default => $maxWidth,
                    } : null,
                ])
            @else
                class="hidden"
            @endif
        >
            @if ($isVisible)
                {{ $formComponent }}
            @endif
        </div>
    @endforeach
</div>

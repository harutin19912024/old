<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.head')
</head>

<body class="{{ $bodyClass ?? '' }} antialiased">
    <x-header />

    <main>
        <!-- start: main -->
        {{ $slot }}
        <!-- end: main -->
    </main>

    <x-footer />

    @include('layouts.partials.footer-scripts')
    @include('layouts.partials.icons')

    @if (isset($openLivewireModal))
        <div x-init="Livewire.emit('openModal', '{{ $openLivewireModal }}')"></div>
    @endif

    <div class="fixed right-0 bottom-0 flex gap-x-1">
        <a
            href="/design"
            class="flex items-center rounded-tl p-2 opacity-50 duration-200 hover:bg-white hover:opacity-100"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                />
            </svg>

            Design components
        </a>
    </div>
</body>

</html>

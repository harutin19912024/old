{{-- Load uploaded logo if it exists, otherwise, fall back to Home logo --}}
@if ($src)
    <img
        {{ $attributes }}
        src="{{ $src }}"
    >
@else
    <img
        {{ $attributes }}
        src="{{ asset('static-images/logo.svg') }}"
    >
@endif

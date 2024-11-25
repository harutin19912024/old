<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500&family=Poppins:wght@400;500&display=swap" rel="stylesheet">

<style>
    [x-cloak] {
        display: none !important;
    }

    :root {
        --primary-color: "red";
    }
</style>

{{-- TODO: temporary --}}
{{--@vite(['vendor/filament/filament/dist/app.js'])--}}
{{--@vite(['vendor/filament/filament/dist/app.css'])--}}
{{-- /TODO: temporary --}}

@vite(['resources/css/app.css', 'resources/css/plugins/cookieconsent.css'])
{{--<link rel="stylesheet" href="{{ mix('css/app.css') }}">--}}
<link rel="stylesheet" href="{{ asset('static-css/tippy.css') }}" />
@livewireStyles

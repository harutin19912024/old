@livewireScripts
@livewire('livewire-ui-modal')
{{--<script src="{{ mix('js/app.js') }}" defer></script>--}}
@vite(['resources/js/app.js', 'resources/js/cookieconsent.js', 'resources/js/cookieconsent-init.js'])
@stack('scripts')

<script type="text/plain" data-cookiecategory="analytics">
    console.log('example analytics script');
</script>

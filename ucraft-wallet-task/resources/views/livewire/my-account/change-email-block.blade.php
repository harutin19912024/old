<div>
    <x-notifications />

    <form>
        <div class="w-full max-w-full md:max-w-[460px]">
            {{ $this->form }}
        </div>
        @if ($this->expanded)
            <x-button
                wire:click.prevent="save"
                primary
                medium
                class="mt-3"
            >Patvirtinti ir keisti</x-button>
        @else
            <x-button
                wire:click.prevent="$set('expanded', true)"
                primary
                medium
                class="mt-3"
            >Keisti el. pašto adresą</x-button>
        @endif
    </form>
</div>

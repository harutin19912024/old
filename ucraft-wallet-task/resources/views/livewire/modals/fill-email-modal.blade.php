<div class="flex flex-col items-center justify-center p-0 md:p-6">
    <h4 class="md:text-heading-h4 text-heading-h5 font-primary mb-3 text-center">
        Pateikite savo elektroninį paštą
    </h4>

    <p class="text-subtitle-2 font-secondary mb-6 text-center">
        Įveskite savo el. pašto adresą. Jums išsiųsime laišką su nuoroda, kuria galėsite užbaigti savo registraciją.
    </p>

    <form
        wire:submit.prevent="save"
        class="w-full max-w-[380px] flex-col"
    >
        {{ $this->form }}

        <x-button
            primary
            medium
            icon-right="arrow-right"
            class="mt-6 flex w-full justify-center"
        >
            Siųsti nuorodą
        </x-button>
    </form>
</div>

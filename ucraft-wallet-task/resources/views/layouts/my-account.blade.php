<x-app-layout>
    <div
        class="container pt-4"
        x-data="{ showMenu: false }"
    >
        <div class="bookmark-page-breakpoint:hidden mt-4 flex flex-col">
            <button
                @click="showMenu = !showMenu"
                class="border-lg border-divider flex items-center justify-between rounded-lg border px-3 py-2"
            >
                <div class="flex items-center">
                    @if($iconName)
                        <x-icon
                            name="{{ $iconName }}"
                            class="text-primary mr-3"
                        />
                    @endif

                    <p class="text-subtitle-1 text-primary font-primary font-medium">
                        {{ $title }}
                    </p>
                </div>

                <x-icon
                    name="caret-down"
                    class="text-primary h-4 w-4"
                    x-bind:class="showMenu ? 'rotate-180' : 'rotate-0'"
                />

            </button>


        </div>

        <h1
            class="font-primary cart-item-breakpoint:block cart-item-breakpoint:text-heading-h3 after:text-primary mt-3 mb-6 hidden after:absolute after:content-['.']"
        >
            My Account
        </h1>

        <div class="bookmark-page-breakpoint:flex-row flex flex-col">
            <div class="bookmark-page-breakpoint:block mr-5 hidden">
                <x-account-menu />
            </div>

            <div class="flex w-full flex-col">
                @if(!$hideTitle)
                    <h2
                        class="font-primary text-heading-h5 cart-item-breakpoint:mt-0 cart-item-breakpoint:text-heading-h4 after:text-primary mt-8 mb-6 after:absolute after:content-['.']"
                    >
                        {{ $title }}
                    </h2>
                @endif

                {{ $slot }}
            </div>
        </div>
    </div>
</x-app-layout>

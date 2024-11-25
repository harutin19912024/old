<!-- widescreen header -->
<nav
    x-data="{ open: false }"
    class="header-breakpoint:block sticky top-0 z-40 hidden border-b border-gray-100 bg-white"
>

    <div class="flex items-center justify-between py-3 lg:px-4 xl:px-6 2xl:px-10">
        <div class="flex items-center">
            <div class="flex items-center lg:mr-4 xl:mr-6 2xl:mr-10">
            </div>
        </div>
        <div class="flex items-center justify-around">
            <!--  authenticated user -->
            @if ($isAuthenticated)
                <div class="flex items-center justify-around">

                    <div class="flex items-center lg:mr-1 xl:mr-3 2xl:mr-6">
                        <div class="group relative">
                            <x-account-menu class="absolute right-[-60px] hidden group-hover:flex" />
                        </div>

                        <p class="font-primary text-default-text text-subtitle-1 font-medium">
                            <livewire:header-user-name-widget />
                        </p>


                    </div>

                </div>

                <div class="mr-2 flex items-center sm:hidden">
                    <button
                        @click="open = ! open"
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                    >
                        <svg
                            class="h-6 w-6"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                :class="{ 'hidden': open, 'inline-flex': !open }"
                                class="inline-flex"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{ 'hidden': !open, 'inline-flex': open }"
                                class="hidden"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            @else
                <!-- not authenticated user -->
                <div class="flex items-center justify-around">
                    <div class="flex lg:mr-1 xl:mr-3 2xl:mr-6">
                        <x-button
                            href="{{ route('register') }}"
                            tertiary
                            small
                            class="flex w-full max-w-[100px] px-0 py-0 lg:mr-2 xl:mr-3 2xl:mr-6"
                        >Registration</x-button>
                        <x-button
                            onclick="Livewire.emit('openModal', '{{ App\Http\Livewire\Modals\LoginModal::getName() }}')"
                            primary
                            small
                        >Login</x-button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</nav>

<!-- mobile/tablet header -->
{{-- blade-formatter-disable --}}
<nav
    class="burger-menu header-breakpoint:hidden bg-secondary-white top-0 z-40 block"
    x-data="{ open: false, openPrimaryMenu: false, openAccountMenu: false, }"
    x-bind:class="!open ? 'sticky' : 'relative'"
    x-init="$watch('open',
            value => {
                const body = document.getElementsByTagName('body')[0];
                if (value) {
                    body.classList.add('overflow-hidden');
                } else {
                    body.classList.remove('overflow-hidden');
                }
            }
        )"
>
{{-- blade-formatter-enable --}}
<div
    class="burger-menu__backdrop fixed z-10 h-[100vh] w-full"
    x-show="open"
    x-bind:class="open ? 'slide-in-backdrop' : 'slide-out-backdrop'"
></div>

<div class="relative">


    <div class="flex items-center justify-between p-[14px]">
        <div class="flex items-center">
            <button
                class="burger-menu__animated-burger"
                @click="open = !open"
                x-bind:class="open ? 'open' : ''"
            >
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <div class="flex items-center">
            <div>
                @if ($isAuthenticated)
                    <div class="relative">
                        <button
                            @click="openAccountMenu = true"
                            class="hover:bg-light-grey rounded-lg p-2"
                        >
                            <x-icon
                                name="profile"
                                class="fill-primary"
                            />
                        </button>
                        <div
                            x-show="openAccountMenu && !open"
                            class="header-breakpoint:hidden absolute right-[-40px] top-[30px] z-[201] block"
                        >
                            <button
                                @click="openAccountMenu = false"
                                class="bg-default-text absolute top-[-15px] left-[-15px] flex h-7 w-7 items-center justify-center rounded-[50%]"
                            >
                                <x-icon
                                    name="cross"
                                    class="text-secondary-white"
                                />
                            </button>
                            <x-account-menu />
                        </div>

                    </div>
                @else
                    <button
                        onclick="Livewire.emit('openModal', '{{ App\Http\Livewire\Modals\LoginModal::getName() }}')"
                        class="hover:bg-light-grey flex items-center justify-center rounded-lg p-2"
                    >
                        <x-icon
                            name="profile"
                            class="fill-primary"
                        />
                    </button>
                @endif
            </div>

        </div>

    </div>
</div>
</nav>

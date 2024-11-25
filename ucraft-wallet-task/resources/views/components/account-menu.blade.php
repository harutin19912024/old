<div
    {{ $attributes->except('class') }}
    @class([
        'account-menu rounded-lg flex flex-col p-5 min-w-[270px] z-[200] bg-secondary-white',
        $attributes->get('class'),
    ])
>
    <p class="text-disabled-text font-secondary mb-3 font-medium uppercase">Dashboard</p>

    <x-menu-subitem
        :href="route('my-wallets')"
        iconName="briefcase"
    >
        My Wallets
    </x-menu-subitem>

    <x-menu-subitem
        :href="route('add-wallet')"
        iconName="bookmark"
    >
        Add Wallet
    </x-menu-subitem>

    <x-menu-subitem
        :href="route('reports')"
        iconName="bookmark"
    >
        Reports
    </x-menu-subitem>

    <x-menu-subitem
        :href="route('profile')"
        iconName="briefcase"
    >
        My Profile
    </x-menu-subitem>

    <form
        method="POST"
        action="{{ route('logout') }}"
    >
        @csrf

        <x-button
            secondary
            medium
            icon-left="sign-out"
            onclick="event.preventDefault(); this.closest('form').submit();"
        >
            Logout
        </x-button>
    </form>
</div>

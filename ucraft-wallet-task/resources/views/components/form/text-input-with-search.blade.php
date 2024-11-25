@php
$hasErrors = $errors->has($getStatePath());
@endphp

<div
    class="multiple-select-input relative mb-5 flex flex-col"
    x-data='{
        state: {{ "\$wire.entangle('" . $getStatePath() . "').defer" }},
        search: "",
        items: @json($getOptions()),
        open: false,
        hasErrors: {{ $hasErrors ? 'true' : 'false' }},
        init() {
            $watch("state", () => $refs.searchInput.form.dispatchEvent(new CustomEvent("input")));
        },
        get filteredItems() {
            let items = this.items.filter(i => i.value.toLowerCase().includes(this.search.toLowerCase()));

            {{-- // TODO: remove or leave this limit? --}}
            items = items.slice(0, 10);

            {{--console.log("filteredItems", items);--}}

            return items;
        },
        get selectedItem() {
            return this.items.find(i => i.key === this.state);
        }
    }'
    x-on:click.outside="open = false"
>
    <label
        for="search-input"
        @class([
            'bg-secondary-white text-input-label absolute top-[-6px] left-[10px] z-10 px-1',
            'text-error' => $hasErrors,
        ])
        x-bind:class="!open ? 'text-input' : 'text-cta-text'"
    >
        {{ $getLabel() }}
    </label>

    <x-icon
        name="search"
        class="text-default-text absolute top-[10px] right-[10px] z-10 cursor-pointer"
        @click="open = true; $refs.searchInput.focus()"
    />

    <input
        x-ref="searchInput"
        x-bind:value="selectedItem?.value || search"
        @keyup="search = $event.target.value; open = true;"
        id="{{ $getId() }}"
        name="{{ $getName() }}"
        type="text"
        @click="open = true"
        :class="{
            'border-input': !open,
            'border-cta-text': open,
            {{-- 'border-error': hasErrors --}}
        }"
        @class([
            'text-default-text border-input text-body-1 relative flex h-10 w-full items-center justify-between rounded-lg border-[2px] py-2 px-3 text-left outline-0',
            'border-error' => $hasErrors,
        ])
    >

    <div
        x-on:click.outside="open = !open"
        x-show="open"
        class="multiple-select-input__dropdown bg-secondary-white absolute top-10 z-20 flex max-h-[400px] w-full flex-col items-start overflow-y-scroll rounded-lg py-4"
    >
        <template
            x-for="item in filteredItems"
            :key="item.key"
        >
            <button
                @click.prevent="state = item.key; search = ''; open = false;"
                class="font-secondary text-body-2 text-default-text hover:bg-light-grey-alternative w-full px-4 py-2 text-left"
                x-bind:class="state === item.key ?
                    'text-disabled-text hover:bg-secondary-white' :
                    'text-default-text hover:bg-light-grey-alternative'"
            >
                <p x-text="item.value"></p>
            </button>
        </template>
    </div>

    @if ($hasErrors)
        <p class="text-overline text-error mt-1 self-start pl-2">
            {{ $errors->first($getStatePath()) }}
        </p>
    @endif
</div>

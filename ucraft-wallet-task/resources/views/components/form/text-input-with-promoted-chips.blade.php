@php
$hasErrors = $errors->has($getStatePath());
@endphp

<div
    x-data='{
        search: "",
        open: false,
        state: {{ "\$wire.entangle('" . $getStatePath() . "').defer" }},
        items: @json($getOptions()),
        promotedItems: @json($getPromotedOptions()),
        init() {
            $watch("state", () => $refs.chipsInput.form.dispatchEvent(new CustomEvent("input")));
        },
        get filteredItems() {
            return this.items.filter(i => i.value.toLowerCase().includes(this.search.toLowerCase()));
        },
        get selectedItems() {
            return this.items.filter(i => this.state.includes(i.key));
        },
        get visiblePromotedItems() {
            return this.promotedItems.filter(i => !this.state.includes(i.key));
        }
    }'
    class="flex flex-col"
>
    <div class="mb-4 flex flex-wrap">
        <template
            x-for="item in selectedItems"
            :key="item.key"
        >
            <button
                @click.prevent="state.splice(state.indexOf(item.key), 1)"
                class="bg-default-text mr-2 mb-2 flex h-7 min-w-[70px] items-center justify-between rounded-2xl px-2 py-1"
            >
                <p
                    x-text="item.value"
                    class="font-primary text-secondary-white text-subtitle-2 mr-2 font-medium"
                ></p>
                <p class="text-secondary-white text-heading-h5">-</p>
            </button>
        </template>
    </div>

    <p class="font-secondary text-subtitle-2 text-input mb-5">
        Ieškokite, arba pasirinkite iš sąrašo:
    </p>

    <div class="relative">
        <label
            for="{{ $getName() }}"
            x-bind:class="!open ? 'text-input' : 'text-cta-text'"
            @class([
                'bg-secondary-white text-input-label absolute top-[-6px] left-[10px] z-10 px-1',
                'text-error' => $hasErrors,
            ])
        >
            {{ $getLabel() }}
        </label>

        <x-icon
            name="search"
            class="text-default-text absolute top-[10px] right-[10px] z-10"
        />

        <input
            x-ref="chipsInput"
            id="{{ $getName() }}"
            @click="open = !open"
            x-model="search"
            x-bind:class="!open ? 'border-input' : 'border-cta-text'"
            @class([
                'text-default-text border-input text-body-1 relative flex h-10 w-full items-center justify-between rounded-lg border-[2px] py-2 px-3 text-left outline-0',
                'border-error' => $hasErrors,
            ])
        >

        <div
            x-show="open"
            x-on:click.outside="open = false"
            class="input-with-chips__dropdown bg-secondary-white absolute top-10 z-10 flex max-h-[300px] w-full flex-col items-start overflow-y-auto rounded-lg py-4"
        >
            <template
                x-for="item in filteredItems"
                :key="item.key"
            >
                <button
                    @click.prevent="!state.includes(item.key) ? state.push(item.key) : false;"
                    class="font-secondary text-body-2 text-default-text hover:bg-light-grey-alternative bg-secondary-white w-full px-4 py-2 text-left"
                    x-bind:class="state.includes(item.key) ?
                        'text-disabled-text hover:bg-secondary-white' :
                        'text-default-text hover:bg-light-grey-alternative'"
                >
                    <p x-text="item.value"></p>
                </button>
            </template>
        </div>
    </div>

    <div class="mt-4 flex flex-wrap">
        <template
            x-for="item in visiblePromotedItems"
            :key="item.key"
        >
            <div
                class="bg-secondary-white border-cta-text mr-2 mb-2 flex h-7 min-w-[70px] items-center justify-between rounded-2xl border px-2 py-1">
                <p
                    x-text="item.value"
                    class="font-primary text-cta-text text-subtitle-2 mr-2 font-medium"
                ></p>

                <button @click.prevent="!state.includes(item.key) ? state.push(item.key) : false;">
                    <p class="text-cta-text text-heading-h5">
                        +
                    </p>
                </button>
            </div>
        </template>
    </div>

    @if ($hasErrors)
        <p class="text-overline text-error mt-1 self-start pl-2">
            {{ $errors->first($getStatePath()) }}
        </p>
    @endif
</div>

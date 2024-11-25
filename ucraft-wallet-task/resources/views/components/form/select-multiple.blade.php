@php
    $hasErrors = $errors->has($getStatePath());
@endphp

<div
    x-data='{
        open: false,
        state: {{ "\$wire.entangle('" . $getStatePath() . "').defer" }},
        items: @json($getOptions()),
        selectedItems: [],

        init() {
            this.updateSelectedItems();

            $watch("state", () => this.updateSelectedItems());
            $watch("state", () => $refs.mainButton.form.dispatchEvent(new CustomEvent("input")));
        },

        updateSelectedItems() {
            {{--console.log("this.selectedItems before updateSelectedItems: ", this.selectedItems);--}}
            {{--console.log("this.state before updateSelectedItems: ", this.state);--}}

            if (this.state === null) {
                this.selectedItems = [];
            } else {
                this.selectedItems = [];

                for (let i = 0; i < this.items.length; i++) {
                    for (let j = 0; j < this.state.length; j++) {
                        let itemValue = this.items[i].key.toString();
                        let stateValue = this.state[j].toString();

                        {{--console.log({ itemValue, stateValue });--}}

                        if (itemValue === stateValue) {
                            this.selectedItems.push(this.items[i]);
                        }
                    }
                }
            }

            console.log("this.selectedItems after updateSelectedItems: ", this.selectedItems);
        }
    }'
    class="multiple-select-input relative mb-5 flex flex-col"
>
    <button
        x-ref="mainButton"
        @click.prevent="open = !open"
        x-bind:class="!open ? 'border-input' : 'border-cta-text'"
        @class([
            'text-default-text border-input text-body-1 relative flex h-10 w-full items-center justify-between rounded-lg border-[2px] py-2 px-3 text-left outline-0',
            'border-error' => $hasErrors,
        ])
    >
        <p
            x-bind:class="!open ? 'text-input' : 'text-cta-text'"
            @class([
                'bg-secondary-white text-input-label absolute top-[-7px] px-1',
                'text-error' => $hasErrors,
            ])
        >
            {{ $getLabel() }}
        </p>

        <span
            x-text="selectedItems.map(item => ` ${item.value}`)"
            class="text-subtitle-1 input-breakpoint:max-w-[280px] max-w-[200px] truncate"
        ></span>

        <x-icon
            name="caret-down"
            class="text-default-text h4 w-4"
            x-bind:class="!open ? 'rotate-0' : 'rotate-180'"
        />
    </button>

    <button
        x-show="state && (state.length > 0)"
        @click.prevent="state = []"
        class="absolute top-[10px] right-[35px]"
    >
        <x-icon
            name="cross-circle"
            class="text-input"
        />
    </button>

    <div
        x-show="open"
        x-on:click.outside="open = false"
        class="multiple-select-input__dropdown bg-secondary-white absolute top-10 z-20 max-h-[400px] w-full overflow-y-scroll rounded-lg py-4"
    >
        <template x-for="(item, index) in items">
            <div class="hover:bg-light-grey-alternative mb-1 flex items-center py-2 px-4">
                <input
                    x-bind:id="`{{ $getName() }}-${item.key}`"
                    x-bind:value="item.key"
                    x-model="state"
                    name="{{ $getName() }}"
                    type="checkbox"
                    class="border-input mr-2 h-5 w-5 rounded-[2px] border-[2px] checked:bg-[#24292E]"
                >

                <label
                    x-bind:for="`{{ $getName() }}-${item.key}`"
                    x-text="item.value"
                    class="font-secondary text-body-2"
                ></label>
            </div>
        </template>
    </div>

    @if ($hasErrors)
        <p class="text-overline text-error mt-1 self-start pl-2">
            {{ $errors->first($getStatePath()) }}
        </p>
    @endif
</div>

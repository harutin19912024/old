<div>
    <div class="flex w-full max-w-[753px] flex-col">
        @foreach ($paginator as $item)
            <div class="mb-4">
                <x-faq-accordeon-panel :title="$item['question']">
                    {!! $item['answer'] !!}
                </x-faq-accordeon-panel>
            </div>
        @endforeach
        <div class="mb-6 self-center">
            {{ $paginator->links() }}
        </div>
    </div>
</div>

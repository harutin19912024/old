@props([
  'content' => null,
])

<div x-data="{ tooltip: '{{ $content }}' }">
    <div x-tooltip.theme.default="tooltip">{{ $slot }}</div>
</div>
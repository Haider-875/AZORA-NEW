@props([
    'number' => null,
    'title' => null,
    'description' => null,
    'href' => null,
    'class' => '',
])

@php
    $isLink = !empty($href);
    $tag = $isLink ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if($isLink) href="{{ $href }}" @endif
    {{ $attributes->merge([
        'class' => 'motion-card ' . trim($class),
        'data-motion-card' => '',
        'tabindex' => $isLink ? null : '0',
        'role' => $isLink ? null : 'region',
        'aria-label' => $title ? strip_tags($title) : null,
    ]) }}
>
    {{-- Optional Top Accent Beam --}}
    <span class="motion-card-beam" aria-hidden="true"></span>

    {{-- Optional Monospace Scramble Number --}}
    @if($number !== null && $number !== '')
        <span class="motion-card-number font-mono-badge" data-card-number="{{ $number }}">
            {{ $number }}
        </span>
    @endif

    {{-- Optional Title --}}
    @if($title !== null && $title !== '')
        <h4 class="motion-card-title font-heading">
            {{ $title }}
        </h4>
    @endif

    {{-- Optional Description --}}
    @if($description !== null && $description !== '')
        <p class="motion-card-desc text-slate-400">
            {{ $description }}
        </p>
    @endif

    {{-- Custom Card Content / Slot --}}
    {{ $slot }}
</{{ $tag }}>


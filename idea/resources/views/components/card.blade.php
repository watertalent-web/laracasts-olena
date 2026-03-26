@props(['href' => null, 'isButton' => false, 'class' => ''])

@php
    $base = 'border border-border rounded-lg bg-card p-4 md:text-sm';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class([$base, 'block', $class]) }}>
        {{ $slot }}
    </a>
@elseif ($isButton)
    <button type="button" {{ $attributes->class([$base, $class]) }}>
        {{ $slot }}
    </button>
@else
    <div {{ $attributes->class([$base, $class]) }}>
        {{ $slot }}
    </div>
@endif

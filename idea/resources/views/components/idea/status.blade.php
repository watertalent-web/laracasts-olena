@props(['status' => 'pending'])

@php
    $classes = "inline-block rounded-full border  px-2 py-1 text-xs font-medium mt-2";

    if ($status === 'pending') {
        $classes .= " bg-yellow-500/10 text-yellow-500 border-yellow-500";
    } elseif ($status === 'in_progress') {
        $classes .= " bg-blue-500/10 text-blue-500 border-blue-500";
    } elseif ($status === 'completed') {
        $classes .= " bg-green-500/10 text-green-500 border-green-500";
    } else {
        $classes .= " bg-gray-500/10 text-gray-500 border-gray-500";
    }@endphp


<span class="{{ $classes }}">
    {{ $slot }}
</span>
@props(['active'])

@php
$classes = ($active ?? false)
            ? 'group flex items-center px-4 py-3 text-sm font-medium rounded-md bg-blue-800 text-white'
            : 'group flex items-center px-4 py-3 text-sm font-medium rounded-md text-blue-100 hover:bg-blue-800 hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a> 
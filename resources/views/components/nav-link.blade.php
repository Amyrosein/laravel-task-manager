@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1  border-indigo-400 text-sm font-medium leading-5 text-sky-300 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out w-full'
            : 'inline-flex items-center px-1 pt-1  border-transparent text-sm font-medium leading-5 text-white-500 hover:text-sky-400 hover:border-sky-300 focus:outline-none focus:text-sky-700 focus:border-sky-300 transition duration-150 ease-in-out w-full';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

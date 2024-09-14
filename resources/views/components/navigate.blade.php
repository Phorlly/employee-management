@props(['active', 'as' => 'Link'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center border bg-slate-600 px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700 duration-150 ease-in-out'
            : 'flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700 duration-150 ease-in-out';
@endphp

<{{ $as }} {{ $attributes->class($classes) }}>{{ $slot }} </{{ $as }}>

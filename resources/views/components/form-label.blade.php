@props(['for' => ''])

<label 
    for="{{ $for }}" 
    {{ $attributes->merge(['class' => 'block text-sm font-medium text-gray-700 mb-2']) }}
>
    {{ $slot }}
</label>
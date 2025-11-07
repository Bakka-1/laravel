@props(['type' => 'text', 'name', 'value' => ''])

<input 
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $name }}"
    @if($type !== 'password')
        value="{{ old($name, $value) }}"
    @endif
    {{ $attributes->merge(['class' => 'w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 ' . ($errors->has($name) ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : '')]) }}
>
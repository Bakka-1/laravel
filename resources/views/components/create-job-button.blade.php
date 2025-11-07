@props(['class' => ''])

<a 
    href="/jobs/create" 
    {{ $attributes->merge(['class' => 'bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200 ' . $class]) }}
>
    Create Job
</a>
<x-layout>
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>

    <ul>
        @foreach ($jobs as $job)
            <li>
                <a href="/jobs/{{ $job->id }}" class="text-blue-500 hover:underline">
                    {{ $job->title }}
                </a>: <strong>${{ $job->salary }}</strong> per year
                @if($job->employer)
                    - <em>{{ $job->employer->name }}</em>
                @endif
            </li>
        @endforeach
    </ul>
</x-layout>
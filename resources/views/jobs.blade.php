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
                @if($job->tags->count() > 0)
                    <div class="mt-1">
                        @foreach($job->tags as $tag)
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</x-layout>
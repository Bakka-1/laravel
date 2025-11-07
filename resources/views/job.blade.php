<x-layout>
    <x-slot:heading>
        {{ $job->title }}
    </x-slot:heading>

    <h2 class="text-lg font-bold">{{ $job->title }}</h2>
    @if($job->employer)
        <p class="text-gray-600 mb-2"><strong>Company:</strong> {{ $job->employer->name }}</p>
    @endif
    <p>This job pays ${{ $job->salary }} per year.</p>
    
    @if($job->tags->count() > 0)
        <div class="mt-4">
            <h3 class="text-md font-semibold mb-2">Tags:</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($job->tags as $tag)
                    <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">{{ $tag->name }}</span>
                @endforeach
            </div>
        </div>
    @endif

    <a href="/jobs" class="text-blue-500 hover:underline mt-4 inline-block">← Back to Jobs</a>
</x-layout>
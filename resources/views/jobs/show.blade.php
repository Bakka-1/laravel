<x-layout>
    <x-slot:heading>
        {{ $job->title }}
    </x-slot:heading>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

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

    {{-- Action Buttons --}}
    <div class="mt-6 flex items-center space-x-4">
        <a href="/jobs/{{ $job->id }}/edit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Edit Job
        </a>
        
        <form method="POST" action="/jobs/{{ $job->id }}" id="delete-form" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="return confirm('Are you sure you want to delete this job?')">
                Delete Job
            </button>
        </form>
        
        <a href="/jobs" class="text-blue-500 hover:underline">← Back to Jobs</a>
    </div>
</x-layout>
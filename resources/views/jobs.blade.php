<x-layout>
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>

    <div class="space-y-4">
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job->id }}" class="block p-4 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md hover:border-blue-300 transition-all duration-200">
                @if($job->employer)
                    <div class="text-sm text-gray-500 mb-1">{{ $job->employer->name }}</div>
                @endif
                
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $job->title }}</h3>
                
                <div class="text-green-600 font-medium mb-3">
                    ${{ number_format($job->salary) }} per year
                </div>
                
                @if($job->tags->count() > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach($job->tags as $tag)
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif
            </a>
        @endforeach
    </div>
</x-layout>
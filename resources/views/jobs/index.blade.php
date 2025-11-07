<x-layout>
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>

    {{-- Create Job Button --}}
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">Job Listings</h2>
        <a href="/jobs/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create Job
        </a>
    </div>

    {{-- Pagination Type Selector --}}
    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
        <h3 class="text-lg font-semibold mb-3">Pagination Types:</h3>
        <div class="flex flex-wrap gap-2">
            <a href="/jobs?type=standard" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 {{ $paginationType === 'standard' ? 'bg-blue-700' : '' }}">
                Standard Pagination
            </a>
            <a href="/jobs?type=simple" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 {{ $paginationType === 'simple' ? 'bg-green-700' : '' }}">
                Simple Pagination
            </a>
            <a href="/jobs?type=cursor" class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 {{ $paginationType === 'cursor' ? 'bg-purple-700' : '' }}">
                Cursor Pagination
            </a>
        </div>
        <p class="text-sm text-gray-600 mt-2">
            <strong>Current:</strong> {{ ucfirst($paginationType) }} Pagination
        </p>
    </div>

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

    {{-- Pagination Links --}}
    <div class="mt-6">
        {{ $jobs->links() }}
    </div>
</x-layout>
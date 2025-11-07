<x-layout>
    <x-slot:heading>
        {{ $job->title }}
    </x-slot:heading>

    <h2 class="text-lg font-bold">{{ $job->title }}</h2>
    @if($job->employer)
        <p class="text-gray-600 mb-2"><strong>Company:</strong> {{ $job->employer->name }}</p>
    @endif
    <p>This job pays ${{ $job->salary }} per year.</p>

    <a href="/jobs" class="text-blue-500 hover:underline mt-4 inline-block">← Back to Jobs</a>
</x-layout>
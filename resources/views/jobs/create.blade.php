<x-layout>
    <x-slot:heading>
        Create Job
    </x-slot:heading>

    <div class="max-w-md mx-auto">
        <form method="POST" action="/jobs" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Job Title
                </label>
                <input 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" 
                    id="title" 
                    name="title" 
                    type="text" 
                    placeholder="e.g. Software Developer"
                    value="{{ old('title') }}"
                    required
                >
                @error('title')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="salary">
                    Salary
                </label>
                <input 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('salary') border-red-500 @enderror" 
                    id="salary" 
                    name="salary" 
                    type="number" 
                    placeholder="50000"
                    value="{{ old('salary') }}"
                    required
                >
                @error('salary')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Create Job
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="/jobs">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layout>
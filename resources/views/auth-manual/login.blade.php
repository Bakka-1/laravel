<x-layout>
    <x-slot:heading>
        Sign In
    </x-slot:heading>

    <div class="max-w-md mx-auto">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Please fix the following errors:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/login-manual" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            
            {{-- Email --}}
            <div class="mb-4">
                <x-form-label for="email">Email Address</x-form-label>
                <x-form-input 
                    name="email" 
                    type="email" 
                    required 
                    autofocus
                    class="@error('email') border-red-500 @enderror"
                />
                <x-form-error name="email" />
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <x-form-label for="password">Password</x-form-label>
                <x-form-input 
                    name="password" 
                    type="password" 
                    required
                    class="@error('password') border-red-500 @enderror"
                />
                <x-form-error name="password" />
            </div>

            {{-- Remember Me --}}
            <div class="mb-6">
                <label class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    >
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center justify-between">
                <button 
                    type="submit" 
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                    Sign In
                </button>
                <a 
                    href="/register-manual" 
                    class="inline-block align-baseline font-bold text-sm text-indigo-600 hover:text-indigo-800"
                >
                    Need an account?
                </a>
            </div>
        </form>
    </div>
</x-layout>
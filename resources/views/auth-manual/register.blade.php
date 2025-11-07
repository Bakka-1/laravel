<x-layout>
    <x-slot:heading>
        Create Account
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

        <form method="POST" action="/register-manual" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            
            {{-- First Name --}}
            <div class="mb-4">
                <x-form-label for="first_name">First Name</x-form-label>
                <x-form-input 
                    name="first_name" 
                    type="text" 
                    required 
                    autofocus
                    class="@error('first_name') border-red-500 @enderror"
                />
                <x-form-error name="first_name" />
            </div>

            {{-- Last Name --}}
            <div class="mb-4">
                <x-form-label for="last_name">Last Name</x-form-label>
                <x-form-input 
                    name="last_name" 
                    type="text" 
                    required
                    class="@error('last_name') border-red-500 @enderror"
                />
                <x-form-error name="last_name" />
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <x-form-label for="email">Email Address</x-form-label>
                <x-form-input 
                    name="email" 
                    type="email" 
                    required
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
                    minlength="8"
                    class="@error('password') border-red-500 @enderror"
                />
                <x-form-error name="password" />
            </div>

            {{-- Password Confirmation --}}
            <div class="mb-6">
                <x-form-label for="password_confirmation">Confirm Password</x-form-label>
                <x-form-input 
                    name="password_confirmation" 
                    type="password" 
                    required
                    minlength="8"
                    class="@error('password_confirmation') border-red-500 @enderror"
                />
                <x-form-error name="password_confirmation" />
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center justify-between">
                <button 
                    type="submit" 
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                    Register
                </button>
                <a 
                    href="/login-manual" 
                    class="inline-block align-baseline font-bold text-sm text-indigo-600 hover:text-indigo-800"
                >
                    Already have an account?
                </a>
            </div>
        </form>
    </div>
</x-layout>
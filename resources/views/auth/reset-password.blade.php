@extends('layouts.app')

@section('title', 'Reset Password - Event Hub')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-light-grey">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Reset Password</h1>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full rounded border border-gray-300 px-3 py-2" value="{{ $request->email }}" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full rounded border border-gray-300 px-3 py-2" required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded border border-gray-300 px-3 py-2" required>
                </div>

                <button type="submit" class="w-full bg-primary-blue text-white font-semibold py-2 rounded hover:bg-blue-600 transition">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Forgot Password - Event Hub')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-light-grey">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Reset Password</h1>
                <p class="text-gray-600 mt-2">Enter your email to receive password reset link</p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 focus:border-primary-blue focus:outline-none" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-primary-blue text-white font-semibold py-2 rounded hover:bg-blue-600 transition">
                    Send Reset Link
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-primary-blue hover:underline">Back to login</a>
            </div>
        </div>
    </div>
</div>
@endsection

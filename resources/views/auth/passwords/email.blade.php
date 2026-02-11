@extends('layouts.master')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-100 to-purple-50 py-12 px-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Reset Password</h2>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="mt-1 block w-full rounded-md border border-gray-200 shadow-sm px-3 py-2 focus:ring-2 focus:ring-indigo-300 focus:outline-none"/>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg shadow hover:from-indigo-700 hover:to-purple-700 transition">
                    Send Password Reset Link
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">
                Back to login
            </a>
        </div>
    </div>
</div>
@endsection

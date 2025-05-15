@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-[#fef6ff]">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-xl font-semibold mb-4 text-center text-gray-800">Enter Your Key</h2>

        <form method="GET" action="/access/search">
            <input type="text" name="key" maxlength="5" placeholder="5-digit Key"
                   class="w-full mb-4 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 text-sm font-medium tracking-wide">View Info</button>
        </form>

        @isset($user)
        <div class="mt-6 p-4 bg-gray-50 rounded shadow text-sm">
            <h3 class="font-semibold text-center mb-2">User Info</h3>
            <p><strong>Name:</strong> {{ $user['name'] }}</p>
            <p><strong>Username:</strong> {{ $user['username'] }}</p>
            <p><strong>BMI:</strong> {{ $user['bmi'] }}</p>
        </div>
        @endisset
    </div>
</div>
@endsection

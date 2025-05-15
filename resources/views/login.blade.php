@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-[#fef6ff]">
    <div class="bg-white p-8 rounded-lg shadow-md w-80">
        <h2 class="text-xl font-semibold mb-4 text-center text-gray-800">ID NUMBER</h2>

        {{-- Success message --}}
        @if(session('status'))
            <div class="mb-4 text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif

        {{-- Error message --}}
        @if(session('error'))
            <div class="mb-4 text-sm text-red-600 text-center">
                {{ session('error') }}
            </div>
        @endif

        {{-- ✅ Form must post to /login --}}
        <form method="POST" action="/login">
            @csrf
            <input type="text" name="key" maxlength="5" placeholder="Enter 5-digit Key"
                   class="w-full mb-4 border border-gray-300 rounded px-3 py-2 text-sm"
                   required>
            <button class="w-full bg-black text-white py-2 rounded">PROCEED</button>
        </form>
    </div>
</div>
@endsection

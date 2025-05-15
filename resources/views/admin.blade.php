@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6">

    {{-- ✅ Logout Button --}}
    <div class="flex justify-end mb-4">
        <a href="/logout" class="text-sm text-red-600 hover:underline font-semibold">Logout</a>
    </div>

    <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Admin Panel</h2>

    {{-- Create New User --}}
    <form method="POST" action="/admin/save" class="bg-white shadow rounded p-6 mb-10">
        @csrf

        {{-- Generate Key --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">User Key</label>
            <div class="flex gap-2">
                <input type="text" name="key" id="key" class="w-full border rounded p-2" readonly required>
                <button type="button" onclick="generateKey()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Generate Key
                </button>
            </div>
        </div>

        {{-- Manual Inputs --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Age</label>
            <input type="number" name="age" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Sex</label>
            <select name="sex" class="w-full border rounded p-2" required>
                <option value="">-- Select --</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        {{-- Read-only fields from hardware --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Height (cm)</label>
            <input type="number" name="height" class="w-full border rounded p-2 bg-gray-100" readonly value="170">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Weight (kg)</label>
            <input type="number" name="weight" class="w-full border rounded p-2 bg-gray-100" readonly value="65">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">BMI</label>
            <input type="number" step="0.1" name="bmi" class="w-full border rounded p-2 bg-gray-100" readonly value="22.5">
        </div>

        <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Save User</button>
    </form>

    {{-- User Table --}}
    <div class="bg-white shadow rounded p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">User List</h3>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 font-medium">Key</th>
                        <th class="px-4 py-2 font-medium">Name</th>
                        <th class="px-4 py-2 font-medium">Age</th>
                        <th class="px-4 py-2 font-medium">Sex</th>
                        <th class="px-4 py-2 font-medium">Height</th>
                        <th class="px-4 py-2 font-medium">Weight</th>
                        <th class="px-4 py-2 font-medium">BMI</th>
                        <th class="px-4 py-2 font-medium">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-2">{{ $user['key'] }}</td>
                        <td class="px-4 py-2">{{ $user['name'] }}</td>
                        <td class="px-4 py-2">{{ $user['age'] }}</td>
                        <td class="px-4 py-2">{{ $user['sex'] }}</td>
                        <td class="px-4 py-2">{{ $user['height'] }}</td>
                        <td class="px-4 py-2">{{ $user['weight'] }}</td>
                        <td class="px-4 py-2">{{ $user['bmi'] }}</td>
                        <td class="px-4 py-2">
                            <form method="POST" action="/admin/delete/{{ $user['key'] }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if(count($users) === 0)
                    <tr>
                        <td colspan="8" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function generateKey() {
        const key = String(Math.floor(10000 + Math.random() * 90000));
        document.getElementById('key').value = key;
    }
</script>
@endsection

@if (!session('admin_key'))
    <script>window.location.href = "/";</script>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | BMI</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 text-white p-8">

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">BMI Admin Panel</h1>
        <a href="/logout" class="bg-red-600 px-4 py-1 rounded hover:bg-red-800">Logout</a>
    </div>

    @if(session('status'))
        <p class="mb-4 bg-green-700 text-white p-2 rounded">{{ session('status') }}</p>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- LEFT: User Table -->
        <div>
            <h2 class="text-xl font-semibold mb-2">User Table</h2>

            <!-- Search Bar -->
            <form method="GET" action="/admin" class="mb-4 flex">
                <input type="text" name="search" placeholder="Search name or key"
                       value="{{ request('search') }}"
                       class="p-2 w-full md:w-1/2 rounded bg-gray-800 text-white border border-gray-600">
                <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 rounded hover:bg-blue-800 text-white">
                    Search
                </button>
            </form>

            <table class="w-full bg-white text-black rounded overflow-hidden">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2">Name</th>
                        <th>Sex</th>
                        <th>Age</th>
                        <th>Birthdate</th>
                        <th>Key</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-t">
                            <td class="p-2">
                                {{ $user->last_name }}, {{ $user->first_name }} {{ $user->middle_name }} {{ $user->suffix }}
                            </td>
                            <td>{{ $user->sex }}</td>
                            <td>{{ $user->age }}</td>
                            <td>{{ $user->birthdate }}</td>
                            <td class="font-mono">{{ $user->key }}</td>
                            <td class="flex flex-col space-y-1">
                                <!-- Edit -->
                                <a href="{{ route('admin.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a>

                                <!-- Delete -->
                                <form method="POST" action="/admin/delete/{{ $user->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline" onclick="return confirm('Delete this user?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center p-4">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- RIGHT: Create User Form -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Create User</h2>

            <form method="POST" action="/admin/save" class="space-y-4">
    @csrf

    <input name="last_name" type="text" placeholder="Last Name" required class="w-full p-2 rounded bg-gray-800 text-white">
    <input name="first_name" type="text" placeholder="First Name" required class="w-full p-2 rounded bg-gray-800 text-white">
    <input name="middle_name" type="text" placeholder="Middle Name" class="w-full p-2 rounded bg-gray-800 text-white">

    <select name="suffix" class="w-full p-2 rounded bg-gray-800 text-white">
        <option value="">None</option>
        <option value="Jr.">Jr.</option>
        <option value="Sr.">Sr.</option>
        <option value="III">III</option>
        <option value="IV">IV</option>
    </select>

    <select name="sex" required class="w-full p-2 rounded bg-gray-800 text-white">
        <option value="">Sex</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>

    <input name="age" type="number" min="1" max="999" placeholder="Age" required class="w-full p-2 rounded bg-gray-800 text-white">
    <input name="birthdate" type="date" required class="w-full p-2 rounded bg-gray-800 text-white">

    <button type="submit" class="bg-blue-600 hover:bg-blue-800 w-full p-2 rounded text-white">
        Generate
    </button>
</form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Restrict name fields to letters only
            const nameInputs = document.querySelectorAll(
                'input[name="last_name"], input[name="first_name"], input[name="middle_name"]'
            );
            nameInputs.forEach(function (input) {
                input.addEventListener('input', function () {
                    this.value = this.value.replace(/[^A-Za-z\s\-]/g, '');
                });
            });

            // Restrict age to max 3 digits
            const ageInput = document.querySelector('input[name="age"]');
            if (ageInput) {
                ageInput.addEventListener('input', function () {
                    if (this.value.length > 3) {
                        this.value = this.value.slice(0, 3);
                    }
                });
            }
        });
    </script>
</body>
</html>

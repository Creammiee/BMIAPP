<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Info | BMI</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 text-white p-8">

    <div class="max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-center">Welcome, {{ $user->first_name }}!</h1>

        <div class="bg-gray-800 p-6 rounded shadow space-y-4">
            <div><strong>Last Name:</strong> {{ $user->last_name }}</div>
            <div><strong>First Name:</strong> {{ $user->first_name }}</div>
            <div><strong>Middle Name:</strong> {{ $user->middle_name ?? 'N/A' }}</div>
            <div><strong>Suffix:</strong> {{ $user->suffix ?? 'N/A' }}</div>
            <div><strong>Sex:</strong> {{ $user->sex }}</div>
            <div><strong>Age:</strong> {{ $user->age }}</div>
            <div><strong>Birthdate:</strong> {{ $user->birthdate }}</div>
            <div><strong>Access Key:</strong> <code>{{ $user->key }}</code></div>
        </div>

        <div class="mt-6 text-center">
            <a href="/logout" class="bg-red-600 px-4 py-2 rounded hover:bg-red-800">
                Logout
            </a>
        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 text-white p-8">
    <div class="max-w-md mx-auto mt-24 bg-gray-800 p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4 text-center">Enter Access Code</h1>

        @if(session('error'))
            <p class="text-red-500 text-center mb-4">{{ session('error') }}</p>
        @endif

        @if(session('status'))
            <p class="text-green-500 text-center mb-4">{{ session('status') }}</p>
        @endif

        <form method="POST" action="/login">
            @csrf
            <input name="key" type="text" maxlength="5" placeholder="Enter your 5-digit key"
                   required class="w-full p-3 mb-4 rounded bg-gray-700 text-white text-center text-xl tracking-widest">

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-800 p-3 rounded text-white font-semibold">
                Login
            </button>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 text-white p-8">
  <div class="max-w-xl mx-auto bg-gray-800 p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6 text-center">Edit User</h1>

    <form method="POST" action="{{ route('admin.update', $user->id) }}">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label class="block mb-1">Last Name</label>
        <input type="text" name="last_name" value="{{ $user->last_name }}" required
               class="w-full p-2 rounded bg-gray-700 text-white">
      </div>

      <div class="mb-4">
        <label class="block mb-1">First Name</label>
        <input type="text" name="first_name" value="{{ $user->first_name }}" required
               class="w-full p-2 rounded bg-gray-700 text-white">
      </div>

      <div class="mb-4">
        <label class="block mb-1">Middle Name</label>
        <input type="text" name="middle_name" value="{{ $user->middle_name }}"
               class="w-full p-2 rounded bg-gray-700 text-white">
      </div>

      <div class="mb-4">
        <label class="block mb-1">Suffix</label>
        <select name="suffix" class="w-full p-2 rounded bg-gray-700 text-white">
          <option value="">None</option>
          <option value="Jr." {{ $user->suffix === 'Jr.' ? 'selected' : '' }}>Jr.</option>
          <option value="Sr." {{ $user->suffix === 'Sr.' ? 'selected' : '' }}>Sr.</option>
          <option value="III" {{ $user->suffix === 'III' ? 'selected' : '' }}>III</option>
          <option value="IV" {{ $user->suffix === 'IV' ? 'selected' : '' }}>IV</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block mb-1">Sex</label>
        <select name="sex" required class="w-full p-2 rounded bg-gray-700 text-white">
          <option value="Male" {{ $user->sex === 'Male' ? 'selected' : '' }}>Male</option>
          <option value="Female" {{ $user->sex === 'Female' ? 'selected' : '' }}>Female</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block mb-1">Age</label>
        <input type="number" name="age" value="{{ $user->age }}" min="1" max="999" required
               class="w-full p-2 rounded bg-gray-700 text-white">
      </div>

      <div class="mb-6">
        <label class="block mb-1">Birthdate</label>
        <input type="date" name="birthdate" value="{{ $user->birthdate }}" required
               class="w-full p-2 rounded bg-gray-700 text-white">
      </div>

      <div class="flex justify-between">
        <a href="/admin" class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded">Cancel</a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-800 px-4 py-2 rounded text-white">Save Changes</button>
      </div>
    </form>
  </div>
</body>
</html>

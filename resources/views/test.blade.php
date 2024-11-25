<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Test Registration Form</title>
  @vite(['resources/css/app.css', 'resources/js/testRegister.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="w-full max-w-md bg-white rounded shadow-md p-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
    <form id="register-form" class="space-y-4">
      <div>
        <label for="name" class="block text-gray-700">Name</label>
        <input type="text" id="name" name="name" class="w-full border border-gray-300 p-2 rounded" required>
      </div>
      <div>
        <label for="email" class="block text-gray-700">Email</label>
        <input type="email" id="email" name="email" class="w-full border border-gray-300 p-2 rounded" required>
      </div>
      <div>
        <label for="password" class="block text-gray-700">Password</label>
        <input type="password" id="password" name="password" class="w-full border border-gray-300 p-2 rounded" required>
      </div>
      <div>
        <label for="confirm-password" class="block text-gray-700">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" class="w-full border border-gray-300 p-2 rounded" required>
      </div>
      <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
        Register
      </button>
    </form>
  </div>
</body>
</html>

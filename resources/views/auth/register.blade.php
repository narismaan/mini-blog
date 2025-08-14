<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register - {{ config('app.name', 'Laravel') }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen font-sans">

  <div class="w-full max-w-md bg-white rounded-lg shadow p-8">
    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Name -->
      <div>
        <label for="name" class="block font-medium text-gray-700">Name</label>
        <input id="name" name="name" type="text" required autofocus autocomplete="name"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
               value="{{ old('name') }}" />
        @error('name')
          <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Email Address -->
      <div class="mt-4">
        <label for="email" class="block font-medium text-gray-700">Email</label>
        <input id="email" name="email" type="email" required autocomplete="username"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
               value="{{ old('email') }}" />
        @error('email')
          <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password -->
      <div class="mt-4">
        <label for="password" class="block font-medium text-gray-700">Password</label>
        <input id="password" name="password" type="password" required autocomplete="new-password"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500" />
        @error('password')
          <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Confirm Password -->
      <div class="mt-4">
        <label for="password_confirmation" class="block font-medium text-gray-700">Confirm Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500" />
        @error('password_confirmation')
          <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex items-center justify-end mt-6">
        <a href="{{ route('login') }}"
           class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
          Already registered?
        </a>

        <button type="submit" 
                class="ml-4 inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-white hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
          Register
        </button>
      </div>
    </form>
  </div>

</body>
</html>

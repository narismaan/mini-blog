<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Forgot Password - {{ config('app.name', 'Laravel') }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen font-sans">

  <div class="w-full max-w-md bg-white rounded-lg shadow p-8">
    <div class="mb-4 text-gray-600 text-sm">
      {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <div class="mb-4 text-green-600 font-medium">
      <x-auth-session-status :status="session('status')" />
    </div>

    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <!-- Email Address -->
      <div>
        <label for="email" class="block font-medium text-gray-700">Email</label>
        <input id="email" name="email" type="email" required autofocus autocomplete="username"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
               value="{{ old('email') }}" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <div class="flex items-center justify-end mt-6">
        <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-white hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
          {{ __('Email Password Reset Link') }}
        </button>
      </div>
    </form>
  </div>

</body>
</html>


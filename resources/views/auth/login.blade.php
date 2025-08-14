<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - {{ config('app.name', 'Laravel') }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen font-sans">

  <div class="w-full max-w-md bg-white rounded-lg shadow p-8">
    <!-- Session Status -->
    @if (session('status'))
      <div class="mb-4 text-green-600 font-medium">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf
      
      <!-- Email Address -->
      <div>
        <label for="email" class="block font-medium text-gray-700">Email</label>
        <input id="email" name="email" type="email" required autofocus autocomplete="username"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500" 
               value="{{ old('email') }}" />
        @error('email')
          <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password -->
      <div class="mt-4">
        <label for="password" class="block font-medium text-gray-700">Password</label>
        <input id="password" name="password" type="password" required autocomplete="current-password"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500" />
        @error('password')
          <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Remember Me -->
      <div class="flex items-center mt-4">
        <input id="remember_me" name="remember" type="checkbox"
               class="rounded border-gray-300 text-pink-600 shadow-sm focus:ring-pink-500" />
        <label for="remember_me" class="ml-2 block text-sm text-gray-600">Remember me</label>
      </div>

      <!-- Submit and Forgot Password -->
      <div class="flex items-center justify-end mt-6">
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}"
             class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
            Forgot your password?
          </a>
        @endif
        <button type="submit" 
                class="ml-3 inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-white hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
          Log in
        </button>
      </div>
    </form>
  </div>

</body>
</html>

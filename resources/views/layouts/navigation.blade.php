<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Side - Brand -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="text-lg font-bold text-pink-800 hover:text-light pink-600">
                    ANAIA BLOG
                </a>
            </div>

            <!-- Middle - Navigation Links -->
            <div class="hidden sm:flex sm:space-x-8 sm:items-center">
                <a href="{{ route('dashboard') }}" 
                   class="font-bold text-black-600 hover:text-pink-600 {{ request()->routeIs('dashboard') ? 'font-semibold text-pink-600' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('posts.index') }}" 
                   class="font-bold text-black-600 hover:text-pink-600 {{ request()->routeIs('posts.*') ? 'font-semibold text-pink-600' : '' }}">
                    Posts
                </a>

            </div>

            <!-- Right Side - Authentication -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <span class="text-gray-700 mr-4"> {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-pink-700">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 mr-4">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

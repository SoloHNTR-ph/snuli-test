<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s forwards;
            opacity: 0;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        [x-cloak] { display: none; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 text-gray-800 font-inter" x-data="{ openLogin: false, openMenu: false }" @click.away="openMenu = false">
    <!-- Header -->
    <header class="fixed top-0 left-0 w-full z-50" x-data="{ openMenu: false, scrolled: false }" x-init="
        window.addEventListener('scroll', () => { 
            scrolled = window.scrollY > 50 
        })
    ">
        <nav :class="scrolled ? 'bg-white shadow-lg' : 'bg-transparent'" class="transition-colors duration-300 w-full">
            <div class="container mx-auto flex items-center justify-between py-4 px-6">
                <div class="text-2xl font-bold" :class="scrolled ? 'text-[#8daef4]' : 'text-[#8daef4]'">
                    <a href="{{ route('home') }}" class="hover:text-[#555] transition-colors duration-300">Brand</a>
                </div>
                <div class="md:hidden">
                    <button @click="openMenu = !openMenu" :class="scrolled ? 'text-[#8daef4]' : 'text-white'" class="focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!openMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="openMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div :class="{'block': openMenu, 'hidden': !openMenu}" class="hidden md:block">
                    <div :class="scrolled ? 'text-gray-800' : 'text-white'" class="space-x-6 flex flex-col md:flex-row items-center">
                        @auth
                            <a href="{{ route('dashboard') }}" 
                               :class="scrolled ? 'text-[#8daef4]' : 'text-[#8daef4]'" 
                               class="hover:text-[#8daef4] transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:bg-[#8daef4] after:h-0.5 after:w-0 hover:after:w-full after:transition-all after:duration-300">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="bg-[#8daef4] text-white px-6 py-2 rounded-lg hover:bg-white hover:text-[#8daef4] transition-colors duration-300">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('home') }}" 
                               :class="scrolled ? 'text-[#8daef4]' : 'text-[#8daef4]'" 
                               class="hover:text-[#8daef4] transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:bg-[#8daef4] after:h-0.5 after:w-0 hover:after:w-full after:transition-all after:duration-300">
                                Home
                            </a>
                            <a href="{{ route('register') }}" 
                               :class="scrolled ? 'text-[#8daef4]' : 'text-[#8daef4]'" 
                               class="hover:text-[#8daef4] transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:bg-[#8daef4] after:h-0.5 after:w-0 hover:after:w-full after:transition-all after:duration-300">
                                Register
                            </a>
                            <button 
                                @click="openLogin = true"
                                class="bg-[#8daef4] text-white px-6 py-2 rounded-lg hover:bg-white hover:text-[#8daef4] transition-colors duration-300 mt-2 md:mt-0">
                                Login
                            </button>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#333] text-white py-6">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </footer>

    <!-- Login Modal -->
    @guest
        @include('components.login-modal')
    @endguest

    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('scripts')
</body>
</html>
<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
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
</head>
<body class="bg-gray-100 text-gray-800 font-inter" x-data="{ openLogin: false, openMenu: false }" @click.away="openMenu = false">
    <!-- Hero Section -->
    <div class="relative h-screen bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&q=80&w=2080');">
        <div class="absolute inset-0 bg-gradient-to-t from-[#333] to-transparent opacity-80"></div>


<!-- Header -->
<header class="fixed top-0 left-0 w-full z-50" x-data="{ openMenu: false, scrolled: false }" x-init="
    window.addEventListener('scroll', () => { 
        scrolled = window.scrollY > 50 
    })
">
    <nav :class="scrolled ? 'bg-white shadow-lg' : 'bg-transparent'" class="transition-colors duration-300 w-full">
        <!-- Inner Container -->
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <!-- Logo -->
            <div class="text-2xl font-bold" :class="scrolled ? 'text-[#8daef4]' : 'text-[#8daef4]'">
                <a href="/" class="hover:text-[#555] transition-colors duration-300">Brand</a>
            </div>
            <!-- Hamburger Menu (Mobile) -->
            <div class="md:hidden">
                <button @click="openMenu = !openMenu" :class="scrolled ? 'text-[#8daef4]' : 'text-white'" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!openMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="openMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Navigation Links -->
            <div :class="{'block': openMenu, 'hidden': !openMenu}" class="hidden md:block">
                <div :class="scrolled ? 'text-gray-800' : 'text-white'" class="space-x-6 flex flex-col md:flex-row items-center">
                    <a href="/" 
                    :class="scrolled ? 'text-[#8daef4]' : 'text-[#8daef4]'" 
                    class="hover:text-[#8daef4] transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:bg-[#8daef4] after:h-0.5 after:w-0 hover:after:w-full after:transition-all after:duration-300">
                        Home
                    </a>
                    <a href="/register" 
                    :class="scrolled ? 'text-[#8daef4]' : 'text-[#8daef4]'" 
                    class="hover:text-[#8daef4] transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:bg-[#8daef4] after:h-0.5 after:w-0 hover:after:w-full after:transition-all after:duration-300">
                        Register
                    </a>
                    <button 
                        @click="openLogin = true"
                        class="bg-[#8daef4] text-white px-6 py-2 rounded-lg hover:bg-white hover:text-[#8daef4] transition-colors duration-300 mt-2 md:mt-0">
                        Login
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>




<!-- Login Modal -->
<div 
    x-show="openLogin"
    x-transition:enter="transition-opacity ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50"
    x-cloak
    @keydown.escape="openLogin = false">
    <div 
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="bg-white w-full max-w-3xl rounded-2xl shadow-2xl p-8 flex flex-col md:flex-row relative">
        
        <!-- Close Button -->
        <button 
            @click="openLogin = false" 
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Left Section - Image & Promo -->
        <div class="md:w-1/2 mb-6 md:mb-0 relative overflow-hidden rounded-lg">
            <div class="absolute inset-0 bg-gradient-to-t from-[#8daef4]/90 to-transparent z-10"></div>
            <img src="https://img.freepik.com/free-photo/young-handsome-business-man-using-laptop-cafe_1303-20057.jpg?w=1380" 
                 alt="Business Man Using Laptop" 
                 class="rounded-lg object-cover h-64 md:h-full w-full transform hover:scale-105 transition-transform duration-500">
            <div class="absolute bottom-0 left-0 right-0 p-6 text-white z-20">
                <h3 class="text-xl font-bold mb-2">New to Snuli Hub?</h3>
                <p class="text-sm mb-4">Join our community and unlock exclusive features!</p>
                <a href="{{ route('register') }}" 
                   class="inline-block bg-white text-[#8daef4] px-4 py-2 rounded-lg font-medium hover:bg-[#8daef4] hover:text-white transition-colors duration-300">
                    Create Account
                </a>
            </div>
        </div>

        <!-- Form Section -->
        <div class="md:w-1/2 md:pl-8">
            <div class="text-center md:text-left mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Welcome Back!</h2>
                <p class="text-gray-600 text-sm mt-1">Please sign in to your account</p>
            </div>
            <form id="signinFormModal" class="space-y-6">
                @csrf
                <div class="relative">
                    <input type="email" 
                           id="emailModal" 
                           name="email"
                           class="peer w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8daef4] focus:border-transparent outline-none transition-all duration-300 placeholder-transparent"
                           placeholder="you@example.com"
                           required>
                    <label for="emailModal" 
                           class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-[#8daef4]">
                        Email Address
                    </label>
                </div>

                <div class="relative">
                    <input type="password" 
                           id="passwordModal" 
                           name="password"
                           class="peer w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8daef4] focus:border-transparent outline-none transition-all duration-300 placeholder-transparent pr-12"
                           placeholder="••••••••"
                           required>
                    <label for="passwordModal" 
                           class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-[#8daef4]">
                        Password
                    </label>
                    <button type="button" 
                            onclick="toggleModalPassword('passwordModal')"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-[#8daef4] focus:outline-none transition-all duration-300 ease-in-out hover:scale-110">
                        <svg class="h-5 w-5 modal-password-show" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg class="h-5 w-5 modal-password-hide hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox h-4 w-4 text-[#8daef4] rounded border-gray-300 focus:ring-[#8daef4]">
                        <span class="ml-2 text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-[#8daef4] hover:text-[#6b8cd5] font-medium">Forgot password?</a>
                </div>

                <button type="submit" 
                        class="w-full bg-[#8daef4] text-white py-3 px-4 rounded-lg hover:bg-[#6b8cd5] transform transition duration-300 hover:-translate-y-1 hover:shadow-lg font-medium">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</div>



        <!-- Hero Content -->
        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="text-center text-white px-6">
                <h1 class="text-5xl md:text-7xl font-extrabold mb-6 animate-fade-in" style="color: #8daef4;">Welcome to Elegance</h1>
                <p class="text-lg md:text-2xl mb-8 text-white animate-fade-in delay-200">Discover modern solutions with timeless sophistication.</p>
                <a href="#features" class="bg-[#8daef4] text-[#333] px-8 py-3 rounded-full shadow-md hover:bg-white hover:text-[#333] transition duration-300 animate-fade-in delay-400">
                    Learn More
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-gray-100">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Our Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="p-6 rounded-lg shadow-lg flex flex-col items-center text-center bg-white">
                    <img src="https://via.placeholder.com/100" alt="Feature One" class="mb-4" loading="lazy">
                    <h3 class="text-xl font-semibold mb-2">Feature One</h3>
                    <p class="text-gray-700">Brief description of Feature One.</p>
                </div>
                <div class="p-6 rounded-lg shadow-lg flex flex-col items-center text-center bg-white">
                    <img src="https://via.placeholder.com/100" alt="Feature Two" class="mb-4" loading="lazy">
                    <h3 class="text-xl font-semibold mb-2">Feature Two</h3>
                    <p class="text-gray-700">Brief description of Feature Two.</p>
                </div>
                <div class="p-6 rounded-lg shadow-lg flex flex-col items-center text-center bg-white">
                    <img src="https://via.placeholder.com/100" alt="Feature Three" class="mb-4" loading="lazy">
                    <h3 class="text-xl font-semibold mb-2">Feature Three</h3>
                    <p class="text-gray-700">Brief description of Feature Three.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#333] text-white py-6">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </footer>
    
<script src="//unpkg.com/alpinejs" defer></script>
    <!-- Add this script for password toggle -->
<script>
    function toggleModalPassword(inputId) {
        const input = document.getElementById(inputId);
        const button = input.nextElementSibling.nextElementSibling;
        const showIcon = button.querySelector('.modal-password-show');
        const hideIcon = button.querySelector('.modal-password-hide');

        // Add rotation animation classes
        showIcon.style.transform = 'rotate(180deg)';
        hideIcon.style.transform = 'rotate(180deg)';

        setTimeout(() => {
            if (input.type === 'password') {
                input.type = 'text';
                showIcon.classList.add('hidden');
                hideIcon.classList.remove('hidden');
                hideIcon.style.transform = 'rotate(0deg)';
            } else {
                input.type = 'password';
                showIcon.classList.remove('hidden');
                hideIcon.classList.add('hidden');
                showIcon.style.transform = 'rotate(0deg)';
            }
        }, 150);
    }
</script>
</body>
</html>

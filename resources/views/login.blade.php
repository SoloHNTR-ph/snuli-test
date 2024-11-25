<!-- resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign In - Snuli Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/firebase.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        @keyframes slideInFromLeft {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInFromRight {
            0% {
                transform: translateX(100%);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-in-left {
            animation: slideInFromLeft 0.8s ease forwards;
        }

        .slide-in-right {
            animation: slideInFromRight 0.8s ease forwards;
        }

        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }

        .animate-delay-200 {
            animation-delay: 0.2s;
        }

        .animate-delay-400 {
            animation-delay: 0.4s;
        }

        .bg-gradient {
            background: linear-gradient(135deg, #8daef4 0%, #6b8cd5 100%);
        }

        .input-focus-effect {
            transition: all 0.3s ease;
        }

        .input-focus-effect:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(141, 174, 244, 0.2);
        }

        [x-cloak] { display: none; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-inter">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full bg-white/80 backdrop-blur-md z-50 shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="text-2xl font-bold text-[#8daef4] hover:text-[#6b8cd5] transition-colors duration-300">
                    Snuli Hub
                </a>
                <a href="/" class="text-gray-600 hover:text-[#8daef4] transition-colors duration-300">
                    Back to Home
                </a>
            </div>
        </div>
    </nav>

    <div class="min-h-screen flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 bg-slate-200">
        <div class="max-w-5xl w-full space-y-8">
            <!-- Welcome Text -->
            <div class="text-center fade-in">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Welcome Back!</h1>
                <p class="text-lg text-gray-600">Sign in to access your Snuli Hub account</p>
            </div>

            <!-- Main Content -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    <!-- Left Side - Image & Text -->
                    <div class="md:w-1/2 relative bg-gradient p-8 text-white flex flex-col justify-center slide-in-left">
                        <div class="absolute top-0 left-0 w-full h-full opacity-30">
                            <img src="https://img.freepik.com/free-photo/young-handsome-business-man-using-laptop-cafe_1303-20057.jpg?w=1380" alt="Business Man Using Laptop" class="rounded-lg object-cover h-64 md:h-full w-full">
                        </div>
                        <div class="relative z-10 space-y-6">
                            <h2 class="text-3xl font-bold">Hello, Soy Enthusiast!</h2>
                            <p class="text-lg opacity-90">Sign in to access your personalized Snuli experience.</p>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Track your orders</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Access your favorite products</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Get exclusive member benefits</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Form -->
                    <div class="md:w-1/2 p-8 slide-in-right">
                        <form id="signinForm" class="space-y-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                <input type="email" id="email" name="email" required
                                       class="mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8daef4] focus:border-transparent outline-none input-focus-effect"
                                       placeholder="you@example.com">
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" id="password" name="password" required
                                       class="mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8daef4] focus:border-transparent outline-none input-focus-effect"
                                       placeholder="••••••••">
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="checkbox" id="remember_me" name="remember_me"
                                           class="h-4 w-4 text-[#8daef4] focus:ring-[#8daef4] border-gray-300 rounded">
                                    <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                        Remember me
                                    </label>
                                </div>

                                <div class="text-sm">
                                    <a href="#" class="text-[#8daef4] hover:text-[#6b8cd5] font-medium">
                                        Forgot password?
                                    </a>
                                </div>
                            </div>

                            <div>
                                <button type="submit" 
                                        class="w-full bg-[#8daef4] text-white py-3 px-4 rounded-lg hover:bg-[#6b8cd5] transform transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                                    Sign In
                                </button>
                            </div>

                            <div class="text-center">
                                <p class="text-sm text-gray-600">Don't have an account? 
                                    <a href="{{ route('register') }}" class="text-[#8daef4] hover:text-[#6b8cd5] font-medium">
                                        Create one now
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Social Proof -->
            <div class="text-center space-y-4 fade-in animate-delay-400">
                <p class="text-gray-600">Trusted by millions around the globe since 1998.</p>
                <div class="flex justify-center space-x-8">
                    <img src="https://via.placeholder.com/100x30" alt="Company 1" class="h-8 opacity-50 hover:opacity-100 transition-opacity">
                    <img src="https://via.placeholder.com/100x30" alt="Company 2" class="h-8 opacity-50 hover:opacity-100 transition-opacity">
                    <img src="https://via.placeholder.com/100x30" alt="Company 3" class="h-8 opacity-50 hover:opacity-100 transition-opacity">
                </div>
            </div>
        </div>
    </div>


</body>
</html>

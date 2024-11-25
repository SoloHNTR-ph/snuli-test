<!-- resources/views/register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Snuli Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/register.js'])
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
                    Brand
                </a>
                <a href="/" class="text-gray-600 hover:text-[#8daef4] transition-colors duration-300">
                    Back to Home
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 bg-slate-200">
        <div class="max-w-5xl w-full space-y-8">
            <!-- Welcome Text -->
            <div class="text-center fade-in">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Join Our Community</h1>
                <p class="text-lg text-gray-600">Create an account and unlock exclusive features</p>
            </div>

            <!-- Registration Form -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    <!-- Left Side - Image & Text -->
                    <div class="md:w-1/2 relative bg-gradient p-8 text-white flex flex-col justify-center slide-in-left">
                        <div class="absolute top-0 left-0 w-full h-full opacity-30">
                            <img src="https://img.freepik.com/free-photo/young-handsome-business-man-using-laptop-cafe_1303-20057.jpg?w=1380" alt="Business Man Using Laptop" class="rounded-lg object-cover h-64 md:h-full w-full">
                        </div>
                        <div class="relative z-10 space-y-6">
                            <h2 class="text-3xl font-bold">Welcome to Snuli Hub</h2>
                            <p class="text-lg opacity-90">Join thousands who count on Snuli as their trusted choice for all their soy needs!</p>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Access to exclusive features</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Regular updates and newsletters</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>24/7 customer support</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Form -->
                    <div class="md:w-1/2 p-8 slide-in-right">
                        <form id="registerForm" class="space-y-8">
                            <!-- Name Input Group -->
                            <div class="relative mb-6">
                                <input type="text" id="name" name="name" required
                                    class="peer w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8daef4] focus:border-transparent outline-none input-focus-effect bg-white placeholder-transparent"
                                    placeholder="John Doe">
                                <label for="name" 
                                    class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-[#8daef4]">
                                    Full Name
                                </label>
                                <div class="mt-2 text-xs text-gray-500">Enter your full name as it appears on official documents</div>
                            </div>

                            <!-- Email Input Group -->
                            <div class="relative mb-6">
                                <input type="email" id="email" name="email" required
                                    class="peer w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8daef4] focus:border-transparent outline-none input-focus-effect bg-white placeholder-transparent"
                                    placeholder="you@example.com">
                                <label for="email"
                                    class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-[#8daef4]">
                                    Email Address
                                </label>
                                <div class="mt-2 text-xs text-gray-500">We'll never share your email with anyone else</div>
                            </div>

                            <!-- Password Input Group -->
                            <div class="relative mb-6">
                                <div class="relative">
                                    <input type="password" id="password" name="password" required
                                        class="peer w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8daef4] focus:border-transparent outline-none input-focus-effect bg-white placeholder-transparent pr-12"
                                        placeholder="password">
                                    <button type="button" 
                                            onclick="togglePassword('password')" 
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-[#8daef4] focus:outline-none">
                                        <svg class="h-5 w-5 password-show" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg class="h-5 w-5 password-hide hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                    </button>
                                    <label for="password"
                                        class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-[#8daef4]">
                                        Password
                                    </label>
                                </div>
                                <div class="mt-2 text-xs text-gray-500">At least 8 characters with letters and numbers</div>
                            </div>

                            <!-- Confirm Password Input Group -->
                            <div class="relative mb-8">
                                <div class="relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation" required
                                        class="peer w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8daef4] focus:border-transparent outline-none input-focus-effect bg-white placeholder-transparent pr-12"
                                        placeholder="confirm password">
                                    <button type="button" 
                                            onclick="togglePassword('password_confirmation')" 
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-[#8daef4] focus:outline-none">
                                        <svg class="h-5 w-5 password-show" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg class="h-5 w-5 password-hide hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                    </button>
                                    <label for="password_confirmation"
                                        class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-[#8daef4]">
                                        Confirm Password
                                    </label>
                                </div>
                                <div class="mt-2 text-xs text-gray-500">Re-enter your password to confirm</div>
                            </div>

                            <!-- Button and Sign In Link -->
                            <div class="space-y-4">
                                <button type="submit" 
                                        class="w-full bg-[#8daef4] text-white py-3 px-4 rounded-lg hover:bg-[#6b8cd5] transform transition duration-300 hover:-translate-y-1 hover:shadow-lg font-medium">
                                    Create Account
                                </button>

                                <div class="text-center">
                                    <p class="text-sm text-gray-600">Already have an account? 
                                        <a href="/login" class="text-[#8daef4] hover:text-[#6b8cd5] font-medium">
                                            Sign in
                                        </a>
                                    </p>
                                </div>
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
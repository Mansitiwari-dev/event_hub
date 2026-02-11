<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6B46C1 0%, #9F7AEA 100%);
            min-height: 100vh;
        }
        .register-container {
            animation: fadeIn 0.6s ease-out;
        }
        .card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
            border-radius: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.3);
        }
        .input-field {
            transition: all 0.3s ease;
            border: 2px solid #E9D8FD;
        }
        .input-field:focus {
            border-color: #9F7AEA;
            box-shadow: 0 0 0 3px rgba(159, 122, 234, 0.2);
        }
        .btn-register {
            background: linear-gradient(135deg, #805AD5 0%, #6B46C1 100%);
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(107, 70, 193, 0.3);
        }
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: white;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .user-type-option {
            transition: all 0.3s ease;
            border: 2px solid #E9D8FD;
        }
        .user-type-option:hover {
            border-color: #9F7AEA;
        }
        .user-type-option input:checked + div {
            border-color: #6B46C1;
            background-color: #F5F3FF;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <!-- Navigation -->
    <nav class="bg-indigo-900 bg-opacity-90 text-white p-4 shadow-lg fixed w-full z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-purple-300 to-pink-300 bg-clip-text text-transparent">EventHub</a>
            </div>
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('home') }}#about" class="nav-link">About</a>
                <a href="{{ route('home') }}#services" class="nav-link">Services</a>
                <a href="{{ route('home') }}#contact" class="nav-link">Contact</a>
                <a href="{{ route('login') }}" class="bg-white text-indigo-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition">Login</a>
            </div>
            <button class="md:hidden text-white focus:outline-none" id="mobile-menu-button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-indigo-700">Home</a>
                <a href="{{ route('home') }}#about" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-indigo-700">About</a>
                <a href="{{ route('home') }}#services" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-indigo-700">Services</a>
                <a href="{{ route('home') }}#contact" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-indigo-700">Contact</a>
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-indigo-600 hover:bg-indigo-500">Login</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-4 register-container py-12">
        <div class="w-full max-w-4xl">
            <div class="card p-8">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Create Your Account</h1>
                    <p class="text-gray-600">Join EventHub to start planning your next event</p>
                    
                    @if($errors->any())
                    <div class="mt-4 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="name" type="text" name="name" required 
                                    class="input-field block w-full pl-10 pr-3 py-3 border rounded-lg focus:outline-none"
                                    placeholder="John Doe" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                </div>
                                <input id="email" type="email" name="email" required 
                                    class="input-field block w-full pl-10 pr-3 py-3 border rounded-lg focus:outline-none"
                                    placeholder="you@example.com" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input id="password" type="password" name="password" required 
                                    class="input-field block w-full pl-10 pr-3 py-3 border rounded-lg focus:outline-none"
                                    placeholder="••••••••">
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <input id="password_confirmation" type="password" name="password_confirmation" required 
                                    class="input-field block w-full pl-10 pr-3 py-3 border rounded-lg focus:outline-none"
                                    placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">I am a:</label>
                        <div class="grid grid-cols-1 md:grid-cols-{{ count($roles) }} gap-4">
                            @foreach($roles as $role)
                            <label class="user-type-option relative bg-white rounded-lg p-4 border-2 cursor-pointer">
                                <input type="radio" name="role_id" value="{{ $role->id }}" class="sr-only" {{ $loop->first ? 'checked' : '' }}>
                                <div class="flex flex-col items-center text-center p-2">
                                    @if($role->name === 'customer' || $role->name === 'user')
                                    <svg class="h-10 w-10 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    @elseif($role->name === 'vendor' || $role->name === 'service_provider')
                                    <svg class="h-10 w-10 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m-1-7v5m4-5v5m4-5v5m4-5v5" />
                                    </svg>
                                    @else
                                    <svg class="h-10 w-10 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    @endif
                                    <span class="font-medium text-gray-900">{{ $role->display_name ?? ucfirst($role->name) }}</span>
                                    <span class="text-sm text-gray-500">
                                        @if($role->name === 'customer' || $role->name === 'user')
                                            I want to plan events
                                        @elseif($role->name === 'vendor' || $role->name === 'service_provider')
                                            I provide event services
                                        @else
                                            I plan events and provide services
                                        @endif
                                    </span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" 
                            class="btn-register w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-medium text-purple-600 hover:text-purple-500">
                            Sign in here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-indigo-900 text-white">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span class="text-2xl font-bold bg-gradient-to-r from-purple-300 to-pink-300 bg-clip-text text-transparent">EventHub</span>
                    </div>
                    <p class="text-purple-200 text-sm">
                        Your premier destination for seamless event planning and management. 
                        We connect you with the best vendors and services to make your events unforgettable.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-purple-200 hover:text-white transition">Home</a></li>
                        <li><a href="#" class="text-purple-200 hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="text-purple-200 hover:text-white transition">Services</a></li>
                        <li><a href="#" class="text-purple-200 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Services</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-purple-200 hover:text-white transition">Event Planning</a></li>
                        <li><a href="#" class="text-purple-200 hover:text-white transition">Catering</a></li>
                        <li><a href="#" class="text-purple-200 hover:text-white transition">Decoration</a></li>
                        <li><a href="#" class="text-purple-200 hover:text-white transition">Photography</a></li>
                    </ul>
                </div>
                
                <div class="col-span-1 md:col-span-2 md:col-start-3">
                    <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                    <address class="not-italic text-purple-200">
                        <p class="flex items-start mb-2">
                            <svg class="h-5 w-5 mr-2 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            123 Event Street, City
                        </p>
                        <p class="flex items-center mb-2">
                            <svg class="h-5 w-5 mr-2 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            info@eventhub.com
                        </p>
                        <p class="flex items-center">
                            <svg class="h-5 w-5 mr-2 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            +1 234 567 890
                        </p>
                    </address>
                </div>
            </div>
            
            <div class="border-t border-purple-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-purple-300 text-sm mb-4 md:mb-0">© 2026 EventHub. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-purple-300 hover:text-white transition">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-purple-300 hover:text-white transition">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                        </svg>
                    </a>
                    <a href="#" class="text-purple-300 hover:text-white transition">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Toggle mobile menu
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Add animation to form elements
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-purple-300', 'rounded-lg');
                });
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-purple-300', 'rounded-lg');
                });
            });

            // User type selection
            const userTypeOptions = document.querySelectorAll('.user-type-option');
            userTypeOptions.forEach(option => {
                option.addEventListener('click', function() {
                    userTypeOptions.forEach(opt => {
                        opt.classList.remove('border-purple-500', 'bg-purple-50');
                    });
                    this.classList.add('border-purple-500', 'bg-purple-50');
                });
            });
        });
    </script>
</body>
</html>
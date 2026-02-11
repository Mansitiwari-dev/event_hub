<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventHub - Your Event Planning Partner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        }
        .hero {
            background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #7c3aed 100%);
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
            background: linear-gradient(90deg, #f472b6, #ec4899);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .service-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(124, 58, 237, 0.15);
            border-color: #d8d8ff;
        }
        .feature-icon {
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.1), rgba(236, 72, 153, 0.1));
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-indigo-900 via-purple-900 to-indigo-900 text-white p-4 shadow-2xl fixed w-full z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3 group cursor-pointer">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-400 rounded-lg flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-purple-300 via-pink-300 to-purple-300 bg-clip-text text-transparent">EventHub</span>
            </div>
            <div class="hidden md:flex space-x-8">
                <a href="#home" class="nav-link text-purple-100 hover:text-white">Home</a>
                <a href="#about" class="nav-link text-purple-100 hover:text-white">About</a>
                <a href="#services" class="nav-link text-purple-100 hover:text-white">Services</a>
                <a href="#contact" class="nav-link text-purple-100 hover:text-white">Contact</a>
                <a href="{{ route('login') }}" class="bg-gradient-to-r from-purple-400 to-pink-400 hover:from-purple-500 hover:to-pink-500 text-white px-6 py-2 rounded-lg font-medium transition-all duration-300 hover:shadow-lg transform hover:scale-105">Login</a>
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
                <a href="#home" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-purple-700 hover:bg-opacity-50 transition">Home</a>
                <a href="#about" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-purple-700 hover:bg-opacity-50 transition">About</a>
                <a href="#services" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-purple-700 hover:bg-opacity-50 transition">Services</a>
                <a href="#contact" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-purple-700 hover:bg-opacity-50 transition">Contact</a>
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 transition">Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero text-white pt-32 pb-20 px-4 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse delay-7000"></div>
        </div>
        
        <div class="container mx-auto flex flex-col md:flex-row items-center relative z-10">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-5xl md:text-6xl font-black leading-tight mb-6 drop-shadow-lg">Plan Memorable Events with EventHub</h1>
                <p class="text-xl text-purple-100 mb-8 drop-shadow-md">Connect with trusted vendors, manage bookings, and delight your guests — all in one place.</p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('register') }}" class="bg-white text-purple-700 px-8 py-4 rounded-lg font-bold text-center hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">Get Started</a>
                    <a href="#services" class="border-2 border-white text-white px-8 py-4 rounded-lg font-bold text-center hover:bg-white hover:bg-opacity-10 transition-all duration-300 backdrop-blur">Explore Services</a>
                </div>
            </div>
            <div class="md:w-1/2">
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" 
                     alt="Event Planning" 
                     class="rounded-2xl shadow-2xl w-full max-w-lg mx-auto transform hover:scale-105 transition-transform duration-500 border-4 border-white border-opacity-20">
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 px-4 bg-white">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">Our Services</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto mb-6 rounded-full"></div>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Discover our comprehensive event planning services to make your special day unforgettable.</p>
            </div>

            <!-- Feature Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="service-card bg-white p-8 rounded-2xl text-center hover:border-purple-300">
                    <div class="feature-icon w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-3xl bg-gradient-to-br from-purple-600 to-pink-600 bg-clip-text text-transparent"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Discover Vendors</h3>
                    <p class="text-gray-600 text-lg">Find the best vendors for your event needs with our curated directory of trusted professionals.</p>
                </div>
                <div class="service-card bg-white p-8 rounded-2xl text-center hover:border-purple-300">
                    <div class="feature-icon w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-calendar-plus text-3xl bg-gradient-to-br from-purple-600 to-pink-600 bg-clip-text text-transparent"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Create Events</h3>
                    <p class="text-gray-600 text-lg">Easily plan and organize events with our intuitive tools and comprehensive management system.</p>
                </div>
                <div class="service-card bg-white p-8 rounded-2xl text-center hover:border-purple-300">
                    <div class="feature-icon w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-lock text-3xl bg-gradient-to-br from-purple-600 to-pink-600 bg-clip-text text-transparent"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Secure Bookings</h3>
                    <p class="text-gray-600 text-lg">Book with confidence using our secure payment and booking system with 24/7 support.</p>
                </div>
            </div>

            <!-- Popular Services -->
            <div class="text-center mb-16">
                <h3 class="text-3xl font-bold text-gray-900 mb-8">Popular Services</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="service-card bg-white rounded-2xl overflow-hidden shadow-md hover:border-purple-300">
                        <div class="h-56 bg-cover bg-center relative overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1505373876331-ff89baa0208f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80')">
                            <div class="absolute inset-0 bg-gradient-to-t from-purple-900 to-transparent opacity-40"></div>
                        </div>
                        <div class="p-6">
                            <h4 class="font-bold text-xl text-gray-900 mb-2">🎉 Event Planning</h4>
                            <p class="text-gray-600 text-sm">Category: Planning & Coordination</p>
                            <a href="#" class="inline-block mt-4 text-purple-600 font-semibold hover:text-pink-600 transition">Learn More →</a>
                        </div>
                    </div>
                    <div class="service-card bg-white rounded-2xl overflow-hidden shadow-md hover:border-purple-300">
                        <div class="h-56 bg-cover bg-center relative overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1556911220-b31f6e0c0d8d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80')">
                            <div class="absolute inset-0 bg-gradient-to-t from-purple-900 to-transparent opacity-40"></div>
                        </div>
                        <div class="p-6">
                            <h4 class="font-bold text-xl text-gray-900 mb-2">🍽️ Catering</h4>
                            <p class="text-gray-600 text-sm">Category: Food & Beverages</p>
                            <a href="#" class="inline-block mt-4 text-purple-600 font-semibold hover:text-pink-600 transition">Learn More →</a>
                        </div>
                    </div>
                    <div class="service-card bg-white rounded-2xl overflow-hidden shadow-md hover:border-purple-300">
                        <div class="h-56 bg-cover bg-center relative overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80')">
                            <div class="absolute inset-0 bg-gradient-to-t from-purple-900 to-transparent opacity-40"></div>
                        </div>
                        <div class="p-6">
                            <h4 class="font-bold text-xl text-gray-900 mb-2">📸 Photography</h4>
                            <p class="text-gray-600 text-sm">Category: Media & Documentation</p>
                            <a href="#" class="inline-block mt-4 text-purple-600 font-semibold hover:text-pink-600 transition">Learn More →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section id="about" class="py-20 px-4 bg-gradient-to-br from-slate-50 to-slate-100">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">Why Choose EventHub?</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto mb-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="service-card bg-white p-8 rounded-2xl text-center border border-purple-100 hover:border-purple-300 hover:shadow-xl">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-check-circle text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Trusted Vendors</h3>
                    <p class="text-gray-600">Verified professionals with proven track records for reliable service.</p>
                </div>
                <div class="service-card bg-white p-8 rounded-2xl text-center border border-purple-100 hover:border-purple-300 hover:shadow-xl">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-headset text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">24/7 Support</h3>
                    <p class="text-gray-600">Round-the-clock assistance to ensure your event runs smoothly.</p>
                </div>
                <div class="service-card bg-white p-8 rounded-2xl text-center border border-purple-100 hover:border-purple-300 hover:shadow-xl">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-calendar-check text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Easy Booking</h3>
                    <p class="text-gray-600">Simple and secure booking process with transparent pricing.</p>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl p-12 text-white text-center">
                <h3 class="text-3xl font-bold mb-4">Join Our Community</h3>
                <p class="text-lg text-purple-100 mb-6">Thousands of happy customers have already planned their best events with EventHub.</p>
                <a href="{{ route('register') }}" class="bg-white text-purple-700 font-bold px-8 py-3 rounded-lg hover:bg-gray-100 transition-all duration-300 hover:shadow-lg inline-block">Start Planning Now</a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 bg-gradient-to-r from-indigo-900 via-purple-900 to-indigo-900 text-white">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-black mb-6">Ready to Plan Your Next Event?</h2>
            <p class="text-xl text-purple-100 mb-10 max-w-2xl mx-auto">Join thousands of happy customers who trust EventHub for their event planning needs.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-white text-purple-700 px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">Get Started Now</a>
                <a href="#services" class="border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:bg-opacity-10 transition-all duration-300">Explore Services</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-950 text-white pt-20 pb-8 px-4">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-400 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-purple-300 to-pink-300 bg-clip-text text-transparent">EventHub</span>
                    </div>
                    <p class="text-purple-200 text-sm leading-relaxed">
                        Your premier destination for seamless event planning and management.
                    </p>
                </div>

                
                <div>
                    <h3 class="text-lg font-bold mb-6 text-white">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="#home" class="text-purple-200 hover:text-white transition text-sm">Home</a></li>
                        <li><a href="#about" class="text-purple-200 hover:text-white transition text-sm">About Us</a></li>
                        <li><a href="#services" class="text-purple-200 hover:text-white transition text-sm">Services</a></li>
                        <li><a href="#contact" class="text-purple-200 hover:text-white transition text-sm">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-6 text-white">Services</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-purple-200 hover:text-white transition text-sm">🎉 Event Planning</a></li>
                        <li><a href="#" class="text-purple-200 hover:text-white transition text-sm">🍽️ Catering</a></li>
                        <li><a href="#" class="text-purple-200 hover:text-white transition text-sm">✨ Decoration</a></li>
                        <li><a href="#" class="text-purple-200 hover:text-white transition text-sm">📸 Photography</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-6 text-white">Contact Us</h3>
                    <address class="not-italic text-purple-200 space-y-3 text-sm">
                        <p class="flex items-start">
                            <i class="fas fa-map-marker-alt mr-3 text-purple-300 mt-1 flex-shrink-0"></i>
                            <span>123 Event Street, City</span>
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-purple-300 flex-shrink-0"></i>
                            <a href="mailto:info@eventhub.com" class="hover:text-white transition">info@eventhub.com</a>
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-purple-300 flex-shrink-0"></i>
                            <a href="tel:+12345678900" class="hover:text-white transition">+1 234 567 890</a>
                        </p>
                    </address>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-purple-300 text-sm mb-4 md:mb-0">© 2026 EventHub. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-purple-300 hover:text-white transition text-lg">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-purple-300 hover:text-white transition text-lg">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-purple-300 hover:text-white transition text-lg">
                        <i class="fab fa-instagram"></i>
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

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    // Close mobile menu if open
                    const mobileMenu = document.getElementById('mobile-menu');
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                    
                    // Scroll to the target
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>
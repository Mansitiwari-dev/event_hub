<footer class="bg-gradient-to-r from-slate-900 to-slate-800 text-white py-12 border-t border-slate-700 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <!-- Brand Section -->
            <div>
                <h5 class="text-xl font-bold mb-4 flex items-center gap-2">
                    <span class="text-2xl">📅</span>EventHub
                </h5>
                <p class="text-slate-300 text-sm leading-relaxed">Your premier destination for seamless event planning and management. We connect you with the best vendors and services to make your events unforgettable.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h5 class="text-lg font-bold mb-4 text-white uppercase tracking-wider">Quick Links</h5>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-slate-300 hover:text-white transition-colors duration-200">Home</a></li>
                    <li><a href="{{ route('home') }}" class="text-slate-300 hover:text-white transition-colors duration-200">About Us</a></li>
                    <li><a href="{{ route('home') }}" class="text-slate-300 hover:text-white transition-colors duration-200">Services</a></li>
                    <li><a href="{{ route('home') }}" class="text-slate-300 hover:text-white transition-colors duration-200">Contact</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h5 class="text-lg font-bold mb-4 text-white uppercase tracking-wider">Services</h5>
                <ul class="space-y-2">
                    <li class="text-slate-300">✓ Event Planning</li>
                    <li class="text-slate-300">✓ Catering</li>
                    <li class="text-slate-300">✓ Decoration</li>
                    <li class="text-slate-300">✓ Photography</li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h5 class="text-lg font-bold mb-4 text-white uppercase tracking-wider">Contact Us</h5>
                <ul class="space-y-2 text-slate-300">
                    <li class="flex gap-2">📍 123 Event Street, City</li>
                    <li class="flex gap-2">✉️ info@eventhub.com</li>
                    <li class="flex gap-2">📞 +1 234 567 890</li>
                    <li class="flex gap-4 mt-3 pt-3 border-t border-slate-700">
                        <a href="#" class="text-slate-300 hover:text-white transition-colors duration-200">f</a>
                        <a href="#" class="text-slate-300 hover:text-white transition-colors duration-200">𝕏</a>
                        <a href="#" class="text-slate-300 hover:text-white transition-colors duration-200">📷</a>
                        <a href="#" class="text-slate-300 hover:text-white transition-colors duration-200">in</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-slate-700 pt-8">
            <p class="text-center text-slate-400 text-sm">&copy; {{ date('Y') }} EventHub. All rights reserved.</p>
        </div>
    </div>
</footer>
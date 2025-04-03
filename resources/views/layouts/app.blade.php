<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite('resources/css/app.css')

    <!-- Scripts -->
    @vite('resources/js/app.js')
    @livewireStyles
</head>

<body class="font-sans antialiased bg-background text-foreground min-h-screen flex flex-col">
    <header class="border-b">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center py-3">
                <a href="{{ route('home') }}" class="text-xl font-bold"> {{ config('app.name', 'Felix') }}
                </a>

                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}"
                        class="text-sm font-medium hover:text-primary transition-colors duration-200">Home</a>
                    <a href="{{ route('products') }}"
                        class="text-sm font-medium hover:text-primary transition-colors duration-200">Shop</a>
                    <a href="#"
                        class="text-sm font-medium hover:text-primary transition-colors duration-200">About</a>
                    <a href="#"
                        class="text-sm font-medium hover:text-primary transition-colors duration-200">Contact</a>
                </nav>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('cart') }}"
                        class="relative p-2 rounded-full hover:bg-accent transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-shopping-cart">
                            <circle cx="8" cy="21" r="1" />
                            <circle cx="19" cy="21" r="1" />
                            <path
                                d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                        </svg>
                        @livewire('cart-counter')
                    </a>

                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-1 focus:outline-none">
                                <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-chevron-down">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-popover rounded-md shadow-md py-1 z-10 border">
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm hover:bg-accent transition-colors duration-200">Profile</a>
                                <a href="{{ route('orders') }}"
                                    class="block px-4 py-2 text-sm hover:bg-accent transition-colors duration-200">My
                                    Orders</a>
                                <a href="{{ route('filament.admin.auth.login') }}"
                                    class="block px-4 py-2 text-sm hover:bg-accent transition-colors duration-200">My
                                    Admin Panel</a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm hover:bg-accent transition-colors duration-200">
                                        Log Out
                                    </button>
                                </form>

                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium hover:text-primary transition-colors duration-200">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <footer class="border-t py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4"> {{ config('app.name', 'Felix') }}
                    </h3>
                    <p class="text-muted-foreground">Your trusted source for game collectibles and memorabilia.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}"
                                class="text-muted-foreground hover:text-foreground transition-colors duration-200">Home</a>
                        </li>
                        <li><a href="{{ route('products') }}"
                                class="text-muted-foreground hover:text-foreground transition-colors duration-200">Shop</a>
                        </li>
                        <li><a href="#"
                                class="text-muted-foreground hover:text-foreground transition-colors duration-200">About
                                Us</a></li>
                        <li><a href="#"
                                class="text-muted-foreground hover:text-foreground transition-colors duration-200">Contact</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Customer Service</h3>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-muted-foreground hover:text-foreground transition-colors duration-200">FAQ</a>
                        </li>
                        <li><a href="#"
                                class="text-muted-foreground hover:text-foreground transition-colors duration-200">Shipping
                                Policy</a></li>
                        <li><a href="#"
                                class="text-muted-foreground hover:text-foreground transition-colors duration-200">Return
                                Policy</a></li>
                        <li><a href="#"
                                class="text-muted-foreground hover:text-foreground transition-colors duration-200">Privacy
                                Policy</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                    <p class="text-muted-foreground mb-4">Subscribe to receive updates on new arrivals and special
                        offers.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email"
                            class="px-3 py-2 rounded-l-md w-full focus:outline-none focus:ring-2 focus:ring-ring border border-input bg-background">
                        <button type="submit"
                            class="bg-primary text-primary-foreground px-4 py-2 rounded-r-md hover:bg-primary/90 transition-colors duration-200">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t text-center text-muted-foreground">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Felix') }}
                    . All rights reserved.</p>
            </div>
        </div>
    </footer>

    @livewireScripts
    <script>
        // Update cart count when cart is updated
        Livewire.on('cartUpdated', () => {
            fetch('/cart-count')
                .then(response => response.json())
                .then(data => {
                    document.querySelector('.cart-count').textContent = data.count;
                });
        });
    </script>
</body>

</html>

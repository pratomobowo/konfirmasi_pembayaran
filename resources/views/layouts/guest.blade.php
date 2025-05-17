<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Konfirmasi Pembayaran Mahasiswa') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- Additional Font for Header -->
        <link href="https://fonts.bunny.net/css?family=montserrat:600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            /* Custom styles for modern header */
            .modern-header {
                background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            }
            
            /* Footer style */
            .modern-footer {
                background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
                box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
            }
            
            .nav-link {
                position: relative;
                transition: all 0.3s ease;
            }
            
            .nav-link:after {
                content: '';
                position: absolute;
                width: 0;
                height: 2px;
                bottom: 0;
                left: 50%;
                background-color: #ffffff;
                transform: translateX(-50%);
                transition: width 0.3s ease;
            }
            
            .nav-link:hover:after {
                width: 80%;
            }
            
            .logo-text {
                font-family: 'Montserrat', sans-serif;
                font-weight: 700;
                letter-spacing: 0.5px;
            }
            
            .header-btn {
                transition: all 0.3s ease;
            }
            
            .header-btn:hover {
                transform: translateY(-2px);
            }
            
            .mobile-menu {
                transition: all 0.3s ease;
                transform-origin: top;
            }
            
            .mobile-menu.hidden {
                transform: scaleY(0);
                opacity: 0;
            }
            
            .mobile-menu:not(.hidden) {
                transform: scaleY(1);
                opacity: 1;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50">
        <!-- Modern Header -->
        <header class="modern-header">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 sm:h-20">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('home') }}" class="flex items-center group">
                                <img src="{{ asset('images/logo.png') }}" alt="USBYPKP Logo" class="h-8 sm:h-12 w-auto">
                            </a>
                        </div>
                        
                        <!-- Navigation Links -->
                        <div class="hidden ml-10 space-x-8 sm:flex">
                            <a href="{{ route('home') }}" class="nav-link text-white hover:text-white/90 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                            <a href="{{ route('payment.create') }}" class="nav-link text-white hover:text-white/90 px-3 py-2 rounded-md text-sm font-medium">Upload Pembayaran</a>
                            <a href="{{ route('payment.track') }}" class="nav-link text-white hover:text-white/90 px-3 py-2 rounded-md text-sm font-medium">Cek Status</a>
                        </div>
                    </div>
                    
                    <!-- Right Side Links - Hidden on mobile -->
                    <div class="hidden sm:flex items-center">
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="header-btn bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-full text-sm font-medium shadow-md">
                                <div class="flex items-center">
                                    <span>Dashboard Admin</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="header-btn bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-full text-sm font-medium shadow-md">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Login Admin</span>
                                </div>
                            </a>
                        @endauth
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <div class="flex items-center sm:hidden">
                        <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div class="sm:hidden hidden mobile-menu bg-blue-800">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('home') }}" class="text-white hover:bg-blue-700 block px-3 py-2 rounded-md text-base font-medium">Beranda</a>
                    <a href="{{ route('payment.create') }}" class="text-white hover:bg-blue-700 block px-3 py-2 rounded-md text-base font-medium">Upload Pembayaran</a>
                    <a href="{{ route('payment.track') }}" class="text-white hover:bg-blue-700 block px-3 py-2 rounded-md text-base font-medium">Cek Status</a>
                    
                    <!-- Login button in mobile menu -->
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center text-white hover:bg-blue-700 px-3 py-2 rounded-md text-base font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center text-white hover:bg-blue-700 px-3 py-2 rounded-md text-base font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Login Admin
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        
        <!-- Modern Footer -->
        <footer class="modern-footer mt-12 py-8 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="md:flex md:justify-between">
                    <div class="mb-6 md:mb-0">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <img src="{{ asset('images/logo.png') }}" alt="USBYPKP Logo" class="h-10 w-auto">
                        </a>
                        <p class="mt-2 text-sm text-blue-100">
                            Sistem Konfirmasi Pembayaran Mahasiswa
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-8 sm:grid-cols-3">
                        <div>
                            <h3 class="text-sm font-semibold text-white uppercase tracking-wider">Menu</h3>
                            <ul class="mt-4 space-y-2">
                                <li>
                                    <a href="{{ route('home') }}" class="text-blue-100 hover:text-white">Beranda</a>
                                </li>
                                <li>
                                    <a href="{{ route('payment.create') }}" class="text-blue-100 hover:text-white">Upload Pembayaran</a>
                                </li>
                                <li>
                                    <a href="{{ route('payment.track') }}" class="text-blue-100 hover:text-white">Cek Status</a>
                                </li>
                            </ul>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-semibold text-white uppercase tracking-wider">Hubungi Kami</h3>
                            <ul class="mt-4 space-y-2">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-200 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-blue-100">keuangan@uusbypkp.ac.id</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-200 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span class="text-blue-100">(021) 1234-5678</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <hr class="my-6 border-blue-400/30">
                <div class="flex flex-col sm:flex-row justify-between">
                    <p class="text-sm text-blue-200">
                        © {{ date('Y') }} USBYPKP. Seluruh Hak Cipta Dilindungi.
                    </p>
                </div>
            </div>
        </footer>
        
        <script>
            // Mobile menu toggle
            document.addEventListener('DOMContentLoaded', function() {
                const mobileMenuButton = document.querySelector('.mobile-menu-button');
                const mobileMenu = document.querySelector('.mobile-menu');
                
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            });
        </script>
    </body>
</html>

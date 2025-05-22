<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>{{ config('app.name', 'Aplikasi Konfirmasi Keuangan') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar / Navigation (hidden on mobile) -->
        <div class="hidden md:flex md:flex-col md:w-64 md:fixed md:inset-y-0 bg-gradient-to-b from-blue-700 to-blue-900 text-white shadow-lg z-30">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 border-b border-blue-800">
            <img src="{{ asset('images/logo.png') }}" alt="USBYPKP Logo" class="h-8 sm:h-12 w-auto">
            </div>
            
            <!-- Navigation Items -->
            <div class="flex-1 flex flex-col overflow-y-auto pt-5 pb-4">
                <nav class="flex-1 px-4 space-y-3">
                    <x-admin-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </x-admin-nav-link>

                    <x-admin-nav-link :href="route('admin.payments')" :active="request()->routeIs('admin.payments*')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Pembayaran
                    </x-admin-nav-link>

                    <x-admin-nav-link :href="route('admin.payment-types.index')" :active="request()->routeIs('admin.payment-types*')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                        </svg>
                        Jenis Pembayaran
                    </x-admin-nav-link>

                    <x-admin-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users*')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Pengguna
                    </x-admin-nav-link>

                    <x-admin-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.*')">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Laporan
                    </x-admin-nav-link>

                    @if(Auth::user()->isSuperAdmin())
                    <x-admin-nav-link :href="route('admin.activity-logs.index')" :active="request()->routeIs('admin.activity-logs*')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                        Log Aktivitas
                    </x-admin-nav-link>
                    @endif

                    <x-admin-nav-link :href="route('admin.documentation.index')" :active="request()->routeIs('admin.documentation*')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Dokumentasi
                    </x-admin-nav-link>

                    <div class="relative">
                        <button type="button" id="settings-button" class="w-full flex items-center px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Pengaturan
                            <svg id="settings-arrow" class="ml-2 h-4 w-4 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Settings Dropdown Menu -->
                        <div id="settings-dropdown" class="ml-8 space-y-1 hidden">
                            <a href="{{ route('admin.settings.smtp') }}" class="flex items-center px-4 py-2 text-sm text-white hover:bg-blue-800 rounded-md {{ request()->routeIs('admin.settings.smtp*') ? 'bg-blue-800' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                SMTP
                            </a>

                            <a href="{{ route('admin.email-templates.index') }}" class="flex items-center px-4 py-2 text-sm text-white hover:bg-blue-800 rounded-md {{ request()->routeIs('admin.email-templates.*') ? 'bg-blue-800' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                </svg>
                                Template Email
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            
            <!-- User Info -->
            <div class="border-t border-blue-800 p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 rounded-full bg-blue-600 p-1 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                        <div class="flex items-center mt-1 text-xs text-blue-300">
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="flex items-center text-blue-300 hover:text-white">
                                    <svg class="mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu button and top bar -->
        <div class="md:hidden fixed top-0 left-0 z-50 bg-white w-full border-b border-gray-200 flex items-center justify-between p-2 shadow-sm">
            <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-blue-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path class="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path class="hidden close-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span class="ml-2 text-base font-semibold truncate">Aplikasi Konfirmasi Keuangan</span>
            </button>
            <div class="flex items-center">
                <div class="text-sm mr-3 hidden sm:block">{{ Auth::user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}" class="inline-block">
                    @csrf
                    <button type="submit" class="p-1 rounded-md text-gray-600 hover:text-blue-600 focus:outline-none flex items-center" title="Logout">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
                </form>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state -->
        <div class="md:hidden fixed inset-0 z-40 hidden" id="mobile-menu">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
            <div class="fixed left-0 inset-y-0 max-w-xs w-full bg-indigo-900 shadow-xl overflow-y-auto">
                <div class="flex items-center justify-between px-4 py-3 border-b border-indigo-800">
                    <div class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="USBYPKP Logo" class="h-8 w-auto mr-2">
                        <span class="text-white font-medium">Admin Panel</span>
                    </div>
                    <button id="close-mobile-menu" class="text-white hover:text-gray-200 focus:outline-none">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="py-4">
                    <div class="px-2 space-y-1">
                        <a href="{{ route('admin.dashboard') }}" class="block p-2 rounded-md text-white hover:bg-indigo-800 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-800' : '' }}">
                            <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                                <span>Dashboard</span>
                            </div>
                        </a>

                        <a href="{{ route('admin.payments') }}" class="block p-2 rounded-md text-white hover:bg-indigo-800 {{ request()->routeIs('admin.payments*') ? 'bg-indigo-800' : '' }}">
                            <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                                <span>Pembayaran</span>
                            </div>
                        </a>

                        <a href="{{ route('admin.payment-types.index') }}" class="block p-2 rounded-md text-white hover:bg-indigo-800 {{ request()->routeIs('admin.payment-types*') ? 'bg-indigo-800' : '' }}">
                            <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                            </svg>
                                <span>Jenis Pembayaran</span>
                            </div>
                        </a>

                        <a href="{{ route('admin.users.index') }}" class="block p-2 rounded-md text-white hover:bg-indigo-800 {{ request()->routeIs('admin.users*') ? 'bg-indigo-800' : '' }}">
                            <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                                <span>Pengguna</span>
                            </div>
                        </a>

                        <a href="{{ route('admin.reports.index') }}" class="block p-2 rounded-md text-white hover:bg-indigo-800 {{ request()->routeIs('admin.reports.*') ? 'bg-indigo-800' : '' }}">
                            <div class="flex items-center">
                            <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                                <span>Laporan</span>
                            </div>
                        </a>

                        <a href="{{ route('admin.documentation.index') }}" class="block p-2 rounded-md text-white hover:bg-indigo-800 {{ request()->routeIs('admin.documentation*') ? 'bg-indigo-800' : '' }}">
                            <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                                <span>Dokumentasi</span>
                            </div>
                        </a>
                        
                        @if(Auth::user()->isSuperAdmin())
                        <a href="{{ route('admin.activity-logs.index') }}" class="block p-2 rounded-md text-white hover:bg-indigo-800 {{ request()->routeIs('admin.activity-logs*') ? 'bg-indigo-800' : '' }}">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <span>Log Aktivitas</span>
                            </div>
                        </a>
                        @endif
                        
                        <div class="relative mt-4">
                            <button type="button" id="mobile-settings-button" class="w-full flex justify-between items-center p-2 rounded-md text-white hover:bg-indigo-800">
                                <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                    <span>Pengaturan</span>
                                </div>
                                <svg id="mobile-settings-arrow" class="h-5 w-5 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Mobile Settings Dropdown Menu -->
                            <div id="mobile-settings-dropdown" class="mt-1 pl-10 space-y-1 hidden">
                                <a href="{{ route('admin.settings.smtp') }}" class="block p-2 rounded-md text-white hover:bg-indigo-800 {{ request()->routeIs('admin.settings.smtp*') ? 'bg-indigo-800' : '' }}">
                                    <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                        <span>SMTP</span>
                                    </div>
                                </a>
                                <a href="{{ route('admin.email-templates.index') }}" class="block p-2 rounded-md text-white hover:bg-indigo-800 {{ request()->routeIs('admin.email-templates.*') ? 'bg-indigo-800' : '' }}">
                                    <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                    </svg>
                                        <span>Template Email</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                </div>
                    
                    <!-- User info in mobile menu -->
                    <div class="mt-6 pt-4 border-t border-indigo-800 mx-2">
                        <div class="flex items-center px-2">
                        <div class="flex-shrink-0">
                                <svg class="h-10 w-10 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-base font-medium text-white">{{ Auth::user()->name }}</p>
                                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                                @csrf
                                    <button type="submit" class="text-sm text-indigo-300 hover:text-white flex items-center">
                                        <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content area -->
        <div class="flex-1 md:ml-64">
            <!-- Top padding for mobile only to push content below mobile header -->
            <div class="md:hidden h-14"></div>

                <!-- Page Content -->
            <main class="py-6 px-4 sm:px-6 lg:px-8">
                        @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const closeMobileMenu = document.getElementById('close-mobile-menu');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                        mobileMenu.classList.toggle('hidden');
                    // When menu is visible, add overflow hidden to body to prevent scrolling
                    if (!mobileMenu.classList.contains('hidden')) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow = '';
                    }
                });
            }

            if (closeMobileMenu && mobileMenu) {
                closeMobileMenu.addEventListener('click', function() {
                        mobileMenu.classList.add('hidden');
                    document.body.style.overflow = '';
                });
            }

            // Settings dropdown toggle
            const settingsButton = document.getElementById('settings-button');
            const settingsDropdown = document.getElementById('settings-dropdown');
            const settingsArrow = document.getElementById('settings-arrow');
            
            if (settingsButton && settingsDropdown && settingsArrow) {
                settingsButton.addEventListener('click', function() {
                    settingsDropdown.classList.toggle('hidden');
                    settingsArrow.classList.toggle('rotate-180');
                });
            }

            // Mobile settings dropdown
            const mobileSettingsButton = document.getElementById('mobile-settings-button');
            const mobileSettingsDropdown = document.getElementById('mobile-settings-dropdown');
            const mobileSettingsArrow = document.getElementById('mobile-settings-arrow');
            
            if (mobileSettingsButton && mobileSettingsDropdown && mobileSettingsArrow) {
                mobileSettingsButton.addEventListener('click', function() {
                    mobileSettingsDropdown.classList.toggle('hidden');
                    mobileSettingsArrow.classList.toggle('rotate-180');
                });
            }
        });
    </script>
    
    <!-- Alpine.js for interactive components -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @stack('scripts')
</body>
</html> 
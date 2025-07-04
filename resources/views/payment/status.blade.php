<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Konfirmasi Pembayaran Mahasiswa') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('home') }}" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="ml-3 text-xl font-bold text-gray-900">USBYPKP</span>
                            </a>
                        </div>
                        
                        <!-- Navigation Links -->
                        <div class="hidden ml-10 space-x-8 sm:flex">
                            <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                            <a href="{{ route('payment.create') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Upload Pembayaran</a>
                            <a href="{{ route('payment.track') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Cek Status</a>
                        </div>
                    </div>
                    
                    <!-- Right Side Links -->
                    <div class="flex items-center">
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium mr-2">Dashboard Admin</a>
                        @else
                            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium mr-2">Login Admin</a>
                        @endauth
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <div class="flex items-center sm:hidden">
                        <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" aria-expanded="false">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div class="sm:hidden hidden mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">Beranda</a>
                    <a href="{{ route('payment.create') }}" class="text-gray-600 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">Upload Pembayaran</a>
                    <a href="{{ route('payment.track') }}" class="text-gray-600 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">Cek Status</a>
                </div>
            </div>
        </header>

        <!-- Status Content -->
        <div class="py-16 bg-gray-50">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-8 text-gray-900">
                        <div class="flex flex-col items-center text-center mb-8">
                            <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">Status Pembayaran</h1>
                            <p class="text-lg text-gray-600 mb-6 max-w-lg">
                                @if(count($payments) > 0)
                                    Berikut adalah status pembayaran untuk NIM: {{ $payments[0]->nim }}
                                @else
                                    Tidak ada data pembayaran dengan NIM yang Anda masukkan
                                @endif
                            </p>
                        </div>
                        
                        @if(count($payments) > 0)
                            <!-- Status Tracker -->
                            <div class="mb-10">
                                <div class="flex items-center w-full mb-6">
                                    <div class="w-1/3">
                                        <div class="relative">
                                            <div class="h-1 bg-green-500 w-full"></div>
                                            <div class="absolute -top-4 right-0 -mr-3">
                                                <div class="px-2 py-1 rounded-full bg-green-500 text-white text-xs font-bold">
                                                    1
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mt-6">
                                            <h3 class="text-green-600 font-semibold text-sm">Pengajuan Terkirim</h3>
                                        </div>
                                    </div>
                                    <div class="w-1/3">
                                        <div class="relative">
                                            <div class="h-1 {{ in_array('pending', $payments->pluck('status')->toArray()) ? 'bg-yellow-300' : 'bg-green-500' }} w-full"></div>
                                            <div class="absolute -top-4 right-0 -mr-3">
                                                <div class="px-2 py-1 rounded-full {{ in_array('pending', $payments->pluck('status')->toArray()) ? 'bg-yellow-300' : 'bg-green-500' }} text-white text-xs font-bold">
                                                    2
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mt-6">
                                            <h3 class="{{ in_array('pending', $payments->pluck('status')->toArray()) ? 'text-yellow-500' : 'text-green-600' }} font-semibold text-sm">Dalam Proses Verifikasi</h3>
                                        </div>
                                    </div>
                                    <div class="w-1/3">
                                        <div class="relative">
                                            <div class="h-1 {{ in_array('verified', $payments->pluck('status')->toArray()) && !in_array('pending', $payments->pluck('status')->toArray()) && !in_array('rejected', $payments->pluck('status')->toArray()) ? 'bg-green-500' : 'bg-gray-300' }} w-full"></div>
                                            <div class="absolute -top-4 right-0 -mr-3">
                                                <div class="px-2 py-1 rounded-full {{ in_array('verified', $payments->pluck('status')->toArray()) && !in_array('pending', $payments->pluck('status')->toArray()) && !in_array('rejected', $payments->pluck('status')->toArray()) ? 'bg-green-500' : 'bg-gray-300' }} text-white text-xs font-bold">
                                                    3
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mt-6">
                                            <h3 class="{{ in_array('verified', $payments->pluck('status')->toArray()) && !in_array('pending', $payments->pluck('status')->toArray()) && !in_array('rejected', $payments->pluck('status')->toArray()) ? 'text-green-600' : 'text-gray-500' }} font-semibold text-sm">Terverifikasi</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Payment Detail Cards -->
                            <div class="space-y-6 mb-8">
                                @foreach($payments as $payment)
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                                            <h3 class="font-semibold text-lg">{{ $payment->payment_type }}</h3>
                                            <div>
                                                @if($payment->status == 'verified')
                                                    <span class="text-green-800 text-sm font-medium flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Terverifikasi
                                                    </span>
                                                @elseif($payment->status == 'rejected')
                                                    <span class="text-red-800 text-sm font-medium">Ditolak</span>
                                                @else
                                                    <span class="text-yellow-800 text-sm font-medium">Menunggu Verifikasi</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="p-6">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                    <p class="text-sm text-gray-500 mb-1">Nama</p>
                                                    <p class="font-medium">{{ $payment->student_name }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-500 mb-1">NIM</p>
                                                    <p class="font-medium">{{ $payment->nim }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-500 mb-1">Jumlah</p>
                                                    <p class="font-medium">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-500 mb-1">Tanggal Pembayaran</p>
                                                    <p class="font-medium">{{ $payment->created_at->format('d M Y') }}</p>
                                                </div>
                                            </div>
                                            
                                            @if($payment->status == 'rejected')
                                                <div class="mt-6 p-4 border border-red-200 bg-red-50 rounded-md">
                                                    <h4 class="font-medium text-red-800 mb-2 flex items-center">
                                                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        Alasan Penolakan
                                                    </h4>
                                                    <p class="text-red-700">{{ $payment->notes ?? 'Bukti pembayaran tidak valid atau tidak sesuai.' }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                                            <div class="text-sm text-gray-500">
                                                Diperbarui: {{ $payment->updated_at->format('d M Y H:i') }}
                                            </div>
                                            <div>
                                                @if($payment->status == 'rejected')
                                                    <a href="{{ route('payment.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                        Upload Ulang
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Data Pembayaran</h3>
                                <p class="text-gray-500 mb-6">Kami tidak menemukan data pembayaran dengan NIM yang Anda masukkan.</p>
                                <div class="flex flex-col sm:flex-row justify-center gap-4">
                                    <a href="{{ route('payment.track') }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        Coba NIM Lain
                                    </a>
                                    <a href="{{ route('payment.create') }}" class="inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Upload Pembayaran
                                    </a>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Action Buttons -->
                        <div class="mt-6 flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('home') }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Kembali ke Beranda
                            </a>
                            <a href="{{ route('payment.create') }}" class="inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Upload Pembayaran Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <footer class="bg-white mt-12 py-8 border-t">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="md:flex md:justify-between">
                    <div class="mb-6 md:mb-0">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ml-3 text-xl font-bold text-gray-900">USBYPKP</span>
                        </a>
                        <p class="mt-2 text-sm text-gray-600">
                            Sistem Konfirmasi Pembayaran Mahasiswa
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-8 sm:grid-cols-3">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Menu</h3>
                            <ul class="mt-4 space-y-2">
                                <li>
                                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600">Beranda</a>
                                </li>
                                <li>
                                    <a href="{{ route('payment.create') }}" class="text-gray-600 hover:text-blue-600">Upload Pembayaran</a>
                                </li>
                                <li>
                                    <a href="{{ route('payment.track') }}" class="text-gray-600 hover:text-blue-600">Cek Status</a>
                                </li>
                            </ul>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Hubungi Kami</h3>
                            <ul class="mt-4 space-y-2">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-gray-600">keuangan@usbypkp.ac.id</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span class="text-gray-600">(022) 7275489</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <hr class="my-6 border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between">
                    <p class="text-sm text-gray-500">
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

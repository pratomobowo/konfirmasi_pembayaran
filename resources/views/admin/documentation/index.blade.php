@extends('layouts.admin')

@section('header', 'Dokumentasi Aplikasi')

@section('content')
<div class="space-y-6">
    <!-- Quick Links -->
    <div class="bg-white shadow rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Links</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="#dashboard" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="text-blue-900">Dashboard</span>
                </a>
                <a href="#pembayaran" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <span class="text-green-900">Pembayaran</span>
                </a>
                <a href="#jenis-pembayaran" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                    </svg>
                    <span class="text-purple-900">Jenis Pembayaran</span>
                </a>
                <a href="#pengguna" class="flex items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="text-yellow-900">Pengguna</span>
                </a>
                <a href="#laporan" class="flex items-center p-4 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                    <svg class="h-6 w-6 text-red-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="text-red-900">Laporan</span>
                </a>
                <a href="#pengaturan" class="flex items-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-indigo-900">Pengaturan</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Documentation Content -->
    <div class="bg-white shadow rounded-lg">
        <div class="p-6">
            <!-- Dashboard -->
            <div id="dashboard" class="mb-12">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold ml-4">Dashboard</h3>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <p class="text-gray-600 mb-4">Dashboard adalah halaman utama yang menampilkan ringkasan informasi penting dari seluruh aplikasi.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-900 mb-3">Fitur Utama:</h4>
                            <ul class="space-y-2">
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Ringkasan total pembayaran
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Grafik pembayaran per periode
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Daftar pembayaran terbaru
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Statistik pengguna aktif
                                </li>
                            </ul>
                        </div>
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <h4 class="font-medium text-gray-900 mb-3">Tips Penggunaan:</h4>
                            <ul class="space-y-2">
                                <li class="flex items-start text-gray-600">
                                    <svg class="h-5 w-5 text-blue-500 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Gunakan filter tanggal untuk melihat data dalam periode tertentu</span>
                                </li>
                                <li class="flex items-start text-gray-600">
                                    <svg class="h-5 w-5 text-blue-500 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Klik pada grafik untuk melihat detail data</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pembayaran -->
            <div id="pembayaran" class="mb-12">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold ml-4">Modul Pembayaran</h3>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <p class="text-gray-600 mb-4">Modul pembayaran digunakan untuk mengelola semua transaksi pembayaran dalam sistem.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-900 mb-3">Fitur Utama:</h4>
                            <ul class="space-y-2">
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Daftar semua pembayaran
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Filter pembayaran
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Detail pembayaran
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Konfirmasi pembayaran
                                </li>
                            </ul>
                        </div>
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <h4 class="font-medium text-gray-900 mb-3">Cara Penggunaan:</h4>
                            <ol class="space-y-3">
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">1</span>
                                    <span>Klik menu "Pembayaran" di sidebar</span>
                                </li>
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">2</span>
                                    <span>Gunakan filter untuk mencari pembayaran spesifik</span>
                                </li>
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">3</span>
                                    <span>Klik pada pembayaran untuk melihat detail</span>
                                </li>
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">4</span>
                                    <span>Gunakan tombol aksi untuk konfirmasi atau batalkan pembayaran</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jenis Pembayaran -->
            <div id="jenis-pembayaran" class="mb-12">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold ml-4">Modul Jenis Pembayaran</h3>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <p class="text-gray-600 mb-4">Modul ini digunakan untuk mengelola berbagai jenis pembayaran yang tersedia dalam sistem.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-900 mb-3">Fitur Utama:</h4>
                            <ul class="space-y-2">
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Daftar jenis pembayaran
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Tambah jenis pembayaran baru
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Edit jenis pembayaran
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Aktifkan/nonaktifkan jenis pembayaran
                                </li>
                            </ul>
                        </div>
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <h4 class="font-medium text-gray-900 mb-3">Cara Penggunaan:</h4>
                            <ol class="space-y-3">
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">1</span>
                                    <span>Klik menu "Jenis Pembayaran" di sidebar</span>
                                </li>
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">2</span>
                                    <span>Klik tombol "Tambah" untuk membuat jenis pembayaran baru</span>
                                </li>
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">3</span>
                                    <span>Isi form dengan detail jenis pembayaran</span>
                                </li>
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">4</span>
                                    <span>Gunakan tombol aksi untuk edit atau nonaktifkan jenis pembayaran</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengguna -->
            <div id="pengguna" class="mb-12">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold ml-4">Modul Pengguna</h3>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <p class="text-gray-600 mb-4">Modul pengguna digunakan untuk mengelola akun pengguna dalam sistem.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-900 mb-3">Fitur Utama:</h4>
                            <ul class="space-y-2">
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Daftar pengguna
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Tambah pengguna baru
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Edit profil pengguna
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Reset password
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Aktifkan/nonaktifkan akun
                                </li>
                            </ul>
                        </div>
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <h4 class="font-medium text-gray-900 mb-3">Cara Penggunaan:</h4>
                            <ol class="space-y-3">
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">1</span>
                                    <span>Klik menu "Pengguna" di sidebar</span>
                                </li>
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">2</span>
                                    <span>Klik tombol "Tambah" untuk membuat akun baru</span>
                                </li>
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">3</span>
                                    <span>Isi form dengan data pengguna</span>
                                </li>
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">4</span>
                                    <span>Gunakan tombol aksi untuk mengelola pengguna</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Laporan -->
            <div id="laporan" class="mb-12">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <svg class="h-8 w-8 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold ml-4">Modul Laporan</h3>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <p class="text-gray-600 mb-4">Modul laporan menyediakan berbagai jenis laporan untuk analisis data.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-900 mb-3">Fitur Utama:</h4>
                            <ul class="space-y-2">
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Laporan pembayaran
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Laporan pengguna
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Laporan aktivitas
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Export ke PDF/Excel
                                </li>
                            </ul>
                        </div>
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <h4 class="font-medium text-gray-900 mb-3">Cara Penggunaan:</h4>
                            <ol class="space-y-3">
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">1</span>
                                    <span>Klik menu "Laporan" di sidebar</span>
                                </li>
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">2</span>
                                    <span>Pilih jenis laporan yang diinginkan</span>
                                </li>
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">3</span>
                                    <span>Atur parameter laporan (tanggal, jenis, dll)</span>
                                </li>
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">4</span>
                                    <span>Klik "Generate" untuk membuat laporan</span>
                                </li>
                                <li class="flex items-start text-gray-600">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">5</span>
                                    <span>Gunakan tombol export untuk mengunduh laporan</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Log Aktivitas -->
            <div id="pengaturan" class="mb-12">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-indigo-100 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold ml-4">Modul Pengaturan</h3>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <p class="text-gray-600 mb-4">Modul pengaturan digunakan untuk mengkonfigurasi berbagai aspek sistem.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-900 mb-3">SMTP Settings:</h4>
                            <ul class="space-y-2">
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Konfigurasi server email
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Pengaturan SMTP
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Test koneksi email
                                </li>
                            </ul>
                        </div>
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <h4 class="font-medium text-gray-900 mb-3">Template Email:</h4>
                            <ul class="space-y-2">
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Kelola template email
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Edit template
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Preview template
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Aktifkan/nonaktifkan template
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-6">
                        <h4 class="font-medium text-gray-900 mb-3">Cara Penggunaan:</h4>
                        <ol class="space-y-3">
                            <li class="flex items-start text-gray-600">
                                <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">1</span>
                                <span>Klik menu "Pengaturan" di sidebar</span>
                            </li>
                            <li class="flex items-start text-gray-600">
                                <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">2</span>
                                <span>Pilih submenu yang diinginkan (SMTP/Template Email)</span>
                            </li>
                            <li class="flex items-start text-gray-600">
                                <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">3</span>
                                <span>Atur konfigurasi sesuai kebutuhan</span>
                            </li>
                            <li class="flex items-start text-gray-600">
                                <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mr-2">4</span>
                                <span>Simpan perubahan</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
@endpush
@endsection 
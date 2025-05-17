<x-guest-layout>
    <!-- Success Content -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <div class="flex flex-col items-center text-center mb-8">
                        <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Terima Kasih!</h1>
                        <p class="text-lg text-gray-600 mb-6 max-w-lg">
                            Bukti pembayaran Anda telah berhasil dikirim. Silahkan tunggu proses verifikasi.
                        </p>
                        
                        @if (session('success'))
                            <div class="w-full p-4 mb-6 rounded-md bg-green-50 border border-green-200">
                                <p class="text-green-700">{{ session('success') }}</p>
                            </div>
                        @endif
                    </div>
                    
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
                                    <div class="h-1 bg-yellow-300 w-full"></div>
                                    <div class="absolute -top-4 right-0 -mr-3">
                                        <div class="px-2 py-1 rounded-full bg-yellow-300 text-white text-xs font-bold">
                                            2
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-6">
                                    <h3 class="text-yellow-500 font-semibold text-sm">Dalam Proses Verifikasi</h3>
                                </div>
                            </div>
                            <div class="w-1/3">
                                <div class="relative">
                                    <div class="h-1 bg-gray-300 w-full"></div>
                                    <div class="absolute -top-4 right-0 -mr-3">
                                        <div class="px-2 py-1 rounded-full bg-gray-300 text-white text-xs font-bold">
                                            3
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-6">
                                    <h3 class="text-gray-500 font-semibold text-sm">Terverifikasi</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Important Information -->
                    <div class="bg-blue-50 p-6 rounded-md mb-8 border border-blue-100">
                        <h2 class="font-semibold text-lg mb-3 text-blue-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Informasi Penting
                        </h2>
                        <ul class="list-disc list-inside text-sm space-y-2 text-gray-700">
                            <li>Admin akan memverifikasi pembayaran Anda dalam 1-2 hari kerja.</li>
                            <li>Status pembayaran akan diperbarui setelah diverifikasi.</li>
                            <li>Anda dapat mengecek status pembayaran menggunakan NIM Anda.</li>
                            <li>Jika ada pertanyaan, silahkan hubungi bagian keuangan.</li>
                        </ul>
                    </div>
                    
                    <!-- Next Steps -->
                    <div class="border-t border-gray-200 pt-6">
                        <h2 class="font-semibold text-lg mb-4 text-gray-900">Langkah Selanjutnya</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 rounded-lg p-5 border border-gray-200 flex">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="bg-blue-100 h-10 w-10 rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="font-medium mb-1">Cek Status Pembayaran</h3>
                                    <p class="text-sm text-gray-600 mb-2">Anda dapat mengecek status pembayaran Anda melalui menu cek status.</p>
                                    <a href="{{ route('payment.track') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                        Cek Status
                                    </a>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-5 border border-gray-200 flex">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="bg-blue-100 h-10 w-10 rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="font-medium mb-1">Kembali ke Beranda</h3>
                                    <p class="text-sm text-gray-600 mb-2">Kembali ke halaman beranda untuk melihat informasi pembayaran lainnya.</p>
                                    <a href="{{ route('home') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                        Ke Beranda
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout> 
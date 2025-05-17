<x-guest-layout>
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-3xl font-bold">Cek Status Pembayaran</h1>
            <p class="mt-2 text-blue-100">
                Masukkan NIM Anda untuk melihat status pembayaran
            </p>
        </div>
    </div>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Form Pencarian -->
            @if(!isset($nimFound) || !$nimFound)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 md:p-8 text-gray-900">
                    <div class="mb-8">
                        <div class="flex space-x-4 items-center mb-6">
                            <div class="bg-blue-100 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-semibold text-gray-900">Track Status Pembayaran</h2>
                        </div>
                        
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-800">
                                        Masukkan NIM Anda untuk melihat status pembayaran yang telah Anda lakukan. Sistem akan menampilkan semua riwayat pembayaran yang terkait dengan NIM tersebut.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (session('error'))
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-800">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('payment.check') }}" method="GET" class="max-w-lg mx-auto">
                        <div class="mb-8">
                            <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">Nomor Induk Mahasiswa (NIM)</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                    </svg>
                                </div>
                                <input type="text" name="nim" id="nim" required
                                    class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    placeholder="Contoh: 12345678">
                            </div>
                            
                            @error('nim')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <p class="mt-2 text-xs text-gray-500">Masukkan NIM Anda tanpa spasi atau karakter khusus.</p>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="inline-flex justify-center py-3 px-8 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Cek Status Pembayaran
                            </button>
                            
                            <div class="mt-4">
                                <a href="{{ route('home') }}" class="text-sm text-blue-600 hover:text-blue-800">
                                    Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <!-- Hasil Pencarian -->
            @if(isset($nimFound) && $nimFound && isset($payments) && count($payments) > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 md:p-8 text-gray-900">
                    <div class="flex flex-col items-center text-center mb-8">
                        <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Status Pembayaran</h2>
                        <p class="text-lg text-gray-600 mb-6 max-w-lg">
                            Berikut adalah status pembayaran untuk NIM: {{ $nim }}
                        </p>
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
                                    <div class="flex space-x-2">
                                        <a href="{{ route('payment.detail', $payment->id) }}" class="px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                </svg>
                                                Lihat Detail
                                            </span>
                                        </a>
                                        
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
                    
                    <!-- Action Button -->
                    <div class="mt-6 text-center">
                        <a href="{{ route('payment.track') }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cek NIM Lain
                        </a>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- FAQ Section -->
            <div class="mt-10">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Pertanyaan Umum</h2>
                
                <div class="space-y-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-5 border-b">
                            <button class="flex w-full text-left" onclick="toggleFaq('faq1')">
                                <span class="text-blue-600 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                                <span class="font-medium">Bagaimana jika saya lupa NIM saya?</span>
                                <span class="ml-auto transform transition-transform duration-200" id="faq1-icon">
                                    <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </button>
                            <div class="mt-2 hidden" id="faq1-content">
                                <p class="text-gray-600">
                                    Jika Anda lupa NIM, silakan hubungi bagian administrasi akademik kampus atau cek kartu mahasiswa Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-5 border-b">
                            <button class="flex w-full text-left" onclick="toggleFaq('faq2')">
                                <span class="text-blue-600 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                                <span class="font-medium">Berapa lama proses verifikasi pembayaran?</span>
                                <span class="ml-auto transform transition-transform duration-200" id="faq2-icon">
                                    <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </button>
                            <div class="mt-2 hidden" id="faq2-content">
                                <p class="text-gray-600">
                                    Proses verifikasi pembayaran biasanya membutuhkan waktu 1-2 hari kerja setelah bukti pembayaran diunggah.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFaq(id) {
            const content = document.getElementById(id + '-content');
            const icon = document.getElementById(id + '-icon');
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }
    </script>
</x-guest-layout> 
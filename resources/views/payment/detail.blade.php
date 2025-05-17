<x-guest-layout>
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-3xl font-bold">Detail Pembayaran</h1>
            <p class="mt-2 text-blue-100">
                Informasi lengkap tentang pembayaran Anda
            </p>
        </div>
    </div>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden mb-6">
                <!-- Payment Status Header -->
                <div class="p-4 sm:p-6 border-b border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <div class="bg-blue-100 p-2 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">{{ $payment->payment_type }}</h2>
                                <p class="text-sm text-gray-500">ID: #{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                        
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
                </div>
                
                <!-- Status Timeline -->
                <div class="px-4 sm:px-6 py-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Status Pembayaran</h3>
                    <div class="relative">
                        <div class="absolute h-full w-0.5 bg-gray-200 left-5 top-0"></div>
                        
                        <!-- Submitted Status -->
                        <div class="relative flex items-start mb-6">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-green-500 flex items-center justify-center z-10">
                                    <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900">Pembayaran Terkirim</h4>
                                <p class="text-sm text-gray-500">{{ $payment->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        
                        <!-- Processing Status -->
                        <div class="relative flex items-start mb-6">
                            <div class="flex-shrink-0">
                                @if($payment->status == 'verified' || $payment->status == 'rejected')
                                    <div class="h-10 w-10 rounded-full bg-green-500 flex items-center justify-center z-10">
                                        <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                @elseif($payment->status == 'pending')
                                    <div class="h-10 w-10 rounded-full bg-yellow-400 flex items-center justify-center z-10">
                                        <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900">Dalam Proses Verifikasi</h4>
                                <p class="text-sm text-gray-500">
                                    @if($payment->status == 'pending')
                                        Sedang diproses
                                    @else
                                        {{ $payment->updated_at->format('d M Y, H:i') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <!-- Verified/Rejected Status -->
                        <div class="relative flex items-start">
                            <div class="flex-shrink-0">
                                @if($payment->status == 'verified')
                                    <div class="h-10 w-10 rounded-full bg-green-500 flex items-center justify-center z-10">
                                        <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                @elseif($payment->status == 'rejected')
                                    <div class="h-10 w-10 rounded-full bg-red-500 flex items-center justify-center z-10">
                                        <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center z-10">
                                        <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900">
                                    @if($payment->status == 'verified')
                                        Pembayaran Terverifikasi
                                    @elseif($payment->status == 'rejected')
                                        Pembayaran Ditolak
                                    @else
                                        Menunggu Keputusan
                                    @endif
                                </h4>
                                <p class="text-sm text-gray-500">
                                    @if($payment->status == 'verified' || $payment->status == 'rejected')
                                        {{ $payment->updated_at->format('d M Y, H:i') }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Details -->
                <div class="px-4 sm:px-6 py-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Pembayaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Jenis Pembayaran</p>
                            <p class="font-medium">{{ $payment->payment_type }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Jumlah</p>
                            <p class="font-medium">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Tanggal Pembayaran</p>
                            <p class="font-medium">{{ $payment->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Waktu Pembayaran</p>
                            <p class="font-medium">{{ $payment->created_at->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>
                
                <!-- Student Information -->
                <div class="px-4 sm:px-6 py-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Mahasiswa</h3>
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
                            <p class="text-sm text-gray-500 mb-1">Email</p>
                            <p class="font-medium">{{ $payment->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Nomor Telepon</p>
                            <p class="font-medium">{{ $payment->phone_number ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Proof -->
                <div class="px-4 sm:px-6 py-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Bukti Pembayaran</h3>
                    <div class="mt-2">
                        <div class="bg-gray-100 border border-gray-200 rounded-lg p-4 flex flex-col items-center">
                            @php
                                $extension = pathinfo($payment->payment_proof, PATHINFO_EXTENSION);
                                $isPdf = strtolower($extension) === 'pdf';
                            @endphp
                            
                            @if($isPdf)
                                <div class="bg-gray-200 rounded-lg p-4 mb-3 w-16 h-16 flex items-center justify-center">
                                    <svg class="h-8 w-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 mb-2">Dokumen PDF</p>
                            @else
                                <img src="{{ asset('storage/' . $payment->payment_proof) }}" alt="Bukti Pembayaran" class="max-w-xs rounded-lg mb-3">
                            @endif
                            
                            <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank" class="px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $isPdf ? 'Lihat PDF' : 'Lihat Gambar Asli' }}
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Rejection Reason (if applicable) -->
                @if($payment->status == 'rejected')
                <div class="px-4 sm:px-6 py-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-red-600 mb-4">Alasan Penolakan</h3>
                    <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">
                                    {{ $payment->notes ?? 'Bukti pembayaran tidak valid atau tidak sesuai.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Action Buttons -->
                <div class="px-4 sm:px-6 py-6 flex flex-col sm:flex-row justify-between items-center">
                    <div class="text-sm text-gray-500 mb-4 sm:mb-0">
                        Pembaruan terakhir: {{ $payment->updated_at->format('d M Y, H:i') }}
                    </div>
                    <div class="space-x-3">
                        <a href="{{ route('payment.track') }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                        
                        @if($payment->status == 'rejected')
                            <a href="{{ route('payment.create') }}" class="inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                Upload Ulang
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout> 
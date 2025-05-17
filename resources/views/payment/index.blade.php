<x-guest-layout>
    <!-- Page Header -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-2xl font-bold text-gray-900">Konfirmasi Pembayaran</h1>
            <p class="mt-2 text-gray-600">
                Verifikasi dan pantau status pembayaran Anda dengan mudah
            </p>
        </div>
    </div>

    <!-- Steps Section -->
    <div class="py-8 sm:py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 sm:mb-8 text-center">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2 sm:mb-4">Proses Verifikasi Pembayaran</h2>
                <p class="text-sm sm:text-base text-gray-600 max-w-3xl mx-auto">
                    Ikuti langkah-langkah mudah berikut untuk memverifikasi pembayaran Anda
                </p>
            </div>
            
            <div class="mt-4 sm:mt-6 flex flex-col sm:flex-row justify-center gap-3 sm:gap-4 mb-6 sm:mb-10">
                <a href="{{ route('payment.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-4 sm:px-6 py-2 sm:py-3 border border-transparent rounded-md shadow-sm text-sm sm:text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    Upload Bukti Pembayaran
                </a>
                <a href="{{ route('payment.track') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-4 sm:px-6 py-2 sm:py-3 border border-blue-600 rounded-md shadow-sm text-sm sm:text-base font-medium text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Cek Status Pembayaran
                </a>
            </div>
            
            <div class="mt-6 sm:mt-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-8">
                    <!-- Step 1 -->
                    <div class="bg-gray-50 rounded-lg p-4 sm:p-6 border border-gray-200 shadow-sm text-center hover:shadow-md transition-shadow">
                        <div class="bg-blue-100 rounded-full h-12 w-12 sm:h-16 sm:w-16 flex items-center justify-center mx-auto mb-3 sm:mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-semibold mb-1 sm:mb-2">1. Upload Bukti Pembayaran</h3>
                        <p class="text-xs sm:text-sm text-gray-600">
                            Isi formulir dan upload bukti transfer atau pembayaran Anda
                        </p>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="bg-gray-50 rounded-lg p-4 sm:p-6 border border-gray-200 shadow-sm text-center hover:shadow-md transition-shadow">
                        <div class="bg-blue-100 rounded-full h-12 w-12 sm:h-16 sm:w-16 flex items-center justify-center mx-auto mb-3 sm:mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-semibold mb-1 sm:mb-2">2. Verifikasi oleh Admin</h3>
                        <p class="text-xs sm:text-sm text-gray-600">
                            Admin akan memverifikasi bukti pembayaran Anda dalam 1-2 hari kerja
                        </p>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="bg-gray-50 rounded-lg p-4 sm:p-6 border border-gray-200 shadow-sm text-center hover:shadow-md transition-shadow">
                        <div class="bg-blue-100 rounded-full h-12 w-12 sm:h-16 sm:w-16 flex items-center justify-center mx-auto mb-3 sm:mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-semibold mb-1 sm:mb-2">3. Cek Status Pembayaran</h3>
                        <p class="text-xs sm:text-sm text-gray-600">
                            Pantau status verifikasi pembayaran Anda dengan memasukkan NIM
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Status Section -->
    <div class="py-8 sm:py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 sm:mb-6 space-y-3 sm:space-y-0">
                        <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">Status Pembayaran Terakhir</h2>
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                            <a href="{{ route('payment.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-3 sm:px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                Upload Bukti
                            </a>
                            <a href="{{ route('payment.track') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-3 sm:px-4 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition-colors">
                                Cek Status
                            </a>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        @if($payments->isEmpty())
                            <div class="text-center py-8 sm:py-10 bg-gray-50 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-16 sm:w-16 text-gray-400 mx-auto mb-3 sm:mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <p class="text-gray-500 text-base sm:text-lg">Belum ada data pembayaran.</p>
                                <div class="mt-4">
                                    <a href="{{ route('payment.create') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                        Upload bukti pembayaran pertama Anda
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="overflow-x-auto -mx-4 sm:mx-0">
                                <div class="inline-block min-w-full align-middle">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                                                <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                                <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Jenis</th>
                                                <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($payments as $payment)
                                                <tr class="hover:bg-gray-50 transition-colors">
                                                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-900">{{ $payment->nim }}</td>
                                                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-900">
                                                        <div>{{ $payment->student_name }}</div>
                                                        <div class="text-xs text-gray-500 sm:hidden">{{ $payment->payment_type }}</div>
                                                        <div class="text-xs text-gray-500 sm:hidden">{{ $payment->created_at->format('d M Y') }}</div>
                                                    </td>
                                                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-900 hidden sm:table-cell">{{ $payment->payment_type }}</td>
                                                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap">
                                                        @if($payment->status == 'verified')
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                Terverifikasi
                                                            </span>
                                                        @elseif($payment->status == 'pending')
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                Menunggu
                                                            </span>
                                                        @elseif($payment->status == 'rejected')
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                Ditolak
                                                            </span>
                                                        @else
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                                {{ $payment->status }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500 hidden sm:table-cell">{{ $payment->created_at->format('d M Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="mt-4 px-2 sm:px-0">
                                {{ $payments->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout> 
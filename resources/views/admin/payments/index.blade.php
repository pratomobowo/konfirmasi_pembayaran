@extends('layouts.admin')

@section('content')
    <x-page-header>
        <x-slot name="title">Manajemen Pembayaran</x-slot>
        <x-slot name="description">
            Kelola dan verifikasi pembayaran yang masuk. Pantau status pembayaran, lihat detail, dan proses verifikasi pembayaran pengguna.
        </x-slot>
        <x-slot name="actions">
            <a href="{{ route('admin.export') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export Data
            </a>
        </x-slot>
    </x-page-header>

    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="mb-6">
                <!-- Filter and Search Form -->
                <form action="{{ route('admin.payments') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="w-full md:w-1/3">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Filter Status</label>
                        <select id="status" name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="w-full md:w-2/3">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                        <div class="flex">
                            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama, NIM, atau email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <button type="submit" class="ml-2 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Payments Table -->
            @if(isset($payments) && $payments->isEmpty())
                <div class="text-center py-4 text-gray-500">
                    Tidak ada data pembayaran yang ditemukan.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">NIM</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Jenis Pembayaran</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Jumlah</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($payments ?? [] as $payment)
                                <tr class="hover:bg-gray-50 transition-colors duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $payment->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->nim }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->student_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->payment_type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if(isset($payment->status))
                                            @if($payment->status === 'verified')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3" />
                                                    </svg>
                                                    Terverifikasi
                                                </span>
                                            @elseif($payment->status === 'pending')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3" />
                                                    </svg>
                                                    Menunggu
                                                </span>
                                            @elseif($payment->status === 'rejected')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3" />
                                                    </svg>
                                                    Ditolak
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-gray-400" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3" />
                                                    </svg>
                                                    {{ $payment->status }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                                <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-gray-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                -
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ isset($payment->created_at) ? $payment->created_at->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-2">
                                            <button type="button" 
                                                class="inline-flex items-center justify-center rounded-md px-3 py-1.5 bg-blue-600 text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200"
                                                onclick="openPaymentModal({{ $payment->id }})"
                                                data-id="{{ $payment->id }}" 
                                                data-nim="{{ $payment->nim }}" 
                                                data-name="{{ $payment->student_name }}" 
                                                data-email="{{ $payment->email }}" 
                                                data-phone="{{ $payment->phone_number ?? '-' }}" 
                                                data-type="{{ $payment->payment_type }}" 
                                                data-amount="{{ $payment->amount }}" 
                                                data-status="{{ $payment->status }}" 
                                                data-date="{{ isset($payment->created_at) ? $payment->created_at->format('d M Y H:i') : '-' }}" 
                                                data-proof="{{ Storage::url($payment->payment_proof) }}"
                                                data-verified="{{ $payment->verified_at ? $payment->verified_at->format('d M Y H:i') : '' }}"
                                                data-notes="{{ $payment->notes ?? '' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Detail
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if(isset($payments) && method_exists($payments, 'links'))
                <div class="mt-4">
                    {{ $payments->links() }}
                </div>
                @endif
            @endif
        </div>
    </div>

    <!-- Payment Verification Modal -->
    <div id="paymentModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Detail Pembayaran #<span id="payment-id"></span>
                                </h3>
                                <span id="payment-status-badge" class="px-3 py-1 rounded-full text-sm"></span>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Informasi Pembayaran & Bukti Pembayaran -->
                                <div>
                                    <h4 class="text-md font-medium text-gray-900 mb-3">Informasi Pembayaran</h4>
                                    <table class="min-w-full mb-4">
                                        <tr>
                                            <td class="py-2 pr-4 text-sm text-gray-500">Jenis Pembayaran</td>
                                            <td class="py-2 text-sm" id="payment-type"></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pr-4 text-sm text-gray-500">Jumlah</td>
                                            <td class="py-2 text-sm" id="payment-amount"></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pr-4 text-sm text-gray-500">Tanggal Pembayaran</td>
                                            <td class="py-2 text-sm" id="payment-date"></td>
                                        </tr>
                                        <tr id="verification-date-row" class="hidden">
                                            <td class="py-2 pr-4 text-sm text-gray-500">Tanggal Verifikasi</td>
                                            <td class="py-2 text-sm" id="verification-date"></td>
                                        </tr>
                                    </table>

                                    <div id="admin-notes" class="mt-4 p-3 bg-gray-100 rounded hidden">
                                        <p class="text-sm font-medium text-gray-500">Catatan Admin:</p>
                                        <p class="text-sm mt-1" id="notes-content"></p>
                                    </div>

                                    <div class="mt-4">
                                        <h4 class="text-md font-medium text-gray-900 mb-3">Bukti Pembayaran</h4>
                                        <div class="border rounded-md overflow-hidden h-64 flex items-center justify-center">
                                            <img id="payment-proof-img" src="" alt="Bukti Pembayaran" class="max-w-full max-h-full object-contain">
                                        </div>
                                        <a id="proof-link" href="" target="_blank" class="mt-2 inline-block text-blue-600 hover:underline">
                                            Lihat Bukti Pembayaran (Full)
                                        </a>
                                    </div>
                                </div>

                                <!-- Informasi Mahasiswa dan Form Verifikasi -->
                                <div>
                                    <h4 class="text-md font-medium text-gray-900 mb-3">Informasi Mahasiswa</h4>
                                    <table class="min-w-full">
                                        <tr>
                                            <td class="py-2 pr-4 text-sm text-gray-500">Nama</td>
                                            <td class="py-2 text-sm" id="student-name"></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pr-4 text-sm text-gray-500">NIM</td>
                                            <td class="py-2 text-sm" id="student-nim"></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pr-4 text-sm text-gray-500">Email</td>
                                            <td class="py-2 text-sm" id="student-email"></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pr-4 text-sm text-gray-500">Telepon</td>
                                            <td class="py-2 text-sm" id="student-phone"></td>
                                        </tr>
                                    </table>

                                    <div id="verification-form" class="mt-6 pt-4 border-t border-gray-200">
                                        <h4 class="text-md font-medium text-gray-900 mb-3">Verifikasi Pembayaran</h4>
                                        
                                        <form id="verify-form" class="mb-4">
                                            <input type="hidden" id="verify-payment-id" name="payment_id">
                                            <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                                Verifikasi Pembayaran
                                            </button>
                                        </form>

                                        <form id="reject-form">
                                            <input type="hidden" id="reject-payment-id" name="payment_id">
                                            <div class="mb-3">
                                                <label for="reject-notes" class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan:</label>
                                                <textarea id="reject-notes" name="notes" rows="3" class="w-full rounded-md border-gray-300 shadow-sm" placeholder="Masukkan alasan penolakan" required></textarea>
                                            </div>
                                            <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                                Tolak Pembayaran
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closePaymentModal()">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Fungsi untuk membuka modal pembayaran
        function openPaymentModal(id) {
            const button = document.querySelector(`button[data-id="${id}"]`);
            const modal = document.getElementById('paymentModal');
            
            // Set data ke modal
            document.getElementById('payment-id').textContent = id;
            document.getElementById('verify-payment-id').value = id;
            document.getElementById('reject-payment-id').value = id;
            document.getElementById('student-nim').textContent = button.getAttribute('data-nim');
            document.getElementById('student-name').textContent = button.getAttribute('data-name');
            document.getElementById('student-email').textContent = button.getAttribute('data-email');
            document.getElementById('student-phone').textContent = button.getAttribute('data-phone');
            document.getElementById('payment-type').textContent = button.getAttribute('data-type');
            document.getElementById('payment-amount').textContent = 'Rp ' + Number(button.getAttribute('data-amount')).toLocaleString('id-ID');
            document.getElementById('payment-date').textContent = button.getAttribute('data-date');
            
            // Set bukti pembayaran
            const proofUrl = button.getAttribute('data-proof');
            document.getElementById('payment-proof-img').src = proofUrl;
            document.getElementById('proof-link').href = proofUrl;
            
            // Set status badge
            const status = button.getAttribute('data-status');
            const statusBadge = document.getElementById('payment-status-badge');
            statusBadge.textContent = status === 'pending' ? 'Menunggu Verifikasi' : (status === 'verified' ? 'Terverifikasi' : 'Ditolak');
            statusBadge.className = 'px-3 py-1 rounded-full text-sm ' + 
                (status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                (status === 'verified' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'));
            
            // Tampilkan/sembunyikan form verifikasi dan notes berdasarkan status
            const verificationForm = document.getElementById('verification-form');
            const adminNotes = document.getElementById('admin-notes');
            const verificationDateRow = document.getElementById('verification-date-row');
            
            if (status === 'pending') {
                verificationForm.classList.remove('hidden');
                adminNotes.classList.add('hidden');
                verificationDateRow.classList.add('hidden');
            } else {
                verificationForm.classList.add('hidden');
                
                // Tampilkan tanggal verifikasi jika ada
                const verifiedDate = button.getAttribute('data-verified');
                if (verifiedDate) {
                    document.getElementById('verification-date').textContent = verifiedDate;
                    verificationDateRow.classList.remove('hidden');
                } else {
                    verificationDateRow.classList.add('hidden');
                }
                
                // Tampilkan catatan admin jika ada
                const notes = button.getAttribute('data-notes');
                if (notes && notes.trim() !== '') {
                    document.getElementById('notes-content').textContent = notes;
                    adminNotes.classList.remove('hidden');
                } else {
                    adminNotes.classList.add('hidden');
                }
            }
            
            // Tampilkan modal
            modal.classList.remove('hidden');
            
            // Setup form submissions via AJAX
            setupFormSubmissions(id);
        }
        
        // Fungsi untuk menutup modal
        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
        }
        
        // Setup form submissions
        function setupFormSubmissions(paymentId) {
            // Handle verify form
            document.getElementById('verify-form').onsubmit = function(e) {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin memverifikasi pembayaran ini?')) {
                    // Submit verification form via AJAX
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    fetch(`/admin/payments/${paymentId}/verify`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert('Pembayaran berhasil diverifikasi!');
                            location.reload(); // Reload halaman untuk memperbarui data
                        } else {
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    });
                }
            };
            
            // Handle reject form
            document.getElementById('reject-form').onsubmit = function(e) {
                e.preventDefault();
                const notes = document.getElementById('reject-notes').value;
                
                if (!notes || notes.trim() === '') {
                    alert('Alasan penolakan wajib diisi!');
                    return;
                }
                
                if (confirm('Apakah Anda yakin ingin menolak pembayaran ini?')) {
                    // Submit rejection form via AJAX
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    fetch(`/admin/payments/${paymentId}/reject`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ notes: notes })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert('Pembayaran telah ditolak!');
                            location.reload(); // Reload halaman untuk memperbarui data
                        } else {
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    });
                }
            };
        }
    </script>
    @endpush
@endsection 
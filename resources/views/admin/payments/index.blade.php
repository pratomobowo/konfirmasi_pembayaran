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
                <form action="{{ route('admin.payments') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="w-full">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Filter Status</label>
                            <select id="status" name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div class="w-full md:col-span-2">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                            <div class="flex">
                                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama, NIM, atau email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <button type="submit" class="ml-2 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Cari
                                </button>
                            </div>
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
                <div class="overflow-x-auto -mx-6 sm:mx-0">
                    <div class="inline-block min-w-full align-middle py-2 sm:px-0 px-6">
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
                                                @if(auth()->user()->role === 'super_admin')
                                                <button type="button" 
                                                    class="inline-flex items-center justify-center rounded-md px-3 py-1.5 bg-red-600 text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors duration-200"
                                                    onclick="confirmDelete({{ $payment->id }}, '{{ $payment->student_name }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if(isset($payments) && method_exists($payments, 'links'))
                <div class="mt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
                    <form method="GET" action="{{ route('admin.payments') }}" class="flex items-center">
                        <input type="hidden" name="status" value="{{ request('status') }}">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <x-pagination-length :paginator="$payments" />
                    </form>
                    <div class="overflow-x-auto w-full sm:w-auto">
                        {{ $payments->links() }}
                    </div>
                </div>
                @endif
            @endif
        </div>
    </div>

    <!-- Payment Verification Modal -->
    <div id="paymentModal" class="fixed inset-0 z-50 hidden overflow-y-auto" x-data="{ open: false }" x-show="open" x-cloak>
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl w-full mx-4 sm:mx-auto" x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
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
                                    <div class="overflow-x-auto">
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
                    @if(auth()->user()->role === 'super_admin')
                    <button type="button" id="delete-payment-btn" class="ml-3 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                        Hapus Pembayaran
                    </button>
                    @endif
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closePaymentModal()">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal handling with Alpine.js
            window.openPaymentModal = function(id) {
                const button = document.querySelector(`button[data-id="${id}"]`);
                const modal = document.getElementById('paymentModal');
                
                // Set Alpine.js state
                const alpineModal = Alpine.getComponent(modal);
                alpineModal.open = true;
                
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
                
                // Setup delete button
                if (document.getElementById('delete-payment-btn')) {
                    document.getElementById('delete-payment-btn').onclick = function() {
                        confirmDelete(id, button.getAttribute('data-name'));
                    };
                }
                
                // Setup form submissions via AJAX
                setupFormSubmissions(id);
                
                // Prevent scrolling of body
                document.body.style.overflow = 'hidden';
            };
            
            window.closePaymentModal = function() {
                const modal = document.getElementById('paymentModal');
                const alpineModal = Alpine.getComponent(modal);
                alpineModal.open = false;
                
                // Re-enable scrolling
                document.body.style.overflow = '';
            };
            
            // Fungsi untuk konfirmasi hapus pembayaran
            function confirmDelete(id, name) {
                if (confirm(`Apakah Anda yakin ingin menghapus pembayaran dari ${name}? Tindakan ini tidak dapat dibatalkan.`)) {
                    // Buat form untuk delete request
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/payments/${id}`;
                    form.style.display = 'none';
                    
                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    
                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    form.appendChild(method);
                    form.appendChild(csrf);
                    document.body.appendChild(form);
                    form.submit();
                }
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
        });
    </script>
    @endpush
@endsection 
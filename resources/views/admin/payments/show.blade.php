@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="{{ route('admin.payments') }}" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                &larr; Kembali ke Daftar
            </a>
        </div>

        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Card Detail -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
                    <h2 class="text-lg font-medium text-gray-900">Pembayaran #{{ $payment->id }}</h2>
                    <div class="mt-2 md:mt-0">
                        @if($payment->status === 'verified')
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                Terverifikasi
                            </span>
                        @elseif($payment->status === 'rejected')
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">
                                Ditolak
                            </span>
                        @else
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                                Menunggu Verifikasi
                            </span>
                        @endif
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informasi Pembayaran -->
                        <div>
                            <h3 class="text-md font-medium text-gray-900 mb-4">Informasi Pembayaran</h3>
                            <table class="min-w-full">
                                <tr>
                                    <td class="py-2 pr-4 text-sm text-gray-500">Jenis Pembayaran</td>
                                    <td class="py-2 text-sm">{{ $payment->payment_type }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 pr-4 text-sm text-gray-500">Jumlah</td>
                                    <td class="py-2 text-sm">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 pr-4 text-sm text-gray-500">Tanggal Pembayaran</td>
                                    <td class="py-2 text-sm">{{ $payment->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                @if($payment->verified_at)
                                <tr>
                                    <td class="py-2 pr-4 text-sm text-gray-500">Tanggal Verifikasi</td>
                                    <td class="py-2 text-sm">{{ $payment->verified_at->format('d M Y H:i') }}</td>
                                </tr>
                                @endif
                            </table>

                            @if($payment->notes)
                            <div class="mt-4 p-3 bg-gray-100 rounded">
                                <p class="text-sm font-medium text-gray-500">Catatan Admin:</p>
                                <p class="text-sm mt-1">{{ $payment->notes }}</p>
                            </div>
                            @endif

                            <div class="mt-6">
                                <h3 class="text-md font-medium text-gray-900 mb-4">Bukti Pembayaran</h3>
                                <a href="{{ Storage::url($payment->payment_proof) }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Lihat Bukti Pembayaran
                                </a>
                            </div>
                        </div>

                        <!-- Informasi Mahasiswa dan Form Verifikasi -->
                        <div>
                            <h3 class="text-md font-medium text-gray-900 mb-4">Informasi Mahasiswa</h3>
                            <table class="min-w-full">
                                <tr>
                                    <td class="py-2 pr-4 text-sm text-gray-500">Nama</td>
                                    <td class="py-2 text-sm">{{ $payment->student_name }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 pr-4 text-sm text-gray-500">NIM</td>
                                    <td class="py-2 text-sm">{{ $payment->nim }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 pr-4 text-sm text-gray-500">Email</td>
                                    <td class="py-2 text-sm">{{ $payment->email }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 pr-4 text-sm text-gray-500">Telepon</td>
                                    <td class="py-2 text-sm">{{ $payment->phone_number ?? '-' }}</td>
                                </tr>
                            </table>

                            @if($payment->status === 'pending')
                                <div class="mt-6 border-t border-gray-200 pt-4">
                                    <h3 class="text-md font-medium text-gray-900 mb-4">Verifikasi Pembayaran</h3>
                                    <form action="{{ route('admin.payments.verify', $payment->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="mb-4 w-full px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                            Verifikasi Pembayaran
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.payments.reject', $payment->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan:</label>
                                            <textarea id="notes" name="notes" rows="3" class="w-full rounded-md border-gray-300 shadow-sm" placeholder="Masukkan alasan penolakan" required></textarea>
                                        </div>
                                        <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                            Tolak Pembayaran
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
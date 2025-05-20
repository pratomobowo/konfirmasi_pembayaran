@extends('layouts.admin')

@section('content')
    <x-page-header>
        <x-slot name="title">Tambah Template Email</x-slot>
        <x-slot name="description">
            Buat template email baru yang akan dikirim secara otomatis saat terjadi aktivitas tertentu.
        </x-slot>
        <x-slot name="actions">
            <a href="{{ route('admin.email-templates.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </x-slot>
    </x-page-header>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 bg-blue-50">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Form Template Email
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Isi form di bawah ini untuk membuat template email baru.
            </p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
            <form action="{{ route('admin.email-templates.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Template</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="trigger_type" class="block text-sm font-medium text-gray-700">Trigger</label>
                        <select name="trigger_type" id="trigger_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Pilih Trigger</option>
                            <option value="payment_uploaded" {{ old('trigger_type') == 'payment_uploaded' ? 'selected' : '' }}>Upload Bukti Pembayaran</option>
                            <option value="payment_verified" {{ old('trigger_type') == 'payment_verified' ? 'selected' : '' }}>Pembayaran Diverifikasi</option>
                            <option value="payment_rejected" {{ old('trigger_type') == 'payment_rejected' ? 'selected' : '' }}>Pembayaran Ditolak</option>
                        </select>
                        @error('trigger_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700">Subject Email</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="body" class="block text-sm font-medium text-gray-700">Isi Email</label>
                        <div class="mt-1">
                            <textarea name="body" id="body" rows="10" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('body') }}</textarea>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">
                            Gunakan variabel berikut dalam template: {nama}, {nim}, {jumlah_pembayaran}, {tanggal_pembayaran}, {status_pembayaran}, {keterangan}
                        </p>
                        @error('body')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                Template Aktif
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan Template
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection 
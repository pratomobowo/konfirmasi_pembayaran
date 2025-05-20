@extends('layouts.admin')

@section('content')
    <x-page-header>
        <x-slot name="title">Template Email</x-slot>
        <x-slot name="description">
            Kelola template email yang akan dikirim secara otomatis saat terjadi aktivitas tertentu di sistem.
        </x-slot>
        <x-slot name="actions">
            <a href="{{ route('admin.email-templates.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Template
            </a>
        </x-slot>
    </x-page-header>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 bg-blue-50">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Daftar Template Email
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Template yang akan digunakan untuk mengirim email otomatis.
            </p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trigger</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($templates as $template)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $template->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @switch($template->trigger_type)
                                    @case('payment_uploaded')
                                        Upload Bukti Pembayaran
                                        @break
                                    @case('payment_verified')
                                        Pembayaran Diverifikasi
                                        @break
                                    @case('payment_rejected')
                                        Pembayaran Ditolak
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $template->subject }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $template->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $template->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.email-templates.edit', $template) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                <form action="{{ route('admin.email-templates.toggle-status', $template) }}" method="POST" class="inline ml-2">
                                    @csrf
                                    <button type="submit" class="text-gray-600 hover:text-gray-900">
                                        {{ $template->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.email-templates.destroy', $template) }}" method="POST" class="inline ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus template ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Belum ada template email yang dibuat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection 
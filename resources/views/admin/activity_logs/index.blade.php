@extends('layouts.admin')

@section('content')
    <x-page-header>
        <x-slot name="title">Log Aktivitas</x-slot>
        <x-slot name="description">
            Pantau dan kelola semua aktivitas yang terjadi di sistem. Filter berdasarkan aksi, modul, tanggal, dan pengguna untuk analisis yang lebih detail.
        </x-slot>
        <x-slot name="actions">
            @if(auth()->user()->role === 'super_admin')
            <form action="{{ route('admin.activity-logs.clear-all') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Apakah Anda yakin ingin menghapus semua log aktivitas?')">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus Semua Log
                </button>
            </form>
            @endif
        </x-slot>
    </x-page-header>

    <div class="space-y-6">
        <!-- Filters -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-blue-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Filter Log Aktivitas
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Filter log berdasarkan aksi, modul, dan rentang tanggal.
                </p>
            </div>
            <div class="border-t border-gray-200 p-6">
                <form action="{{ route('admin.activity-logs.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="action" class="block text-sm font-medium text-gray-700">Aksi</label>
                        <select name="action" id="action" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Semua Aksi</option>
                            @foreach($actions as $action)
                                <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>{{ $action }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="module" class="block text-sm font-medium text-gray-700">Modul</label>
                        <select name="module" id="module" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Semua Modul</option>
                            @foreach($modules as $module)
                                <option value="{{ $module }}" {{ request('module') == $module ? 'selected' : '' }}>{{ $module }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="date_to" class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                        <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-4 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Activity Logs Table -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-blue-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Daftar Log Aktivitas
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Tabel menampilkan semua aktivitas yang tercatat dalam sistem.
                </p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modul</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($logs as $log)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $log->created_at->format('d/m/Y H:i:s') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $log->user_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $log->user_role }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($log->action === 'create') bg-green-100 text-green-800
                                        @elseif($log->action === 'update') bg-blue-100 text-blue-800
                                        @elseif($log->action === 'delete') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $log->module }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ Str::limit($log->description, 50) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.activity-logs.show', $log) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                    @if(auth()->user()->role === 'super_admin')
                                        <form action="{{ route('admin.activity-logs.destroy', $log) }}" method="POST" class="inline ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus log ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    Tidak ada log aktivitas yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
@endsection 
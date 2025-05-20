@extends('layouts.admin')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Template Email</h2>
            <a href="{{ route('admin.email-templates.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.email-templates.update', $emailTemplate) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Template</label>
                <input type="text" name="name" id="name" value="{{ old('name', $emailTemplate->name) }}" 
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="subject" class="block text-sm font-medium text-gray-700">Subjek Email</label>
                <input type="text" name="subject" id="subject" value="{{ old('subject', $emailTemplate->subject) }}"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('subject') border-red-500 @enderror">
                @error('subject')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="trigger_type" class="block text-sm font-medium text-gray-700">Tipe Trigger</label>
                <input type="text" name="trigger_type" id="trigger_type" value="{{ old('trigger_type', $emailTemplate->trigger_type) }}"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('trigger_type') border-red-500 @enderror">
                @error('trigger_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-700">Isi Email</label>
                <textarea name="body" id="body" rows="10"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('body') border-red-500 @enderror">{{ old('body', $emailTemplate->body) }}</textarea>
                @error('body')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">
                    Variabel yang tersedia: {nama}, {nim}, {jumlah_pembayaran}, {tanggal_pembayaran}, {status_pembayaran}, {keterangan}
                </p>
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $emailTemplate->is_active) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-600">Aktif</span>
                </label>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 
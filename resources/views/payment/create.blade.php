<x-guest-layout>
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-3xl font-bold">Upload Bukti Pembayaran</h1>
            <p class="mt-2 text-blue-100">
                Isi formulir berikut untuk mengupload bukti pembayaran Anda
            </p>
        </div>
    </div>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    <!-- Step Indicator -->
                    <div class="mb-8 hidden md:block">
                        <div class="flex items-center">
                            <div class="flex items-center relative">
                                <div class="rounded-full h-10 w-10 flex items-center justify-center bg-blue-600 text-white text-lg font-semibold">
                                    1
                                </div>
                                <div class="absolute top-0 -ml-4 text-xs mt-12 w-32 text-center">
                                    <span class="text-blue-600 font-semibold">Isi Data</span>
                                </div>
                            </div>
                            <div class="flex-1 border-t-2 border-blue-600"></div>
                            <div class="flex items-center relative">
                                <div class="rounded-full h-10 w-10 flex items-center justify-center bg-gray-300 text-gray-600 text-lg font-semibold">
                                    2
                                </div>
                                <div class="absolute top-0 -ml-4 text-xs mt-12 w-32 text-center">
                                    <span class="text-gray-600">Upload Bukti</span>
                                </div>
                            </div>
                            <div class="flex-1 border-t-2 border-gray-300"></div>
                            <div class="flex items-center relative">
                                <div class="rounded-full h-10 w-10 flex items-center justify-center bg-gray-300 text-gray-600 text-lg font-semibold">
                                    3
                                </div>
                                <div class="absolute top-0 -ml-4 text-xs mt-12 w-32 text-center">
                                    <span class="text-gray-600">Selesai</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Instructions -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Informasi Pembayaran</h2>
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-800">
                                        Pastikan data yang diinput benar dan bukti pembayaran yang diunggah jelas. Pembayaran akan diverifikasi oleh admin dalam 1-2 hari kerja.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                                    <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        
                        <!-- Student Information Section -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b">
                                <span class="border-b-2 border-blue-500 pb-2">Informasi Mahasiswa</span>
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="student_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" name="student_name" id="student_name" value="{{ old('student_name') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                                
                                <div>
                                    <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                                    <input type="text" name="nim" id="nim" value="{{ old('nim') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                                
                                <div>
                                    <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        placeholder="Contoh: 081234567890">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Information Section -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b">
                                <span class="border-b-2 border-blue-500 pb-2">Informasi Pembayaran</span>
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="payment_type" class="block text-sm font-medium text-gray-700">Jenis Pembayaran</label>
                                    <select name="payment_type" id="payment_type" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        <option value="">Pilih Jenis Pembayaran</option>
                                        @foreach($paymentTypes as $value => $label)
                                            <option value="{{ $value }}" {{ old('payment_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="amount" class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">Rp</span>
                                        </div>
                                        <input type="number" name="amount" id="amount" value="{{ old('amount') }}" min="1" required
                                            class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                            placeholder="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Proof Upload Section -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b">
                                <span class="border-b-2 border-blue-500 pb-2">Bukti Pembayaran</span>
                            </h3>
                            <div>
                                <label for="payment_proof" class="block text-sm font-medium text-gray-700 mb-2">Unggah Bukti Pembayaran</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="payment_proof" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Upload bukti pembayaran</span>
                                                <input id="payment_proof" name="payment_proof" type="file" class="sr-only" required accept="image/jpeg,image/png,image/jpg,application/pdf">
                                            </label>
                                            <p class="pl-1">atau seret dan lepas</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            Format: JPEG, PNG, JPG, PDF (max. 2MB)
                                        </p>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500" id="file-name"></p>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-200 pt-6">
                            <div class="flex justify-end space-x-4">
                                <a href="{{ route('home') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Batal
                                </a>
                                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Upload Bukti Pembayaran
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('payment_proof');
            const fileNameDisplay = document.getElementById('file-name');
            
            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    fileNameDisplay.textContent = 'File dipilih: ' + fileInput.files[0].name;
                    fileNameDisplay.classList.add('text-green-600');
                } else {
                    fileNameDisplay.textContent = '';
                }
            });
        });
    </script>
</x-guest-layout> 
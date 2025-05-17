@extends('layouts.admin')

@section('content')
    <x-page-header>
        <x-slot name="title">Pengaturan Aplikasi</x-slot>
        <x-slot name="description">
            Konfigurasi parameter sistem dan pengaturan email. Atur konfigurasi SMTP dan lakukan pengujian koneksi email.
        </x-slot>
    </x-page-header>

    <div class="space-y-6">
        <!-- SMTP Settings Card -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-blue-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Konfigurasi SMTP
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Pengaturan untuk mengirim email dari aplikasi menggunakan SMTP.
                </p>
            </div>

            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="border-t border-gray-200">
                <form action="{{ route('admin.settings.smtp.update') }}" method="POST" class="p-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <!-- Mail Driver -->
                        <div class="sm:col-span-3">
                            <label for="mail_mailer" class="block text-sm font-medium text-gray-700">Mail Driver</label>
                            <div class="mt-1">
                                <select id="mail_mailer" name="mail_mailer" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="smtp" {{ isset($smtpSettings['mail_mailer']) && $smtpSettings['mail_mailer']->value === 'smtp' ? 'selected' : '' }}>SMTP</option>
                                    <option value="sendmail" {{ isset($smtpSettings['mail_mailer']) && $smtpSettings['mail_mailer']->value === 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                                    <option value="mailgun" {{ isset($smtpSettings['mail_mailer']) && $smtpSettings['mail_mailer']->value === 'mailgun' ? 'selected' : '' }}>Mailgun</option>
                                </select>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Driver yang digunakan untuk mengirim email.</p>
                        </div>

                        <!-- SMTP Host -->
                        <div class="sm:col-span-3">
                            <label for="mail_host" class="block text-sm font-medium text-gray-700">SMTP Host</label>
                            <div class="mt-1">
                                <input type="text" name="mail_host" id="mail_host" value="{{ isset($smtpSettings['mail_host']) ? $smtpSettings['mail_host']->value : 'smtp.gmail.com' }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Contoh: smtp.gmail.com</p>
                        </div>

                        <!-- SMTP Port -->
                        <div class="sm:col-span-3">
                            <label for="mail_port" class="block text-sm font-medium text-gray-700">SMTP Port</label>
                            <div class="mt-1">
                                <input type="number" name="mail_port" id="mail_port" value="{{ isset($smtpSettings['mail_port']) ? $smtpSettings['mail_port']->value : '587' }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Contoh: 587 (TLS) atau 465 (SSL)</p>
                        </div>

                        <!-- SMTP Encryption -->
                        <div class="sm:col-span-3">
                            <label for="mail_encryption" class="block text-sm font-medium text-gray-700">SMTP Encryption</label>
                            <div class="mt-1">
                                <select id="mail_encryption" name="mail_encryption" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="tls" {{ isset($smtpSettings['mail_encryption']) && $smtpSettings['mail_encryption']->value === 'tls' ? 'selected' : '' }}>TLS</option>
                                    <option value="ssl" {{ isset($smtpSettings['mail_encryption']) && $smtpSettings['mail_encryption']->value === 'ssl' ? 'selected' : '' }}>SSL</option>
                                    <option value="null" {{ isset($smtpSettings['mail_encryption']) && $smtpSettings['mail_encryption']->value === 'null' ? 'selected' : '' }}>None</option>
                                </select>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Jenis enkripsi yang digunakan.</p>
                        </div>

                        <!-- SMTP Username -->
                        <div class="sm:col-span-3">
                            <label for="mail_username" class="block text-sm font-medium text-gray-700">SMTP Username</label>
                            <div class="mt-1">
                                <input type="email" name="mail_username" id="mail_username" value="{{ isset($smtpSettings['mail_username']) ? $smtpSettings['mail_username']->value : '' }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Alamat email Gmail Anda.</p>
                        </div>

                        <!-- SMTP Password -->
                        <div class="sm:col-span-3">
                            <label for="mail_password" class="block text-sm font-medium text-gray-700">SMTP Password</label>
                            <div class="mt-1">
                                <input type="password" name="mail_password" id="mail_password" placeholder="{{ isset($smtpSettings['mail_password']) && !empty($smtpSettings['mail_password']->value) ? '••••••••••••••••' : '' }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">App Password dari Google (bukan password Gmail). <a href="https://support.google.com/accounts/answer/185833" target="_blank" class="text-blue-600 hover:underline">Cara mendapatkan App Password</a></p>
                        </div>

                        <!-- From Address -->
                        <div class="sm:col-span-3">
                            <label for="mail_from_address" class="block text-sm font-medium text-gray-700">From Address</label>
                            <div class="mt-1">
                                <input type="email" name="mail_from_address" id="mail_from_address" value="{{ isset($smtpSettings['mail_from_address']) ? $smtpSettings['mail_from_address']->value : 'noreply@usbypkp.test' }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Alamat email pengirim.</p>
                        </div>

                        <!-- From Name -->
                        <div class="sm:col-span-3">
                            <label for="mail_from_name" class="block text-sm font-medium text-gray-700">From Name</label>
                            <div class="mt-1">
                                <input type="text" name="mail_from_name" id="mail_from_name" value="{{ isset($smtpSettings['mail_from_name']) ? $smtpSettings['mail_from_name']->value : 'USBYPKP' }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Nama pengirim yang ditampilkan.</p>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan Konfigurasi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Test Email Card -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-green-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Test Konfigurasi SMTP
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Kirim email pengujian untuk memastikan konfigurasi SMTP berfungsi dengan baik.
                </p>
            </div>
            <div class="border-t border-gray-200">
                <form action="{{ route('admin.settings.smtp.test') }}" method="POST" class="p-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="test_email" class="block text-sm font-medium text-gray-700">Alamat Email Tujuan</label>
                            <div class="mt-1">
                                <input type="email" name="test_email" id="test_email" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="email@example.com">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Email pengujian akan dikirim ke alamat ini.</p>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Kirim Email Pengujian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection 
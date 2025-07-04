@extends('layouts.admin')

@section('content')
    <x-page-header>
        <x-slot name="title">Laporan Bulanan</x-slot>
        <x-slot name="description">
            Laporan pembayaran untuk periode bulanan. Filter berdasarkan bulan untuk melihat ringkasan dan detail pembayaran.
        </x-slot>
    </x-page-header>

    <div class="space-y-6">
        <!-- Month Filter -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-blue-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Filter Bulan
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Pilih bulan dan tahun untuk melihat laporan.
                </p>
            </div>
            <div class="border-t border-gray-200 p-6">
                <form action="{{ route('admin.reports.monthly') }}" method="GET" class="flex flex-wrap items-end gap-4">
                    <div class="w-full max-w-xs">
                        <label for="month" class="block text-sm font-medium text-gray-700 mb-1">Bulan dan Tahun</label>
                        <input type="month" name="month" id="month" value="{{ $selectedMonth ?? Carbon\Carbon::now()->format('Y-m') }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Terapkan Filter
                    </button>
                </form>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Payments Card -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 rounded-full p-3 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Pembayaran</p>
                            <p class="text-xl font-bold text-gray-900">{{ $totalPayments ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Verified Payments Card -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 rounded-full p-3 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pembayaran Terverifikasi</p>
                            <p class="text-xl font-bold text-gray-900">{{ $verifiedPayments ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Amount Card -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-100 rounded-full p-3 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Pendapatan</p>
                            <p class="text-xl font-bold text-gray-900">Rp {{ number_format($totalAmount ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daily Summary Chart -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-blue-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Grafik Pembayaran Harian
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Ringkasan pembayaran harian dalam bulan {{ isset($selectedMonth) ? \Carbon\Carbon::parse($selectedMonth . '-01')->format('F Y') : \Carbon\Carbon::now()->format('F Y') }}.
                </p>
            </div>
            <div class="border-t border-gray-200 p-6">
                <div style="height: 300px;">
                    <!-- Canvas for Chart.js -->
                    <canvas id="dailyPaymentsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Daily Breakdown Table -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-blue-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Rincian Pembayaran Harian
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Detail pembayaran per hari dalam bulan {{ isset($selectedMonth) ? \Carbon\Carbon::parse($selectedMonth . '-01')->format('F Y') : \Carbon\Carbon::now()->format('F Y') }}.
                </p>
            </div>
            <div class="border-t border-gray-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    @if(isset($dailyBreakdown) && count($dailyBreakdown) > 0)
                    <form action="{{ route('admin.reports.export') }}" method="POST" class="ml-auto">
                        @csrf
                        <input type="hidden" name="type" value="monthly">
                        <input type="hidden" name="month" value="{{ $selectedMonth ?? \Carbon\Carbon::now()->format('Y-m') }}">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Export Data
                        </button>
                    </form>
                    @endif
                </div>

                @if(isset($dailyBreakdown) && count($dailyBreakdown) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Pembayaran</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terverifikasi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menunggu</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ditolak</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Pendapatan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($dailyBreakdown as $day)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($day->date)->format('d F Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $day->total_payments ?? 0 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $day->verified_payments ?? 0 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $day->pending_payments ?? 0 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $day->rejected_payments ?? 0 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp {{ number_format($day->total_amount ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">
                                        <a href="{{ route('admin.reports.daily', ['date' => $day->date]) }}" class="hover:text-blue-900">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="py-8 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data</h3>
                    <p class="mt-1 text-sm text-gray-500">Tidak ada pembayaran yang ditemukan pada bulan tersebut.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Payments Table -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-blue-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Daftar Pembayaran
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Daftar pembayaran yang terkait dengan laporan bulanan.
                </p>
            </div>
            <div class="border-t border-gray-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    @if(isset($payments) && count($payments) > 0)
                    <form action="{{ route('admin.reports.export') }}" method="POST" class="ml-auto">
                        @csrf
                        <input type="hidden" name="type" value="monthly">
                        <input type="hidden" name="month" value="{{ $selectedMonth ?? \Carbon\Carbon::now()->format('Y-m') }}">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Export Data
                        </button>
                    </form>
                    @endif
                </div>

                @if(isset($payments) && count($payments) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($payments as $payment)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $payment->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->student_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->nim }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ route('admin.payments.show', $payment->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if(isset($payments) && method_exists($payments, 'links'))
                <div class="mt-4 flex justify-between items-center">
                    <form method="GET" action="{{ route('admin.reports.monthly') }}" class="flex items-center">
                        <input type="hidden" name="month" value="{{ $selectedMonth ?? \Carbon\Carbon::now()->format('Y-m') }}">
                        <x-pagination-length :paginator="$payments" />
                    </form>
                    {{ $payments->appends(request()->except('page'))->links() }}
                </div>
                @endif
                @else
                <div class="py-8 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data</h3>
                    <p class="mt-1 text-sm text-gray-500">Tidak ada pembayaran yang ditemukan pada bulan tersebut.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('dailyPaymentsChart').getContext('2d');
            
            // Check if data exists
            @if(isset($chartData))
            const chartData = @json($chartData);
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [
                        {
                            label: 'Pembayaran Terverifikasi',
                            data: chartData.verified,
                            backgroundColor: 'rgba(16, 185, 129, 0.7)',
                            borderColor: 'rgb(16, 185, 129)',
                            borderWidth: 1
                        },
                        {
                            label: 'Pembayaran Menunggu',
                            data: chartData.pending,
                            backgroundColor: 'rgba(245, 158, 11, 0.7)',
                            borderColor: 'rgb(245, 158, 11)',
                            borderWidth: 1
                        },
                        {
                            label: 'Pembayaran Ditolak',
                            data: chartData.rejected,
                            backgroundColor: 'rgba(239, 68, 68, 0.7)',
                            borderColor: 'rgb(239, 68, 68)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    }
                }
            });
            @else
            // Display message when no data
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Tidak ada data'],
                    datasets: [{
                        label: 'Tidak ada data pembayaran',
                        data: [0],
                        backgroundColor: 'rgba(156, 163, 175, 0.5)',
                        borderColor: 'rgb(156, 163, 175)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });
            @endif
        });
    </script>
    @endpush
@endsection 
<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    public function run()
    {
        $templates = [
            [
                'name' => 'Notifikasi Upload Bukti Pembayaran',
                'subject' => 'Bukti Pembayaran Berhasil Diupload',
                'body' => 'Halo {nama},

Terima kasih telah mengupload bukti pembayaran sebesar Rp {jumlah_pembayaran} pada {tanggal_pembayaran}.

Detail pembayaran:
- NIM: {nim}
- Jumlah: Rp {jumlah_pembayaran}
- Status: {status_pembayaran}
- Keterangan: {keterangan}

Tim admin akan segera memverifikasi pembayaran Anda. Mohon tunggu notifikasi selanjutnya.

Terima kasih.',
                'trigger_type' => 'payment_uploaded',
                'is_active' => true
            ],
            [
                'name' => 'Notifikasi Pembayaran Diverifikasi',
                'subject' => 'Pembayaran Berhasil Diverifikasi',
                'body' => 'Halo {nama},

Pembayaran Anda sebesar Rp {jumlah_pembayaran} pada {tanggal_pembayaran} telah berhasil diverifikasi.

Detail pembayaran:
- NIM: {nim}
- Jumlah: Rp {jumlah_pembayaran}
- Status: {status_pembayaran}
- Keterangan: {keterangan}

Terima kasih telah melakukan pembayaran tepat waktu.',
                'trigger_type' => 'payment_verified',
                'is_active' => true
            ],
            [
                'name' => 'Notifikasi Pembayaran Ditolak',
                'subject' => 'Pembayaran Ditolak',
                'body' => 'Halo {nama},

Mohon maaf, pembayaran Anda sebesar Rp {jumlah_pembayaran} pada {tanggal_pembayaran} ditolak.

Detail pembayaran:
- NIM: {nim}
- Jumlah: Rp {jumlah_pembayaran}
- Status: {status_pembayaran}
- Keterangan: {keterangan}

Silakan upload ulang bukti pembayaran yang valid atau hubungi admin untuk informasi lebih lanjut.

Terima kasih.',
                'trigger_type' => 'payment_rejected',
                'is_active' => true
            ]
        ];

        foreach ($templates as $template) {
            EmailTemplate::create($template);
        }
    }
} 
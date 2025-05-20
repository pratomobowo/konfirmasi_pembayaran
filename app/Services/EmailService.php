<?php

namespace App\Services;

use App\Models\EmailTemplate;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendPaymentUploadedEmail(Payment $payment)
    {
        $template = EmailTemplate::getTemplateByTrigger('payment_uploaded');
        if (!$template) return;

        $data = [
            'nama' => $payment->student_name,
            'nim' => $payment->nim,
            'jumlah_pembayaran' => number_format($payment->amount, 0, ',', '.'),
            'tanggal_pembayaran' => $payment->created_at->format('d/m/Y H:i:s'),
            'status_pembayaran' => 'Menunggu Verifikasi',
            'keterangan' => $payment->description
        ];

        $emailContent = $template->replaceVariables($data);

        Mail::send('emails.payment', [
            'content' => $emailContent['body']
        ], function ($message) use ($payment, $emailContent) {
            $message->to($payment->email)
                ->subject($emailContent['subject']);
        });
    }

    public function sendPaymentVerifiedEmail(Payment $payment)
    {
        try {
            $template = EmailTemplate::getTemplateByTrigger('payment_verified');
            if (!$template) {
                \Illuminate\Support\Facades\Log::error("Email template 'payment_verified' not found or not active");
                return;
            }

            $data = [
                'nama' => $payment->student_name,
                'nim' => $payment->nim,
                'jumlah_pembayaran' => number_format($payment->amount, 0, ',', '.'),
                'tanggal_pembayaran' => $payment->created_at->format('d/m/Y H:i:s'),
                'status_pembayaran' => 'Diverifikasi',
                'keterangan' => $payment->admin_note ?? $payment->notes ?? 'Pembayaran telah diverifikasi'
            ];

            $emailContent = $template->replaceVariables($data);

            Mail::send('emails.payment', [
                'content' => $emailContent['body']
            ], function ($message) use ($payment, $emailContent) {
                $message->to($payment->email)
                    ->subject($emailContent['subject']);
            });

            \Illuminate\Support\Facades\Log::info("Verification email sent to {$payment->email}");
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send verification email: " . $e->getMessage());
        }
    }

    public function sendPaymentRejectedEmail(Payment $payment)
    {
        try {
            $template = EmailTemplate::getTemplateByTrigger('payment_rejected');
            if (!$template) {
                \Illuminate\Support\Facades\Log::error("Email template 'payment_rejected' not found or not active");
                return;
            }

            $data = [
                'nama' => $payment->student_name,
                'nim' => $payment->nim,
                'jumlah_pembayaran' => number_format($payment->amount, 0, ',', '.'),
                'tanggal_pembayaran' => $payment->created_at->format('d/m/Y H:i:s'),
                'status_pembayaran' => 'Ditolak',
                'keterangan' => $payment->admin_note ?? $payment->notes ?? 'Pembayaran ditolak'
            ];

            $emailContent = $template->replaceVariables($data);

            Mail::send('emails.payment', [
                'content' => $emailContent['body']
            ], function ($message) use ($payment, $emailContent) {
                $message->to($payment->email)
                    ->subject($emailContent['subject']);
            });

            \Illuminate\Support\Facades\Log::info("Rejection email sent to {$payment->email}");
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send rejection email: " . $e->getMessage());
        }
    }
} 
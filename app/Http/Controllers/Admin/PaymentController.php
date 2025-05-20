<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\EmailService;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function verify(Request $request, Payment $payment)
    {
        $request->validate([
            'admin_note' => 'nullable|string|max:255'
        ]);

        $payment->update([
            'status' => 'verified',
            'admin_note' => $request->admin_note,
            'verified_at' => now(),
            'verified_by' => auth()->id()
        ]);

        // Send email notification
        $this->emailService->sendPaymentVerifiedEmail($payment);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    public function reject(Request $request, Payment $payment)
    {
        $request->validate([
            'admin_note' => 'required|string|max:255'
        ]);

        $payment->update([
            'status' => 'rejected',
            'admin_note' => $request->admin_note,
            'verified_at' => now(),
            'verified_by' => auth()->id()
        ]);

        // Send email notification
        $this->emailService->sendPaymentRejectedEmail($payment);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil ditolak.');
    }
} 
<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    // Display the payment list for public view
    public function index()
    {
        $payments = Payment::latest()->paginate(10);
        return view('payment.index', compact('payments'));
    }

    // Show the payment form
    public function create()
    {
        // Get active payment types from the database
        $paymentTypes = PaymentType::where('is_active', true)
            ->orderBy('name')
            ->pluck('name', 'name')
            ->toArray();
        
        return view('payment.create', compact('paymentTypes'));
    }

    // Store the payment data
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'payment_type' => 'required|string|max:100|exists:payment_types,name',
            'amount' => 'required|numeric|min:1',
            'payment_proof' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        // Handle file upload
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Create payment record
        Payment::create([
            'student_name' => $request->student_name,
            'nim' => $request->nim,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'payment_type' => $request->payment_type,
            'amount' => $request->amount,
            'payment_proof' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('payment.success')
            ->with('success', 'Bukti pembayaran berhasil dikirim. Silahkan tunggu proses verifikasi.');
    }

    // Show success page after submission
    public function success()
    {
        return view('payment.success');
    }

    // Track payment status by NIM
    public function trackStatus(Request $request)
    {
        // Cek apakah ada parameter nim di URL
        if ($request->has('nim')) {
            return $this->checkStatus($request);
        }
        
        return view('payment.track');
    }

    // Process the tracking request
    public function checkStatus(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:50',
        ]);

        $payments = Payment::where('nim', $request->nim)
            ->latest()
            ->get();

        if ($payments->isEmpty()) {
            return back()->with('error', 'Tidak ada data pembayaran dengan NIM tersebut.');
        }

        // Return view dengan payments langsung untuk menghindari masalah rendering
        return view('payment.track', [
            'payments' => $payments,
            'nimFound' => true,
            'nim' => $request->nim
        ]);
    }

    /**
     * Check payment status by NIM.
     */
    public function checkPaymentStatus(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|min:6',
        ]);

        $nim = $request->nim;
        
        // Find payments by NIM
        $payments = Payment::where('nim', $nim)->get();
        
        if ($payments->isEmpty()) {
            return redirect()->route('payment.track')
                ->with('error', 'Tidak ditemukan pembayaran dengan NIM: ' . $nim);
        }
        
        return view('payment.track', [
            'payments' => $payments,
            'nim' => $nim,
            'nimFound' => true
        ]);
    }

    /**
     * Show payment detail by ID.
     */
    public function showDetail($id)
    {
        $payment = Payment::findOrFail($id);
        
        return view('payment.detail', [
            'payment' => $payment
        ]);
    }
}

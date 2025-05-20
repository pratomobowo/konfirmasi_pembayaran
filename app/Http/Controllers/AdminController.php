<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Services\ActivityLogService;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    // Admin dashboard
    public function dashboard()
    {
        $stats = [
            'total' => Payment::count(),
            'pending' => Payment::where('status', 'pending')->count(),
            'verified' => Payment::where('status', 'verified')->count(),
            'rejected' => Payment::where('status', 'rejected')->count(),
        ];
        
        $recentPayments = Payment::latest()->take(5)->get();
        $totalUsers = User::count();
        $totalPayments = Payment::count();
        
        return view('admin.dashboard', compact('stats', 'recentPayments', 'totalUsers', 'totalPayments'));
    }
    
    // List all payments for admin
    public function payments(Request $request)
    {
        $query = Payment::latest();
        
        if ($request->has('status') && in_array($request->status, ['pending', 'verified', 'rejected'])) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $perPage = $request->input('per_page', 10);
        $payments = $query->paginate($perPage)->withQueryString();
        
        return view('admin.payments.index', compact('payments'));
    }
    
    // Show payment detail
    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return view('admin.payments.show', compact('payment'));
    }
    
    // Verify a payment
    public function verify($id)
    {
        $payment = Payment::findOrFail($id);
        
        // Simpan data lama sebelum diupdate
        $oldValues = $payment->toArray();
        
        $payment->update([
            'status' => 'verified',
            'verified_at' => now(),
            'verified_by' => auth()->id(),
        ]);
        
        // Log aktivitas verifikasi pembayaran
        ActivityLogService::logUpdate(
            'payment',
            "Pembayaran untuk {$payment->student_name} (NIM: {$payment->nim}) telah diverifikasi",
            $oldValues,
            $payment->fresh()->toArray(),
            $payment->id
        );
        
        // Send email notification
        try {
            $this->emailService->sendPaymentVerifiedEmail($payment);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send verification email: " . $e->getMessage());
        }
        
        // Check if request wants JSON response (from AJAX)
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil diverifikasi.',
                'payment' => $payment
            ]);
        }
        
        return redirect()->route('admin.payments.show', $id)
            ->with('success', 'Pembayaran berhasil diverifikasi.');
    }
    
    // Reject a payment
    public function reject(Request $request, $id)
    {
        $notes = $request->input('notes');
        
        // Validasi data
        if (empty($notes)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Alasan penolakan wajib diisi.'
                ], 422);
            }
            
            return back()->withErrors(['notes' => 'Alasan penolakan wajib diisi.']);
        }
        
        $payment = Payment::findOrFail($id);
        
        // Simpan data lama sebelum diupdate
        $oldValues = $payment->toArray();
        
        $payment->update([
            'status' => 'rejected',
            'notes' => $notes,
        ]);
        
        // Log aktivitas penolakan pembayaran
        ActivityLogService::logUpdate(
            'payment',
            "Pembayaran untuk {$payment->student_name} (NIM: {$payment->nim}) telah ditolak dengan catatan: {$notes}",
            $oldValues,
            $payment->fresh()->toArray(),
            $payment->id
        );
        
        // Send email notification
        try {
            $this->emailService->sendPaymentRejectedEmail($payment);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send rejection email: " . $e->getMessage());
        }
        
        // Check if request wants JSON response (from AJAX)
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pembayaran telah ditolak.',
                'payment' => $payment
            ]);
        }
        
        return redirect()->route('admin.payments.show', $id)
            ->with('success', 'Pembayaran telah ditolak.');
    }
    
    // Export payments to CSV/Excel
    public function export()
    {
        // This would typically use a package like Laravel Excel
        // Simplified for this example
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="payments.csv"',
        ];
        
        $payments = Payment::all();
        $columns = ['ID', 'Nama', 'NIM', 'Email', 'Jenis Pembayaran', 'Jumlah', 'Status', 'Tanggal'];
        
        $callback = function() use ($payments, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            foreach ($payments as $payment) {
                fputcsv($file, [
                    $payment->id,
                    $payment->student_name,
                    $payment->nim,
                    $payment->email,
                    $payment->payment_type,
                    $payment->amount,
                    $payment->status,
                    $payment->created_at->format('Y-m-d'),
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}

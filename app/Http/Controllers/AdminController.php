<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
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
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $payments = $query->paginate(10)->withQueryString();
        
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
        $payment->update([
            'status' => 'verified',
            'verified_at' => now(),
        ]);
        
        return redirect()->route('admin.payments.show', $id)
            ->with('success', 'Pembayaran berhasil diverifikasi.');
    }
    
    // Reject a payment
    public function reject(Request $request, $id)
    {
        $request->validate([
            'notes' => 'required|string|max:500'
        ]);
        
        $payment = Payment::findOrFail($id);
        $payment->update([
            'status' => 'rejected',
            'notes' => $request->notes,
        ]);
        
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
                    $payment->name,
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

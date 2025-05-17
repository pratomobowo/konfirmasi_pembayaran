<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the payment types.
     */
    public function index()
    {
        // Only allow super admin and finance admin to access
        if (auth()->user()->role !== 'super_admin' && auth()->user()->role !== 'finance_admin') {
            abort(403, 'Unauthorized action.');
        }
        
        $paymentTypes = PaymentType::orderBy('name')->paginate(10);
        return view('admin.payment-types.index', compact('paymentTypes'));
    }

    /**
     * Show the form for creating a new payment type.
     */
    public function create()
    {
        // Only allow super admin and finance admin to access
        if (auth()->user()->role !== 'super_admin' && auth()->user()->role !== 'finance_admin') {
            abort(403, 'Unauthorized action.');
        }
        
        return view('admin.payment-types.create');
    }

    /**
     * Store a newly created payment type in storage.
     */
    public function store(Request $request)
    {
        // Only allow super admin and finance admin to access
        if (auth()->user()->role !== 'super_admin' && auth()->user()->role !== 'finance_admin') {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'name' => 'required|string|max:100|unique:payment_types',
            'description' => 'nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
        ]);

        PaymentType::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.payment-types.index')
            ->with('success', 'Jenis pembayaran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified payment type.
     */
    public function edit(PaymentType $paymentType)
    {
        // Only allow super admin and finance admin to access
        if (auth()->user()->role !== 'super_admin' && auth()->user()->role !== 'finance_admin') {
            abort(403, 'Unauthorized action.');
        }
        
        return view('admin.payment-types.edit', compact('paymentType'));
    }

    /**
     * Update the specified payment type in storage.
     */
    public function update(Request $request, PaymentType $paymentType)
    {
        // Only allow super admin and finance admin to access
        if (auth()->user()->role !== 'super_admin' && auth()->user()->role !== 'finance_admin') {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'name' => 'required|string|max:100|unique:payment_types,name,' . $paymentType->id,
            'description' => 'nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
        ]);

        $paymentType->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.payment-types.index')
            ->with('success', 'Jenis pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified payment type from storage.
     */
    public function destroy(PaymentType $paymentType)
    {
        // Only allow super admin and finance admin to access
        if (auth()->user()->role !== 'super_admin' && auth()->user()->role !== 'finance_admin') {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if this payment type is used in any payments
        $paymentsCount = $paymentType->payments()->count();
        
        if ($paymentsCount > 0) {
            return back()->with('error', 'Jenis pembayaran ini tidak dapat dihapus karena sudah digunakan dalam ' . $paymentsCount . ' pembayaran.');
        }
        
        $paymentType->delete();
        
        return redirect()->route('admin.payment-types.index')
            ->with('success', 'Jenis pembayaran berhasil dihapus.');
    }
}

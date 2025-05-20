<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use App\Services\ActivityLogService;
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

        $paymentType = PaymentType::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        // Log aktivitas pembuatan jenis pembayaran
        ActivityLogService::logCreate(
            'payment_type',
            "Jenis pembayaran baru '{$paymentType->name}' telah dibuat",
            $paymentType,
            $paymentType->id
        );

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

        // Simpan data lama sebelum diupdate
        $oldValues = $paymentType->toArray();
        
        $paymentType->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        // Log aktivitas update jenis pembayaran
        ActivityLogService::logUpdate(
            'payment_type',
            "Jenis pembayaran '{$paymentType->name}' telah diperbarui",
            $oldValues,
            $paymentType->fresh()->toArray(),
            $paymentType->id
        );

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
        
        // Simpan data sebelum dihapus untuk log
        $paymentTypeData = $paymentType->toArray();
        $paymentTypeName = $paymentType->name;
        $paymentTypeId = $paymentType->id;
        
        $paymentType->delete();
        
        // Log aktivitas penghapusan jenis pembayaran
        ActivityLogService::logDelete(
            'payment_type',
            "Jenis pembayaran '{$paymentTypeName}' telah dihapus",
            (object)$paymentTypeData,
            $paymentTypeId
        );
        
        return redirect()->route('admin.payment-types.index')
            ->with('success', 'Jenis pembayaran berhasil dihapus.');
    }
}

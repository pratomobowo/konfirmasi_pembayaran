<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'student_name',
        'nim',
        'email',
        'phone_number',
        'payment_type',
        'amount',
        'payment_proof',
        'status',
        'notes',
        'verified_at',
    ];
    
    protected $casts = [
        'verified_at' => 'datetime',
        'amount' => 'decimal:2',
    ];
    
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'verified' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
    
    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'pending' => 'Menunggu Verifikasi',
            'verified' => 'Terverifikasi',
            'rejected' => 'Ditolak',
            default => 'Tidak Diketahui',
        };
    }
}

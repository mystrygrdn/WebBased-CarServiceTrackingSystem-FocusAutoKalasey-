<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTracking extends Model
{
    use HasFactory;

    protected $table = 'service_tracking';

    protected $fillable = [
        'customers_id',
        'vehicles_id',
        'admin_id',
        'no_service',
        'status_timestamps',
        'status',
        'tanggal_masuk',
        'estimated_date',
        'jenis_service',
        'notes',
        'photo_url'
    ];

    protected $casts = [
        'status' => 'integer',
        'status_timestamps' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customers_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicles::class, 'vehicles_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    // ✅ TAMBAHAN (TIDAK MENGGANGGU YANG LAIN)
    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'service_tracking_id');
    }
}
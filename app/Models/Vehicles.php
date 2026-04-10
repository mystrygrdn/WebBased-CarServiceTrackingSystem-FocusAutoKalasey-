<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;

    protected $table = 'vehicles';
    protected $fillable = ['merek', 'model', 'tahun', 'warna', 'nomor_polisi', 'customers_id'];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customers_id');
    }
}
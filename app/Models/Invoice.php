<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
protected $fillable = [
'service_tracking_id',
'nomor_invoice',
'tanggal_masuk',
'subtotal',
'tax',
'total',
'pdf_url'
];


public function items()
{
return $this->hasMany(InvoiceItem::class);
}


public function serviceTracking()
{
return $this->belongsTo(ServiceTracking::class);
}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
protected $fillable = [
'invoice_id',
'pekerjaan_part',
'qty',
'harga',
'subtotal',
'keterangan'
];


public function invoice()
{
return $this->belongsTo(Invoice::class);
}
}
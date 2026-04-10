<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = ['nama', 'no_hp', 'alamat'];

    public function vehicles()
    {
        return $this->hasMany(Vehicles::class, 'customers_id');
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customers_id')
                  ->constrained('customers')
                  ->onDelete('cascade'); // otomatis hapus kendaraan jika customer dihapus
            $table->string('nomor_polisi')->unique();
            $table->string('merek');
            $table->string('model');
            $table->string('tahun', 4);
            $table->string('warna', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

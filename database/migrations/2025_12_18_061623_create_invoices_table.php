<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_tracking_id');
            $table->string('nomor_invoice')->unique();
            $table->date('tanggal_masuk');
            $table->decimal('subtotal', 15, 2);
            $table->decimal('tax', 15, 2);
            $table->decimal('total', 15, 2);
            $table->string('pdf_url')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('service_tracking_id')
                  ->references('id')
                  ->on('service_tracking')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
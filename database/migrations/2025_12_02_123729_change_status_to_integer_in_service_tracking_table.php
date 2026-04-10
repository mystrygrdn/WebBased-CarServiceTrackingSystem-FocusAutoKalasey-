<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_tracking', function (Blueprint $table) {
            // ubah status jadi angka
            $table->unsignedTinyInteger('status')->default(1)->change();
        });
    }

    public function down(): void
    {
        Schema::table('service_tracking', function (Blueprint $table) {
            $table->string('status')->default('Diterima')->change();
        });
    }
};

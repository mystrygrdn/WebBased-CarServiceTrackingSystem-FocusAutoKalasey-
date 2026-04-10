<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceTrackingTable extends Migration
{
    public function up()
    {
        Schema::create('service_tracking', function (Blueprint $table) {
            $table->id();

            // RELATIONS
            $table->unsignedBigInteger('customers_id');
            $table->unsignedBigInteger('vehicles_id');
            $table->unsignedBigInteger('admin_id')->nullable(); // boleh null kalau belum ditangani admin

            // INFO SERVICE
            $table->string('no_service')->unique();
            $table->string('status')->default('Diterima');
            $table->date('tanggal_masuk');
            $table->string('jenis_service')->nullable();
            $table->text('notes')->nullable();
            $table->string('photo_url')->nullable();

            $table->timestamps();

            // FOREIGN KE TABEL LAIN
            $table->foreign('customers_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('vehicles_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_tracking');
    }
}

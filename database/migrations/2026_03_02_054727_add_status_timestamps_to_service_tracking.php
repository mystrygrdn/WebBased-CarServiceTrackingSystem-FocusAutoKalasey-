<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('service_tracking', function (Blueprint $table) {
        $table->json('status_timestamps')->nullable()->after('status');
    });
}

public function down()
{
    Schema::table('service_tracking', function (Blueprint $table) {
        $table->dropColumn('status_timestamps');
    });
}
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('furniture_request_items', function (Blueprint $table) {
            $table->bigInteger('quantity_issued')->default(0)->after('quantity');
            $table->longText('remark')->nullable()->after('quantity_issued');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('furniture_request_items', function (Blueprint $table) {
            $table->dropColumn('quantity_issued');
            $table->dropColumn('remark');
        });
    }
};

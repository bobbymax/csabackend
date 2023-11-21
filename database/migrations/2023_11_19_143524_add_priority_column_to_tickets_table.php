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
        Schema::table('tickets', function (Blueprint $table) {
            $table->enum('priority', ['low', 'medium', 'high'])->default('low')->after('status');
            $table->bigInteger('support_id')->default(0)->after('owner_id');
            $table->string('landmark')->nullable()->after('office_number');
            $table->integer('escalated')->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('priority');
            $table->dropColumn('support_id');
            $table->dropColumn('landmark');
            $table->dropColumn('escalated');
        });
    }
};

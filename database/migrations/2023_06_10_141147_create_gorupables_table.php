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
        Schema::create('groupables', function (Blueprint $table) {
            $table->bigInteger('group_id')->unsigned();
            $table->bigInteger('groupable_id')->unsigned();
            $table->string('groupable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupables');
    }
};

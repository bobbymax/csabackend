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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('logistics_request_id')->unsigned();
            $table->foreign('logistics_request_id')->references('id')->on('logistics_requests')->onDelete('cascade');
            $table->bigInteger('user_id')->default(0);
            $table->enum('request_type', ['staff', 'third-party'])->default('staff');
            $table->enum('type', ['hotel', 'flight'])->default('flight');
            $table->enum('flight_type', ['local', 'international'])->default('local');
            $table->string('name');
            $table->string('mobile')->nullable();
            $table->dateTime('begin')->nullable();
            $table->dateTime('elapse')->nullable();
            $table->bigInteger('duration')->default(0);
            $table->string('approval_memo')->nullable();
            $table->string('data_page')->nullable();
            $table->string('visa')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};

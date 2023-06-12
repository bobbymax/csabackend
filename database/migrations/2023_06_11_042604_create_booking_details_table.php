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
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('booking_id')->unsigned();
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('room_id')->unsigned();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->bigInteger('seating_id')->unsigned();
            $table->foreign('seating_id')->references('id')->on('seatings')->onDelete('cascade');
            $table->dateTime('start')->nullable();
            $table->dateTime('finish')->nullable();
            $table->bigInteger('duration')->default(0);
            $table->boolean('pa_system')->default(false);
            $table->boolean('audio_visual_system')->default(false);
            $table->boolean('internet')->default(false);
            $table->boolean('tea_snacks')->default(false);
            $table->boolean('breakfast')->default(false);
            $table->boolean('lunch')->default(false);
            $table->longText('description')->nullable();
            $table->enum('status', ['pending', 'inprogress', 'concluded', 'noshow'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_details');
    }
};

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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->string('code')->unique();
            $table->enum('type', ['quota', 'request'])->default('request');
            $table->enum('request_type', ['self', 'third-party'])->default('self');
            $table->enum('status', ['pending', 'registered', 'in-review', 'in-progress', 'authorized', 'cancelled', 'approved', 'denied'])->default('pending');
            $table->boolean('closed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};

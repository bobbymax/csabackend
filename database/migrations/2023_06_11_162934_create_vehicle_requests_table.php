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
        Schema::create('vehicle_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('stock_type_id')->unsigned();
            $table->foreign('stock_type_id')->references('id')->on('stock_types')->onDelete('cascade');
            $table->bigInteger('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->string('code')->unique();
            $table->dateTime('required_date')->nullable();
            $table->dateTime('return_date')->nullable();
            $table->bigInteger('duration')->default(0);
            $table->text('destination')->nullable();
            $table->string('budget_code')->nullable();
            $table->decimal('cost', $precision=30, $scale=2)->default(0);
            $table->enum('nature_of_trip', ['personal', 'official'])->default('personal');
            $table->enum('status', ['pending', 'registered', 'approved', 'denied', 'processing', 'confirmed', 'canceled'])->default('pending');
            $table->boolean('closed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_requests');
    }
};

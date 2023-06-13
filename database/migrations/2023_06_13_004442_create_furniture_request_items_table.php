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
        Schema::create('furniture_request_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('furniture_request_id')->unsigned();
            $table->foreign('furniture_request_id')->references('id')->on('furniture_requests')->onDelete('cascade');
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->bigInteger('quantity')->default(0);
            $table->enum('status', ['pending', 'resolved', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furniture_request_items');
    }
};

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
        Schema::create('requisition_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('requisition_id')->unsigned();
            $table->foreign('requisition_id')->references('id')->on('requisitions')->onDelete('cascade');
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->bigInteger('quantity_expected')->default(0);
            $table->bigInteger('quantity_received')->default(0);
            $table->enum('status', ['pending', 'issued', 'unavailable'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisition_items');
    }
};

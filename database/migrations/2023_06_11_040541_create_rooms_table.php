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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hall_category_id')->unsigned();
            $table->foreign('hall_category_id')->references('id')->on('hall_categories')->onDelete('cascade');
            $table->bigInteger('wing_id')->unsigned();
            $table->foreign('wing_id')->references('id')->on('hall_categories')->onDelete('cascade');
            $table->bigInteger('floor_id')->default(0);
            $table->string('name');
            $table->bigInteger('max_sitting_capacity');
            $table->enum('status', ['available', 'occupied', 'under-maintenance', 'not-inuse'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

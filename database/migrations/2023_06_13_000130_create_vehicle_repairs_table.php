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
        Schema::create('vehicle_repairs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('complaint_id')->unsigned();
            $table->foreign('complaint_id')->references('id')->on('complaints')->onDelete('cascade');
            $table->bigInteger('repair_id')->unsigned();
            $table->foreign('repair_id')->references('id')->on('repairs')->onDelete('cascade');
            $table->decimal('cost', $precision=30, $scale=2)->default(0);
            $table->longText('description')->nullable();
            $table->enum('status', ['pending', 'sighted', 'not-sighted'])->default('pending');
            $table->boolean('attested')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_repairs');
    }
};

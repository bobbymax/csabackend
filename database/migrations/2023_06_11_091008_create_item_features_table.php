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
        Schema::create('item_features', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->string('color')->nullable();
            $table->bigInteger('tank_capacity')->default(0);
            $table->dateTime('insurance_due_date')->nullable();
            $table->boolean('due_for_servicing')->default(false);
            $table->boolean('insurance_due')->default(false);
            $table->enum('insurance_status', ['comprehensive', 'third-party-plus', 'third-party'])->default('third-party');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_features');
    }
};

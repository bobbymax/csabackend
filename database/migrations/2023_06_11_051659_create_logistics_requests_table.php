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
        Schema::create('logistics_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('budget_code')->nullable();
            $table->decimal('cost', $precision=30, $scale=2)->default(0);
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('logistics_requests');
    }
};

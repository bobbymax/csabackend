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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->enum('type', ['service', 'repair', 'incident'])->default('repair');
            $table->longText('description')->nullable();
            $table->decimal('total_cost', $precision=30, $scale=2)->default(0);
            $table->enum('status', ['pending', 'registered', 'assessment', 'review', 'inprogress', 'completed', 'approved', 'denied'])->default('pending');
            $table->enum('condition', ['pending', 'good', 'bad'])->default('pending');
            $table->boolean('closed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};

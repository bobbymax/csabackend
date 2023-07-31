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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['image', 'file', 'audio', 'video'])->default('image');
            $table->bigInteger('size')->default(0);
            $table->string('path')->unique();
            $table->string('ext')->nullable();
            $table->bigInteger('uploadable_id')->unsigned();
            $table->string('uploadable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};

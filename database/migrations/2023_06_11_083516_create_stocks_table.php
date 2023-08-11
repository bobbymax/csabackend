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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('brand_id')->default(0);
            $table->bigInteger('stock_type_id')->unsigned();
            $table->foreign('stock_type_id')->references('id')->on('stock_types')->onDelete('cascade');
            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->string('code')->unique()->nullable();
            $table->string('name');
            $table->string('label')->unique();
            $table->bigInteger('quantity')->default(0);
            $table->enum('measure', ['single', 'packs', 'boxes', 'cartons'])->default('single');
            $table->boolean('inStock')->default(false);
            $table->boolean('restockable')->default(false);
            $table->boolean('request_on_delivery')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};

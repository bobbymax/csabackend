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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stock_id')->unsigned();
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->bigInteger('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->string('barcode')->unique()->nullable();
            $table->string('name');
            $table->bigInteger('quantity')->default(0);
            $table->dateTime('date_of_purchase')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->decimal('amount', $precision=30, $scale=2)->default(0);
            $table->boolean('inStock')->default(false);
            $table->enum('status', ['serviceable', 'returned', 'allocated', 'end-of-life', 'available', 'boarded', 'faulty'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

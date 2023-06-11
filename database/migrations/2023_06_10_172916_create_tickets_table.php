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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->bigInteger('issue_id')->unsigned();
            $table->foreign('issue_id')->references('id')->on('issues')->onDelete('cascade');
            $table->bigInteger('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->bigInteger('floor_id')->default(0);
            $table->bigInteger('related_issue_id')->default(0);
            $table->string('office_number')->nullable();
            $table->text('description')->nullable();
            $table->text('additional_info')->nullable();
            $table->enum('status', ['pending', 'assigned', 'ongoing', 'resolved', 'unresolved', 'escalated'])->default('pending');
            $table->boolean('closed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

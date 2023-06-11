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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('department_type_id')->unsigned();
            $table->foreign('department_type_id')->references('id')->on('department_types')->onDelete('cascade');
            $table->string('name');
            $table->string('code')->unique();
            $table->bigInteger('controller')->default(0);
            $table->bigInteger('hod')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};

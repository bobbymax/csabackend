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
        Schema::create('departmentables', function (Blueprint $table) {
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('departmentable_id')->unsigned();
            $table->string('departmentable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departmentables');
    }
};

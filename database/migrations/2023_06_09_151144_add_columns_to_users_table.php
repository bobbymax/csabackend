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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->bigInteger('grade_level_id')->unsigned()->after('id');
            $table->foreign('grade_level_id')->references('id')->on('grade_levels')->onDelete('cascade');
            $table->bigInteger('department_id')->unsigned()->after('grade_level_id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->bigInteger('staff_type_id')->unsigned()->after('department_id');
            $table->foreign('staff_type_id')->references('id')->on('staff_types')->onDelete('cascade');
            $table->bigInteger('availability_id')->unsigned()->after('staff_type_id');
            $table->foreign('availability_id')->references('id')->on('availabilities')->onDelete('cascade');
            $table->bigInteger('location_id')->unsigned()->after('availability_id');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->bigInteger('company_id')->unsigned()->after('location_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->string('firstname')->after('company_id');
            $table->string('middlename')->nullable()->after('firstname');
            $table->string('surname')->after('middlename');
            $table->string('staff_no')->unique()->nullable()->after('surname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->dropConstrainedForeignId('grade_level_id');
            $table->dropConstrainedForeignId('department_id');
            $table->dropConstrainedForeignId('staff_type_id');
            $table->dropConstrainedForeignId('availability_id');
            $table->dropConstrainedForeignId('location_id');
            $table->dropConstrainedForeignId('company_id');
            $table->dropColumn('firstname');
            $table->dropColumn('middlename');
            $table->dropColumn('surname');
        });
    }
};

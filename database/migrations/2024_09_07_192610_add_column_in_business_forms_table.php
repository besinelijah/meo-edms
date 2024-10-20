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
        Schema::table('business_permit_forms', function (Blueprint $table) {
            $table->integer('requirement_id')->nullable();
            $table->string('file_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_permit_forms', function (Blueprint $table) {
            $table->dropColumn('requirement_id');
            $table->dropColumn('file_path');
        });
    }
};

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
        Schema::create('application_forms', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->integer('client_id');
            $table->string('status');
            $table->string('project_title');
            $table->string('type')->comment('1-new business 2-building 3-renew');
            $table->decimal('latitude', 20, 15)->nullable();
            $table->decimal('longitude', 20, 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_forms');
    }
};

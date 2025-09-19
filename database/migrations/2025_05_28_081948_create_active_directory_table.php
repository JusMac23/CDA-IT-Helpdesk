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
        Schema::create('active_directory', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('firstname', 250);
            $table->string('middle_initial', 10);
            $table->string('lastname');
            $table->string('email', 200);
            $table->string('division_section', 100);
            $table->string('status', 50);
            $table->string('ad_username', 10)->nullable();
            $table->string('ad_password')->nullable();
            $table->dateTime('date_registered')->useCurrent();
            $table->dateTime('date_updated')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_directory');
    }
};

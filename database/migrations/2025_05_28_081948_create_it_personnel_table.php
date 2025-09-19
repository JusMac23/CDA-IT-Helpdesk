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
        Schema::create('it_personnel', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('firstname', 155);
            $table->string('middle_initial', 10)->nullable();
            $table->string('lastname', 155);
            $table->string('it_area', 100);
            $table->string('it_email', 155);
            $table->dateTime('date_added')->useCurrent();
            $table->dateTime('date_updated')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('it_personnel');
    }
};

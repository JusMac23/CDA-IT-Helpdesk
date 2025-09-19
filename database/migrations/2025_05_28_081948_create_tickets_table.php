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
            $table->integer('ticket_id', true);
            $table->string('firstname', 150);
            $table->string('lastname', 50);
            $table->string('status', 50);
            $table->dateTime('date_created')->useCurrent();
            $table->string('division', 100);
            $table->string('it_area', 50);
            $table->string('email', 50);
            $table->string('device', 50);
            $table->longText('service');
            $table->longText('request');
            $table->longText('action_taken')->nullable();
            $table->binary('photo')->nullable();
            $table->string('it_personnel', 155);
            $table->string('it_email', 50);
            $table->dateTime('date_resolved')->nullable()->useCurrent();
            $table->string('assigned_to', 100)->nullable();
            $table->string('assigned_it_email', 100)->nullable();
            $table->string('notes')->nullable();
            $table->boolean('is_read')->default(false);
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

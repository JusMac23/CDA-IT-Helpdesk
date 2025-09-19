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
        Schema::create('tickets_assignment', function (Blueprint $table) {
            $table->integer('id', true);
            $table->bigInteger('ticket_id');
            $table->string('requested_by', 100);
            $table->longText('request');
            $table->string('assigned_by', 100);
            $table->string('assigned_to', 100);
            $table->longText('notes')->nullable();
            $table->dateTime('assigned_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets_assignment');
    }
};

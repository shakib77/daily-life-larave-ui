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
        Schema::create('businessmen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key referencing users table
            $table->string('company_name'); // Company name column
            $table->decimal('daily_cost', 15, 2)->nullable(); // Daily cost column
            $table->decimal('monthly_cost', 15, 2)->nullable(); // Monthly cost column
            $table->decimal('monthly_income', 15, 2)->nullable(); // Monthly income column
            $table->unsignedInteger('employee_count')->nullable(); // Employee count column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businessmen');
    }
};

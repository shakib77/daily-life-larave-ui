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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('institute_name');
            $table->decimal('daily_cost', 15, 2)->nullable();
            $table->decimal('monthly_cost', 15, 2)->nullable();
            $table->decimal('pocket_money', 15, 2)->nullable();
            $table->decimal('monthly_edu_expenses', 15, 2)->nullable();
            $table->decimal('monthly_income', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
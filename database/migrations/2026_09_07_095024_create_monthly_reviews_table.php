<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monthly_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('household_id')->constrained('households')->cascadeOnDelete();
            $table->unsignedTinyInteger('month');
            $table->unsignedSmallInteger('year');
            $table->unsignedBigInteger('total_budget');
            $table->unsignedBigInteger('total_spending');
            $table->unsignedBigInteger('total_minus');
            $table->string('status')->default('closed');
            $table->timestamps();

            $table->unique(['household_id', 'month', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monthly_reviews');
    }
};
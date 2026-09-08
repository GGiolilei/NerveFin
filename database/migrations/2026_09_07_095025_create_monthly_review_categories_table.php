<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monthly_review_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('monthly_review_id')->constrained('monthly_reviews')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->unsignedBigInteger('budget');
            $table->unsignedBigInteger('spending');
            $table->bigInteger('difference');
            $table->boolean('overspent')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monthly_review_categories');
    }
};
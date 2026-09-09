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
    Schema::table('expenses', function (Blueprint $table) {
        // Make financial_account_id optional
        $table->foreignId('financial_account_id')->nullable()->change();
        
        // Make budget_id nullable so existing rows don't violate integrity constraints
        $table->foreignId('budget_id')
              ->nullable()
              ->after('category_id')
              ->constrained()
              ->nullOnDelete();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            //
        });
    }
};

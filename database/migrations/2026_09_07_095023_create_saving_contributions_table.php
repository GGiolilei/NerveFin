<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saving_contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saving_goal_id')->constrained('saving_goals')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('financial_account_id')->constrained('financial_accounts')->cascadeOnDelete();
            $table->unsignedBigInteger('amount');
            $table->text('note')->nullable();
            $table->timestamp('contributed_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saving_contributions');
    }
};
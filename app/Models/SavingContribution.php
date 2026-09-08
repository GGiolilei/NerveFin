<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavingContribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'saving_goal_id',
        'user_id',
        'financial_account_id',
        'amount',
        'note',
        'contributed_at',
    ];

    protected $casts = [
        'contributed_at' => 'datetime',
    ];

    public function savingGoal(): BelongsTo
    {
        return $this->belongsTo(SavingGoal::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function financialAccount(): BelongsTo
    {
        return $this->belongsTo(FinancialAccount::class);
    }

    public function getFormattedAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }
}
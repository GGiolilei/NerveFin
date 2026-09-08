<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonthlyReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'household_id',
        'month',
        'year',
        'total_budget',
        'total_spending',
        'total_minus',
        'status',
    ];

    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class);
    }

    public function reviewCategories(): HasMany
    {
        return $this->hasMany(MonthlyReviewCategory::class);
    }

    public function getFormattedTotalBudgetAttribute(): string
    {
        return 'Rp ' . number_format($this->total_budget, 0, ',', '.');
    }

    public function getFormattedTotalSpendingAttribute(): string
    {
        return 'Rp ' . number_format($this->total_spending, 0, ',', '.');
    }

    public function getFormattedTotalMinusAttribute(): string
    {
        return 'Rp ' . number_format($this->total_minus, 0, ',', '.');
    }
}
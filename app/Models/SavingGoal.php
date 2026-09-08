<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SavingGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'household_id',
        'name',
        'target_amount',
        'deadline',
        'description',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class);
    }

    public function contributions(): HasMany
    {
        return $this->hasMany(SavingContribution::class);
    }

    public function getTotalSavedAttribute(): int
    {
        return $this->contributions()->sum('amount');
    }

    public function getFormattedTargetAttribute(): string
    {
        return 'Rp ' . number_format($this->target_amount, 0, ',', '.');
    }

    public function getFormattedSavedAttribute(): string
    {
        return 'Rp ' . number_format($this->total_saved, 0, ',', '.');
    }
}
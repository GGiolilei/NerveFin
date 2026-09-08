<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyReviewCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'monthly_review_id',
        'category_id',
        'budget',
        'spending',
        'difference',
        'overspent',
    ];

    protected $casts = [
        'overspent' => 'boolean',
    ];

    public function monthlyReview(): BelongsTo
    {
        return $this->belongsTo(MonthlyReview::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getFormattedDifferenceAttribute(): string
    {
        $prefix = $this->difference < 0 ? '-Rp ' : 'Rp ';
        return $prefix . number_format(abs($this->difference), 0, ',', '.');
    }
}
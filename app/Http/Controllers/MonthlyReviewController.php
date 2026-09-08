<?php

namespace App\Http\Controllers;

use App\Models\MonthlyReview;
use Illuminate\Http\Request;

class MonthlyReviewController extends Controller
{
    public function index(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $reviews = MonthlyReview::where('household_id', $householdId)
            ->latest('year')
            ->latest('month')
            ->get();

        return view('review.index', compact('reviews'));
    }

    public function show(MonthlyReview $review)
    {
        $review->load('reviewCategories.category');
        return view('review.show', compact('review'));
    }
}
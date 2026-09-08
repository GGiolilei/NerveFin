<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $budgets = Budget::whereHas('category', function ($q) use ($householdId) {
            $q->where('household_id', $householdId);
        })->with('category')->get();

        return view('budget.index', compact('budgets'));
    }

    public function create(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $categories = Category::where('household_id', $householdId)->get();
        return view('budget.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2020',
            'amount' => 'required|numeric|min:0',
        ]);

        Budget::updateOrCreate(
            [
                'category_id' => $validated['category_id'],
                'month' => $validated['month'],
                'year' => $validated['year'],
            ],
            ['amount' => $validated['amount']]
        );

        return redirect()->route('budgets.index')->with('success', 'Budget saved!');
    }

    public function edit(Budget $budget)
    {
        return view('budget.edit', compact('budget'));
    }

    public function update(Request $request, Budget $budget)
    {
        $validated = $request->validate(['amount' => 'required|numeric|min:0']);
        $budget->update($validated);

        return redirect()->route('budgets.index')->with('success', 'Budget updated!');
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();
        return redirect()->route('budgets.index')->with('success', 'Budget deleted!');
    }
}
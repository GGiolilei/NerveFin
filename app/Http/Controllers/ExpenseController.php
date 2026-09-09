<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Budget;
use App\Models\PaymentMethod;
use App\Models\FinancialAccount;
use Illuminate\Http\Request;
use App\Models\Category;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $expenses = Expense::where('household_id', $householdId)
            ->with(['category', 'budget', 'user', 'paymentMethod'])
            ->latest('spent_at')
            ->get();

        return view('expense.index', compact('expenses'));
    }

    public function create(Request $request)
{
    $householdId = $request->user()->memberships()->firstOrFail()->household_id;
    
    // Fetch categories for the household
    $categories = Category::where('household_id', $householdId)->get();

    // Fetch active budgets for current month/year
    $budgets = Budget::whereHas('category', function ($q) use ($householdId) {
        $q->where('household_id', $householdId);
    })
    ->where('month', now()->month)
    ->where('year', now()->year)
    ->with('category')
    ->get();

    $paymentMethods = PaymentMethod::where('household_id', $householdId)->get();
    $accounts = FinancialAccount::where('household_id', $householdId)->get();

    return view('expense.create', compact('categories', 'budgets', 'paymentMethods', 'accounts'));
}

   public function store(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'budget_id' => 'required|exists:budgets,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'spent_at' => 'required|date',
            'description' => 'nullable|string',
        ]);

        // Fetch the budget to extract its associated category_id
        $budget = Budget::findOrFail($validated['budget_id']);

        Expense::create([
            'household_id' => $householdId,
            'user_id' => $request->user()->id,
            'budget_id' => $budget->id,
            'category_id' => $budget->category_id, // Automatically resolved
            'payment_method_id' => $validated['payment_method_id'],
            'name' => $validated['name'],
            'amount' => $validated['amount'],
            'spent_at' => $validated['spent_at'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense logged against budget!');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense removed!');
    }
}
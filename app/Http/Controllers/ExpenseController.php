<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use App\Models\Expense;
use App\Models\FinancialAccount;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        
        $expenses = Expense::where('household_id', $householdId)
            ->with(['category', 'budget', 'user', 'paymentMethod', 'account'])
            ->latest('spent_at')
            ->get();

        return view('expense.index', compact('expenses'));
    }

    public function create(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;

        // Fetch categories for the household
        $categories = Category::where('household_id', $householdId)->get();

        // Fetch budgets matching current month/year, or fallback to all household budgets
        $budgets = Budget::whereHas('category', function ($q) use ($householdId) {
            $q->where('household_id', $householdId);
        })
        ->where(function ($query) {
            $query->where(function ($q) {
                $q->where('month', now()->month)
                  ->where('year', now()->year);
            })->orWhereNull('month'); // Fallback if budgets don't use strict monthly constraints
        })
        ->with('category')
        ->get();

        // If strict month filter returns empty, grab all available budgets for household
        if ($budgets->isEmpty()) {
            $budgets = Budget::whereHas('category', function ($q) use ($householdId) {
                $q->where('household_id', $householdId);
            })->with('category')->get();
        }

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
            'financial_account_id' => 'nullable|exists:financial_accounts,id',
            'spent_at' => 'required|date',
            'description' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($validated, $householdId, $request) {
            // Fetch budget to resolve category
            $budget = Budget::findOrFail($validated['budget_id']);

            // Create Expense Record
            $expense = Expense::create([
                'household_id' => $householdId,
                'user_id' => $request->user()->id,
                'budget_id' => $budget->id,
                'category_id' => $budget->category_id,
                'payment_method_id' => $validated['payment_method_id'],
                'financial_account_id' => $validated['financial_account_id'] ?? null,
                'name' => $validated['name'],
                'amount' => $validated['amount'],
                'spent_at' => $validated['spent_at'],
                'description' => $validated['description'] ?? null,
            ]);

            // Deduct balance from Financial Account if selected
            if (!empty($validated['financial_account_id'])) {
                $account = FinancialAccount::where('household_id', $householdId)
                    ->findOrFail($validated['financial_account_id']);
                
                $account->decrement('balance', $validated['amount']);
            }

            return redirect()->route('expenses.index')->with('success', 'Expense logged successfully!');
        });
    }

    public function destroy(Expense $expense)
    {
        DB::transaction(function () use ($expense) {
            // Restore account balance if deleted
            if ($expense->financial_account_id && $expense->account) {
                $expense->account->increment('balance', $expense->amount);
            }

            $expense->delete();
        });

        return redirect()->route('expenses.index')->with('success', 'Expense removed and balance restored!');
    }
}
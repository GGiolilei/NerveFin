<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\FinancialAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $expenses = Expense::where('household_id', $householdId)
            ->with(['category', 'user', 'paymentMethod', 'financialAccount'])
            ->latest('spent_at')
            ->get();

        return view('expense.index', compact('expenses'));
    }

    public function create(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $categories = Category::where('household_id', $householdId)->get();
        $paymentMethods = PaymentMethod::where('household_id', $householdId)->get();
        $accounts = FinancialAccount::where('household_id', $householdId)->get();

        return view('expense.create', compact('categories', 'paymentMethods', 'accounts'));
    }

    public function store(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'category_id' => 'required|exists:categories,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'financial_account_id' => 'required|exists:financial_accounts,id',
            'spent_at' => 'required|date',
            'description' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $householdId, $request) {
            Expense::create(array_merge($validated, [
                'household_id' => $householdId,
                'user_id' => $request->user()->id,
            ]));

            // Deduct balance from associated account
            FinancialAccount::where('id', $validated['financial_account_id'])
                ->decrement('balance', $validated['amount']);
        });

        return redirect()->route('expenses.index')->with('success', 'Expense recorded!');
    }

    public function show(Expense $expense)
    {
        return view('expense.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        return view('expense.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $expense->update($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense updated!');
    }

    public function destroy(Expense $expense)
    {
        DB::transaction(function () use ($expense) {
            // Restore account balance upon deletion
            $expense->financialAccount()->increment('balance', $expense->amount);
            $expense->delete();
        });

        return redirect()->route('expenses.index')->with('success', 'Expense deleted!');
    }
}
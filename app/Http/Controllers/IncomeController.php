<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\FinancialAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $incomes = Income::where('household_id', $householdId)
            ->with(['user', 'financialAccount'])
            ->latest('received_at')
            ->get();

        return view('income.index', compact('incomes'));
    }

    public function create(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $accounts = FinancialAccount::where('household_id', $householdId)->get();

        return view('income.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'financial_account_id' => 'required|exists:financial_accounts,id',
            'received_at' => 'required|date',
            'description' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $householdId, $request) {
            Income::create(array_merge($validated, [
                'household_id' => $householdId,
                'user_id' => $request->user()->id,
            ]));

            // Add balance to selected account
            FinancialAccount::where('id', $validated['financial_account_id'])
                ->increment('balance', $validated['amount']);
        });

        return redirect()->route('incomes.index')->with('success', 'Income added!');
    }

    public function show(Income $income)
    {
        return view('income.show', compact('income'));
    }

    public function edit(Income $income)
    {
        return view('income.edit', compact('income'));
    }

    public function update(Request $request, Income $income)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $income->update($validated);

        return redirect()->route('incomes.index')->with('success', 'Income updated!');
    }

    public function destroy(Income $income)
    {
        DB::transaction(function () use ($income) {
            $income->financialAccount()->decrement('balance', $income->amount);
            $income->delete();
        });

        return redirect()->route('incomes.index')->with('success', 'Income removed!');
    }
}
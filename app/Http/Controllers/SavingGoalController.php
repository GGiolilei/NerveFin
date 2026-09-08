<?php

namespace App\Http\Controllers;

use App\Models\SavingGoal;
use App\Models\SavingContribution;
use App\Models\FinancialAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavingGoalController extends Controller
{
    public function index(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $goals = SavingGoal::where('household_id', $householdId)
            ->with('contributions.user')
            ->get();

        return view('saving.index', compact('goals'));
    }

    public function create()
    {
        return view('saving.create');
    }

    public function store(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:1',
            'deadline' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        SavingGoal::create(array_merge($validated, ['household_id' => $householdId]));

        return redirect()->route('savings.index')->with('success', 'Saving goal created!');
    }

    public function show(Request $request, SavingGoal $saving)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $accounts = FinancialAccount::where('household_id', $householdId)->get();

        return view('saving.show', ['goal' => $saving, 'accounts' => $accounts]);
    }

    public function edit(SavingGoal $saving)
    {
        return view('saving.edit', ['goal' => $saving]);
    }

    public function update(Request $request, SavingGoal $saving)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:1',
            'deadline' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $saving->update($validated);

        return redirect()->route('savings.index')->with('success', 'Saving goal updated!');
    }

    public function destroy(SavingGoal $saving)
    {
        $saving->delete();
        return redirect()->route('savings.index')->with('success', 'Goal deleted!');
    }

    public function contribute(Request $request, SavingGoal $savingGoal)
    {
        $validated = $request->validate([
            'financial_account_id' => 'required|exists:financial_accounts,id',
            'amount' => 'required|numeric|min:1',
            'note' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $savingGoal, $request) {
            SavingContribution::create([
                'saving_goal_id' => $savingGoal->id,
                'user_id' => $request->user()->id,
                'financial_account_id' => $validated['financial_account_id'],
                'amount' => $validated['amount'],
                'note' => $validated['note'] ?? null,
                'contributed_at' => now(),
            ]);

            // Deduct allocated savings from chosen bank account balance
            FinancialAccount::where('id', $validated['financial_account_id'])
                ->decrement('balance', $validated['amount']);
        });

        return redirect()->route('savings.show', $savingGoal)->with('success', 'Contribution added!');
    }
}
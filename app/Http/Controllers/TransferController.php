<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\FinancialAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function index(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $transfers = Transfer::where('household_id', $householdId)
            ->with(['user', 'fromAccount', 'toAccount'])
            ->latest('transferred_at')
            ->get();

        return view('transfer.index', compact('transfers'));
    }

    public function create(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $accounts = FinancialAccount::where('household_id', $householdId)->get();

        return view('transfer.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;

        $validated = $request->validate([
            'from_account_id' => 'required|exists:financial_accounts,id|different:to_account_id',
            'to_account_id' => 'required|exists:financial_accounts,id',
            'amount' => 'required|numeric|min:1',
            'transferred_at' => 'required|date',
            'description' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $householdId, $request) {
            Transfer::create(array_merge($validated, [
                'household_id' => $householdId,
                'user_id' => $request->user()->id,
            ]));

            // Move balance from one account to another
            FinancialAccount::where('id', $validated['from_account_id'])
                ->decrement('balance', $validated['amount']);

            FinancialAccount::where('id', $validated['to_account_id'])
                ->increment('balance', $validated['amount']);
        });

        return redirect()->route('transfers.index')->with('success', 'Transfer completed!');
    }
}
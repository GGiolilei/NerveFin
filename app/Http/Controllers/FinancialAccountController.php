<?php

namespace App\Http\Controllers;

use App\Models\FinancialAccount;
use Illuminate\Http\Request;

class FinancialAccountController extends Controller
{
    public function index(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $accounts = FinancialAccount::where('household_id', $householdId)->get();
        return view('account.index', compact('accounts'));
    }

    public function create()
    {
        return view('account.create');
    }

    public function store(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'balance' => 'required|numeric',
        ]);

        FinancialAccount::create(array_merge($validated, ['household_id' => $householdId]));

        return redirect()->route('accounts.index')->with('success', 'Account added!');
    }

    public function show(FinancialAccount $account)
    {
        return view('account.show', compact('account'));
    }

    public function edit(FinancialAccount $account)
    {
        return view('account.edit', compact('account'));
    }

    public function update(Request $request, FinancialAccount $account)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'balance' => 'required|numeric',
        ]);

        $account->update($validated);

        return redirect()->route('accounts.index')->with('success', 'Account updated!');
    }

    public function destroy(FinancialAccount $account)
    {
        $account->delete();
        return redirect()->route('accounts.index')->with('success', 'Account removed!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\FinancialAccount;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $membership = $user->memberships()->first();

        if (!$membership) {
            return redirect()->route('household.create');
        }

        $household = $membership->household;
        $accounts = FinancialAccount::where('household_id', $household->id)->get();
        $recentExpenses = Expense::where('household_id', $household->id)
            ->with(['category', 'user', 'financialAccount'])
            ->latest('spent_at')
            ->take(5)
            ->get();

        return view('dashboard.index', compact('household', 'accounts', 'recentExpenses'));
    }
}
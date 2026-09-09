<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Expense;
use App\Models\FinancialAccount;
use App\Models\Income;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;

        $currentMonth = now()->month;
        $currentYear = now()->year;

        // 1. Fetch Household Accounts
        $accounts = FinancialAccount::where('household_id', $householdId)->get();

        // 2. Totals Calculation
        $totalIncome = Income::where('household_id', $householdId)
            ->whereMonth('received_at', $currentMonth)
            ->whereYear('received_at', $currentYear)
            ->sum('amount');

        $totalExpenses = Expense::where('household_id', $householdId)
            ->whereMonth('spent_at', $currentMonth)
            ->whereYear('spent_at', $currentYear)
            ->sum('amount');

        $totalBudgeted = Budget::whereHas('category', function ($q) use ($householdId) {
            $q->where('household_id', $householdId);
        })
        ->where('month', $currentMonth)
        ->where('year', $currentYear)
        ->sum('amount');

        // Dynamic metrics
        $remainingBudgetPool = $totalBudgeted - $totalExpenses;
        $netSavings = $totalIncome - $totalExpenses;

        // 3. Active Budgets with Month-Constrained Expenses Sum
        $budgets = Budget::whereHas('category', function ($q) use ($householdId) {
            $q->where('household_id', $householdId);
        })
        ->where('month', $currentMonth)
        ->where('year', $currentYear)
        ->with('category')
        ->withSum(['expenses' => function ($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('spent_at', $currentMonth)
                  ->whereYear('spent_at', $currentYear);
        }], 'amount')
        ->get();

        // 4. Recent Expenses with Eager-Loaded Relations
        $recentExpenses = Expense::where('household_id', $householdId)
            ->with([
                'category',
                'budget.category',
                'user',
                'financialAccount',
                'paymentMethod'
            ])
            ->latest('spent_at')
            ->take(10)
            ->get();

        return view('dashboard.index', compact(
            'accounts',
            'totalIncome',
            'totalExpenses',
            'totalBudgeted',
            'remainingBudgetPool',
            'netSavings',
            'budgets',
            'recentExpenses'
        ));
    }
}
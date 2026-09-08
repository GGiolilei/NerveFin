<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\FinancialAccountController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\SavingGoalController;
use App\Http\Controllers\MonthlyReviewController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Redirect root to login or dashboard
Route::get('/', function () {
    return redirect()->route('login');
});

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Household & Members Management ("Lobby")
    Route::prefix('household')->name('household.')->group(function () {
        Route::get('/', [HouseholdController::class, 'index'])->name('index');
        Route::get('/create', [HouseholdController::class, 'create'])->name('create');
        Route::post('/', [HouseholdController::class, 'store'])->name('store');
        Route::get('/edit', [HouseholdController::class, 'edit'])->name('edit');
        Route::put('/', [HouseholdController::class, 'update'])->name('update');
        Route::get('/members', [HouseholdController::class, 'members'])->name('members');
        Route::get('/invite', [HouseholdController::class, 'invite'])->name('invite');
        Route::post('/join', [HouseholdController::class, 'join'])->name('join');
    });

    // 3. Categories
    Route::resource('categories', CategoryController::class)->except(['show']);

    // 4. Budgets
    Route::resource('budgets', BudgetController::class)->except(['show']);

    // 5. Payment Methods
    Route::resource('payment-methods', PaymentMethodController::class)->except(['show']);

    // 6. Financial Accounts
    Route::resource('accounts', FinancialAccountController::class);

    // 7. Expenses
    Route::resource('expenses', ExpenseController::class);

    // 8. Incomes
    Route::resource('incomes', IncomeController::class);

    // 9. Account Transfers
    Route::prefix('transfers')->name('transfers.')->group(function () {
        Route::get('/', [TransferController::class, 'index'])->name('index');
        Route::get('/create', [TransferController::class, 'create'])->name('create');
        Route::post('/', [TransferController::class, 'store'])->name('store');
    });

    // 10. Savings & Contributions
    Route::resource('savings', SavingGoalController::class);
    Route::post('/savings/{savingGoal}/contribute', [SavingGoalController::class, 'contribute'])->name('savings.contribute');

    // 11. Monthly Reviews (Carbon automated totals & overspend tracking)
    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::get('/', [MonthlyReviewController::class, 'index'])->name('index');
        Route::get('/{review}', [MonthlyReviewController::class, 'show'])->name('show');
    });

    // 12. User Profile (Breeze Native)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Require standard Laravel Breeze auth routes
require __DIR__.'/auth.php';
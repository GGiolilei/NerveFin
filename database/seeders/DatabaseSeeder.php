<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Household;
use App\Models\HouseholdMember;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\FinancialAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Default Users
        $gio = User::factory()->create([
            'name' => 'Giovani',
            'email' => 'gio@example.com',
            'password' => bcrypt('password'),
        ]);

        $bryan = User::factory()->create([
            'name' => 'Bryan',
            'email' => 'bryan@example.com',
            'password' => bcrypt('password'),
        ]);

        // 2. Create Household
        $household = Household::create([
            'name' => 'Gio & Bryan',
            'owner_id' => $gio->id,
            'invite_code' => 'HOUSE123',
        ]);

        // 3. Add Members
        HouseholdMember::create([
            'household_id' => $household->id,
            'user_id' => $gio->id,
            'role' => 'owner',
        ]);

        HouseholdMember::create([
            'household_id' => $household->id,
            'user_id' => $bryan->id,
            'role' => 'member',
        ]);

        // 4. Default Categories
        $categories = ['Food', 'Transportation', 'Entertainment', 'Shopping', 'Utilities', 'Baby', 'Pets', 'Subscriptions'];
        foreach ($categories as $cat) {
            Category::create([
                'household_id' => $household->id,
                'name' => $cat,
            ]);
        }

        // 5. Default Payment Methods
        $methods = ['Cash', 'Debit Card', 'Credit Card', 'QRIS', 'Bank Transfer', 'E-Wallet'];
        foreach ($methods as $method) {
            PaymentMethod::create([
                'household_id' => $household->id,
                'name' => $method,
            ]);
        }

        // 6. Default Financial Accounts
        FinancialAccount::create(['household_id' => $household->id, 'name' => 'BCA', 'type' => 'bank', 'balance' => 8000000]);
        FinancialAccount::create(['household_id' => $household->id, 'name' => 'Mandiri', 'type' => 'bank', 'balance' => 4000000]);
        FinancialAccount::create(['household_id' => $household->id, 'name' => 'GoPay', 'type' => 'ewallet', 'balance' => 500000]);
        FinancialAccount::create(['household_id' => $household->id, 'name' => 'Cash', 'type' => 'cash', 'balance' => 300000]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $methods = PaymentMethod::where('household_id', $householdId)->get();
        return view('payment-method.index', compact('methods'));
    }

    public function create()
    {
        return view('payment-method.create');
    }

    public function store(Request $request)
    {
        $householdId = $request->user()->memberships()->firstOrFail()->household_id;
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string',
        ]);

        PaymentMethod::create(array_merge($validated, ['household_id' => $householdId]));

        return redirect()->route('payment-methods.index')->with('success', 'Payment method added!');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('payment-method.edit', ['method' => $paymentMethod]);
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string',
        ]);

        $paymentMethod->update($validated);

        return redirect()->route('payment-methods.index')->with('success', 'Payment method updated!');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        return redirect()->route('payment-methods.index')->with('success', 'Payment method removed!');
    }
}
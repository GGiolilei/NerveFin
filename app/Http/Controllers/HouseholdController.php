<?php

namespace App\Http\Controllers;

use App\Models\Household;
use App\Models\HouseholdMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HouseholdController extends Controller
{
    public function index(Request $request)
    {
        $membership = $request->user()->memberships()->with('household.members.user')->first();
        return view('household.index', ['household' => $membership?->household]);
    }

    public function create()
    {
        return view('household.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $household = Household::create([
            'name' => $validated['name'],
            'owner_id' => $request->user()->id,
            'invite_code' => strtoupper(Str::random(6)),
        ]);

        HouseholdMember::create([
            'household_id' => $household->id,
            'user_id' => $request->user()->id,
            'role' => 'owner',
            'joined_at' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Household created!');
    }

    public function edit(Request $request)
    {
        $household = $request->user()->memberships()->firstOrFail()->household;
        return view('household.edit', compact('household'));
    }

    public function update(Request $request)
    {
        $household = $request->user()->memberships()->firstOrFail()->household;
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $household->update($validated);

        return redirect()->route('household.index')->with('success', 'Household updated.');
    }

    public function members(Request $request)
    {
        $household = $request->user()->memberships()->firstOrFail()->household;
        $members = $household->members()->with('user')->get();
        return view('household.members', compact('household', 'members'));
    }

    public function invite(Request $request)
    {
        $household = $request->user()->memberships()->firstOrFail()->household;
        return view('household.invite', compact('household'));
    }

    public function join(Request $request)
    {
        $validated = $request->validate(['invite_code' => 'required|string']);
        $household = Household::where('invite_code', $validated['invite_code'])->firstOrFail();

        HouseholdMember::firstOrCreate([
            'household_id' => $household->id,
            'user_id' => $request->user()->id,
        ], [
            'role' => 'member',
            'joined_at' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Joined household successfully!');
    }
}
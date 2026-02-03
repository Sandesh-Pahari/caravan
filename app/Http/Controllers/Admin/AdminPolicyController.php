<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePolicyRequest;
use App\Models\Policy;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminPolicyController extends Controller
{
    public function index(): View
    {
        $policies = Policy::query()->orderBy('sort_order')->orderByDesc('created_at')->get();

        return view('admin.policies.index', compact('policies'));
    }

    public function create(): View
    {
        return view('admin.policies.create');
    }

    public function store(StorePolicyRequest $request): RedirectResponse
    {
        Policy::query()->create([
            'title' => $request->title,
            'icon' => $request->icon,
            'color' => $request->color,
            'items' => $this->parseItems($request->items),
            'sort_order' => $request->integer('sort_order', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.policies.index')->with('success', 'Policy created successfully.');
    }

    public function edit(Policy $policy): View
    {
        return view('admin.policies.edit', compact('policy'));
    }

    public function update(StorePolicyRequest $request, Policy $policy): RedirectResponse
    {
        $policy->update([
            'title' => $request->title,
            'icon' => $request->icon,
            'color' => $request->color,
            'items' => $this->parseItems($request->items),
            'sort_order' => $request->integer('sort_order', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.policies.index')->with('success', 'Policy updated successfully.');
    }

    public function destroy(Policy $policy): RedirectResponse
    {
        $policy->delete();

        return redirect()->route('admin.policies.index')->with('success', 'Policy deleted.');
    }

    /** Convert newline-separated text into a clean array of strings. */
    private function parseItems(string $raw): array
    {
        return array_values(
            array_filter(
                array_map('trim', explode("\n", $raw))
            )
        );
    }
}

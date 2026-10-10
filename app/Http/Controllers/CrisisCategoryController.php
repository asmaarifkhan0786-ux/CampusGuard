<?php

namespace App\Http\Controllers;

use App\Models\CrisisCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CrisisCategoryController extends Controller
{
    public function index()
    {
        $categories = CrisisCategory::latest()->paginate(10);

        return view('crisis-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('crisis-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:crisis_categories,name'],
            'description' => ['nullable', 'string', 'max:2000'],
            'severity' => ['required', Rule::in(['low', 'medium', 'high', 'critical'])],
        ]);

        CrisisCategory::create($data);

        return redirect()->route('crisis-categories.index')
            ->with('success', 'Crisis category created successfully.');
    }

    public function show(CrisisCategory $crisisCategory)
    {
        $crisisCategory->load('reports');

        return view('crisis-categories.show', compact('crisisCategory'));
    }

    public function edit(CrisisCategory $crisisCategory)
    {
        return view('crisis-categories.edit', compact('crisisCategory'));
    }

    public function update(Request $request, CrisisCategory $crisisCategory)
    {
        $data = $request->validate([
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('crisis_categories', 'name')
                    ->ignore($crisisCategory->id),
            ],
            'description' => ['nullable', 'string', 'max:2000'],
            'severity' => ['required', Rule::in(['low', 'medium', 'high', 'critical'])],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $crisisCategory->update($data);

        return redirect()->route('crisis-categories.index')
            ->with('success', 'Crisis category updated successfully.');
    }

    public function destroy(CrisisCategory $crisisCategory)
    {
        if ($crisisCategory->reports()->exists()) {
            return back()->with(
                'error',
                'This category has reports. Deactivate it instead of deleting it.'
            );
        }

        $crisisCategory->delete();

        return redirect()->route('crisis-categories.index')
            ->with('success', 'Crisis category deleted successfully.');
    }
}

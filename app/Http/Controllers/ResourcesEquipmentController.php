<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class ResourcesEquipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Equipment::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $equipment = $query->latest()->get();

        return view('modules.resources-equipment', compact('equipment'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'condition' => 'required|in:Good,Needs Repair,Damaged',
            'status' => 'required|in:Available,In Use,Maintenance',
            'description' => 'nullable|string|max:5000',
        ]);

        Equipment::create($validated);

        return redirect()
            ->route('resources-equipment.index')
            ->with('success', 'Equipment saved successfully!');
    }
}
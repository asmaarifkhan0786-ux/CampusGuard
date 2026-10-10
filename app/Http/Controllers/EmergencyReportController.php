<?php

namespace App\Http\Controllers;

use App\Models\EmergencyReport;
use App\Models\CrisisCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EmergencyReportController extends Controller
{
    public function index()
    {
        $reports = EmergencyReport::with(['user', 'category'])
            ->latest()
            ->paginate(10);

        return view('emergency-reports.index', compact('reports'));
    }

    public function create()
    {
        $categories = CrisisCategory::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('emergency-reports.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'crisis_category_id' => [
                'nullable',
                'integer',
                Rule::exists('crisis_categories', 'id')
                    ->where('is_active', true),
            ],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'location' => ['required', 'string', 'max:255'],
            'priority' => [
                'required',
                Rule::in(['low', 'medium', 'high', 'critical']),
            ],
            'contact_number' => ['nullable', 'string', 'max:30'],
        ]);

        if (! Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please log in before submitting a report.');
        }

        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        EmergencyReport::create($data);

        return redirect()->route('emergency-reports.index')
            ->with('success', 'Emergency report submitted successfully.');
    }

    public function show(EmergencyReport $emergencyReport)
    {
        $emergencyReport->load(['user', 'category', 'assignments.team']);

        return view('emergency-reports.show', compact('emergencyReport'));
    }

    public function edit(EmergencyReport $emergencyReport)
    {
        $categories = CrisisCategory::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('emergency-reports.edit', compact(
            'emergencyReport',
            'categories'
        ));
    }

    public function update(Request $request, EmergencyReport $emergencyReport)
    {
        $data = $request->validate([
            'crisis_category_id' => [
                'nullable',
                'integer',
                Rule::exists('crisis_categories', 'id')
                    ->where('is_active', true),
            ],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'location' => ['required', 'string', 'max:255'],
            'priority' => [
                'required',
                Rule::in(['low', 'medium', 'high', 'critical']),
            ],
            'status' => [
                'required',
                Rule::in([
                    'pending', 'under_review', 'assigned',
                    'in_progress', 'resolved', 'rejected',
                ]),
            ],
            'contact_number' => ['nullable', 'string', 'max:30'],
        ]);

        $data['resolved_at'] = $data['status'] === 'resolved'
            ? ($emergencyReport->resolved_at ?? now())
            : null;

        $emergencyReport->update($data);

        return redirect()->route('emergency-reports.index')
            ->with('success', 'Emergency report updated successfully.');
    }

    public function destroy(EmergencyReport $emergencyReport)
    {
        $emergencyReport->delete();

        return redirect()->route('emergency-reports.index')
            ->with('success', 'Emergency report deleted successfully.');
    }
}

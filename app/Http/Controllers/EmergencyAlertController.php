<?php

namespace App\Http\Controllers;

use App\Models\EmergencyAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EmergencyAlertController extends Controller
{
    public function index()
    {
        $alerts = EmergencyAlert::latest()->paginate(10);

        return view('emergency-alerts.index', compact('alerts'));
    }

    public function create()
    {
        return view('emergency-alerts.create');
    }

    public function store(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please log in before creating an alert.');
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'severity' => [
                'required',
                Rule::in(['info', 'warning', 'urgent', 'critical']),
            ],
            'location' => ['nullable', 'string', 'max:255'],
            'starts_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after:starts_at'],
        ]);

        $data['user_id'] = Auth::id();

        EmergencyAlert::create($data);

        return redirect()->route('emergency-alerts.index')
            ->with('success', 'Emergency alert created successfully.');
    }

    public function show(EmergencyAlert $emergencyAlert)
    {
        return view('emergency-alerts.show', compact('emergencyAlert'));
    }

    public function edit(EmergencyAlert $emergencyAlert)
    {
        return view('emergency-alerts.edit', compact('emergencyAlert'));
    }

    public function update(Request $request, EmergencyAlert $emergencyAlert)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'severity' => [
                'required',
                Rule::in(['info', 'warning', 'urgent', 'critical']),
            ],
            'location' => ['nullable', 'string', 'max:255'],
            'starts_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after:starts_at'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $emergencyAlert->update($data);

        return redirect()->route('emergency-alerts.index')
            ->with('success', 'Emergency alert updated successfully.');
    }

    public function destroy(EmergencyAlert $emergencyAlert)
    {
        $emergencyAlert->delete();

        return redirect()->route('emergency-alerts.index')
            ->with('success', 'Emergency alert deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\IncidentAssignment;
use App\Models\EmergencyReport;
use App\Models\ResponseTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class IncidentAssignmentController extends Controller
{
    public function index()
    {
        $assignments = IncidentAssignment::with([
            'report', 'team', 'assignedBy'
        ])->latest()->paginate(10);

        return view('incident-assignments.index', compact('assignments'));
    }

    public function create()
    {
        $reports = EmergencyReport::whereNotIn('status', [
            'resolved', 'rejected'
        ])->get();

        $teams = ResponseTeam::where('is_active', true)
            ->where('availability', 'available')
            ->get();

        return view('incident-assignments.create', compact('reports', 'teams'));
    }

    public function store(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please log in before assigning an incident.');
        }

        $data = $request->validate([
            'emergency_report_id' => [
                'required', 'integer', 'exists:emergency_reports,id'
            ],
            'response_team_id' => [
                'required', 'integer', 'exists:response_teams,id'
            ],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $team = ResponseTeam::findOrFail($data['response_team_id']);

        if (! $team->is_active || $team->availability !== 'available') {
            return back()->withInput()->withErrors([
                'response_team_id' => 'Please select an active, available team.',
            ]);
        }

        $report = EmergencyReport::findOrFail($data['emergency_report_id']);

        if (in_array($report->status, ['resolved', 'rejected'], true)) {
            return back()->withInput()->withErrors([
                'emergency_report_id' => 'This report is already closed.',
            ]);
        }

        $data['assigned_by'] = Auth::id();

        IncidentAssignment::create($data);

        $report->update(['status' => 'assigned']);
        $team->update(['availability' => 'busy']);

        return redirect()->route('incident-assignments.index')
            ->with('success', 'Response team assigned successfully.');
    }

    public function show(IncidentAssignment $incidentAssignment)
    {
        $incidentAssignment->load(['report', 'team', 'assignedBy']);

        return view('incident-assignments.show', compact('incidentAssignment'));
    }

    public function edit(IncidentAssignment $incidentAssignment)
    {
        $reports = EmergencyReport::all();
        $teams = ResponseTeam::where('is_active', true)->get();

        return view('incident-assignments.edit', compact(
            'incidentAssignment', 'reports', 'teams'
        ));
    }

    public function update(Request $request, IncidentAssignment $incidentAssignment)
    {
        $data = $request->validate([
            'status' => [
                'required',
                Rule::in(['assigned', 'accepted', 'in_progress', 'completed']),
            ],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $incidentAssignment->update($data);

        $report = $incidentAssignment->report;
        $team = $incidentAssignment->team;

        if ($data['status'] === 'completed') {
            $incidentAssignment->update(['completed_at' => now()]);
            $report->update([
                'status' => 'resolved',
                'resolved_at' => now(),
            ]);

            $team->update(['availability' => 'available']);
        } elseif ($data['status'] === 'in_progress') {
            $report->update(['status' => 'in_progress']);
        }

        return redirect()->route('incident-assignments.index')
            ->with('success', 'Assignment updated successfully.');
    }

    public function destroy(IncidentAssignment $incidentAssignment)
    {
        $incidentAssignment->delete();

        return redirect()->route('incident-assignments.index')
            ->with('success', 'Assignment deleted successfully.');
    }
}

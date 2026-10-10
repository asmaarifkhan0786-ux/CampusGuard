<?php

namespace App\Http\Controllers;

use App\Models\ResponseTeam;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResponseTeamController extends Controller
{
    public function index()
    {
        $teams = ResponseTeam::latest()->paginate(10);

        return view('response-teams.index', compact('teams'));
    }

    public function create()
    {
        return view('response-teams.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'team_type' => [
                'required',
                Rule::in(['medical', 'security', 'fire', 'rescue', 'other']),
            ],
            'leader_name' => ['nullable', 'string', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'availability' => [
                'required',
                Rule::in(['available', 'busy', 'unavailable']),
            ],
        ]);

        ResponseTeam::create($data);

        return redirect()->route('response-teams.index')
            ->with('success', 'Response team created successfully.');
    }

    public function show(ResponseTeam $responseTeam)
    {
        $responseTeam->load('assignments.report');

        return view('response-teams.show', compact('responseTeam'));
    }

    public function edit(ResponseTeam $responseTeam)
    {
        return view('response-teams.edit', compact('responseTeam'));
    }

    public function update(Request $request, ResponseTeam $responseTeam)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'team_type' => [
                'required',
                Rule::in(['medical', 'security', 'fire', 'rescue', 'other']),
            ],
            'leader_name' => ['nullable', 'string', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'availability' => [
                'required',
                Rule::in(['available', 'busy', 'unavailable']),
            ],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $responseTeam->update($data);

        return redirect()->route('response-teams.index')
            ->with('success', 'Response team updated successfully.');
    }

    public function destroy(ResponseTeam $responseTeam)
    {
        if ($responseTeam->assignments()->exists()) {
            return back()->with(
                'error',
                'This team has assignments. Deactivate it instead of deleting it.'
            );
        }

        $responseTeam->delete();

        return redirect()->route('response-teams.index')
            ->with('success', 'Response team deleted successfully.');
    }
}

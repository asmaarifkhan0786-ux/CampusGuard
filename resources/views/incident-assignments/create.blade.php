@extends('layouts.app')

@section('title', 'Assign Response Team')
@section('heading', 'Assign Response Team')

@section('content')

<div class="page-heading">
    <div>
        <h1>Assign Response Team</h1>
        <p class="muted">
            Select an active emergency and assign an available campus response team.
        </p>
    </div>

    <a href="{{ route('incident-assignments.index') }}" class="btn btn-secondary">
        ← Back to Assignments
    </a>
</div>

<div class="card" style="max-width:900px;">

    @if($reports->isEmpty())
        <div style="background:#fef3c7;color:#92400e;padding:15px;border-radius:8px;margin-bottom:20px;">
            <strong>No active emergency reports available.</strong>
            <p style="margin-top:6px;font-size:13px;">
                Pehle Emergency Reports section mein emergency report create karein.
            </p>

            <a href="{{ route('emergency-reports.create') }}"
               class="btn btn-primary"
               style="margin-top:12px;">
                + Create Emergency Report
            </a>
        </div>
    @endif

    @if($teams->isEmpty())
        <div style="background:#fef3c7;color:#92400e;padding:15px;border-radius:8px;margin-bottom:20px;">
            <strong>No available response teams.</strong>
            <p style="margin-top:6px;font-size:13px;">
                Pehle Response Teams mein team add karein aur uski availability Available rakhein.
            </p>

            <a href="{{ route('response-teams.create') }}"
               class="btn btn-primary"
               style="margin-top:12px;">
                + Add Response Team
            </a>
        </div>
    @endif

    <form action="{{ route('incident-assignments.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="emergency_report_id">Emergency Report *</label>

            <select id="emergency_report_id" name="emergency_report_id" required>
                <option value="">Select an emergency report</option>

                @foreach($reports as $report)
                    <option
                        value="{{ $report->id }}"
                        {{ old('emergency_report_id') == $report->id ? 'selected' : '' }}
                    >
                        #{{ $report->id }} —
                        {{ $report->title }} —
                        {{ $report->location }} —
                        {{ ucfirst($report->priority) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="response_team_id">Response Team *</label>

            <select id="response_team_id" name="response_team_id" required>
                <option value="">Select an available team</option>

                @foreach($teams as $team)
                    <option
                        value="{{ $team->id }}"
                        {{ old('response_team_id') == $team->id ? 'selected' : '' }}
                    >
                        {{ $team->name }} — {{ ucfirst($team->team_type) }}
                        @if($team->leader_name)
                            — Leader: {{ $team->leader_name }}
                        @endif
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="notes">Assignment Instructions / Notes</label>

            <textarea
                id="notes"
                name="notes"
                maxlength="2000"
                placeholder="Enter response instructions, meeting point or other relevant details..."
            >{{ old('notes') }}</textarea>
        </div>

        <div style="background:#f8fafc;padding:15px;border-radius:8px;margin-bottom:22px;">
            <strong style="font-size:13px;">Before Assigning</strong>
            <p class="muted" style="margin-top:7px;">
                Verify the incident location and select the appropriate team.
                For a real emergency, contact campus security or emergency services directly.
            </p>
        </div>

        <button
            type="submit"
            class="btn btn-primary"
            {{ $reports->isEmpty() || $teams->isEmpty() ? 'disabled style=opacity:0.5;cursor:not-allowed;' : '' }}
        >
            Assign Response Team
        </button>

        <a href="{{ route('incident-assignments.index') }}"
           class="btn btn-secondary"
           style="margin-left:8px;">
            Cancel
        </a>

    </form>
</div>

@endsection
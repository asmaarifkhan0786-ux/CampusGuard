@extends('layouts.app')

@section('title', 'Assign Response Team')
@section('heading', 'Assign Response Team')

@section('content')

<style>
    .assignment-page {
        max-width: 1000px;
        margin: 0 auto;
    }

    .assignment-page .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .assignment-page .page-heading h1 {
        margin: 0 0 8px;
        font-size: 26px;
        font-weight: 700;
        color: #10233f;
    }

    .assignment-page .muted {
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }

    .assignment-page .assignment-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 28px;
        box-shadow: 0 5px 20px rgba(15, 23, 42, 0.05);
    }

    .assignment-page .form-group {
        margin-bottom: 22px;
    }

    .assignment-page .form-group label {
        display: block;
        margin-bottom: 9px;
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
    }

    .assignment-page .form-group select,
    .assignment-page .form-group textarea {
        display: block;
        width: 100%;
        box-sizing: border-box;
        padding: 12px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        background: #fff;
        color: #0f172a;
        font-size: 14px;
        outline: none;
    }

    .assignment-page .form-group select:focus,
    .assignment-page .form-group textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .assignment-page .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .assignment-page .notice {
        padding: 16px;
        border-radius: 9px;
        margin-bottom: 20px;
        font-size: 14px;
        line-height: 1.6;
    }

    .assignment-page .notice-warning {
        background: #fffbeb;
        color: #92400e;
        border: 1px solid #fde68a;
    }

    .assignment-page .notice-info {
        background: #eff6ff;
        color: #1e40af;
        border: 1px solid #bfdbfe;
    }

    .assignment-page .notice p {
        margin: 6px 0 0;
    }

    .assignment-page .required {
        color: #dc2626;
    }

    .assignment-page .form-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
        margin-top: 24px;
    }

    .assignment-page .btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    @media (max-width: 600px) {
        .assignment-page .assignment-card {
            padding: 18px;
        }

        .assignment-page .page-heading h1 {
            font-size: 22px;
        }
    }
</style>

<div class="assignment-page">

    <div class="page-heading">
        <div>
            <h1>Assign Response Team</h1>
            <p class="muted">
                Select an emergency report and assign an available campus response team.
            </p>
        </div>

        <a href="{{ route('incident-assignments.index') }}"
           class="btn btn-secondary">
            &larr; Back to Assignments
        </a>
    </div>

    <div class="assignment-card">

        @if(session('success'))
            <div class="notice notice-info">
                <strong>Success!</strong>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="notice notice-warning">
                <strong>Please correct the following errors:</strong>
                <ul style="margin:8px 0 0 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($reports->isEmpty())
            <div class="notice notice-warning">
                <strong>No emergency reports available.</strong>
                <p>
                    Pehle Emergency Reports section mein emergency report create karein.
                </p>

                <a href="{{ route('emergency-reports.create') }}"
                   class="btn btn-primary"
                   style="display:inline-block; margin-top:12px;">
                    + Create Emergency Report
                </a>
            </div>
        @endif

        @if($teams->isEmpty())
            <div class="notice notice-warning">
                <strong>No response teams available.</strong>
                <p>
                    Pehle Response Teams section mein team add karein aur
                    uski availability check karein.
                </p>

                <a href="{{ route('response-teams.create') }}"
                   class="btn btn-primary"
                   style="display:inline-block; margin-top:12px;">
                    + Add Response Team
                </a>
            </div>
        @endif

        <form action="{{ route('incident-assignments.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="emergency_report_id">
                    Emergency Report <span class="required">*</span>
                </label>

                <select
                    id="emergency_report_id"
                    name="emergency_report_id"
                    required
                    {{ $reports->isEmpty() ? 'disabled' : '' }}
                >
                    <option value="">Select an emergency report</option>

                    @foreach($reports as $report)
                        <option
                            value="{{ $report->id }}"
                            {{ old('emergency_report_id') == $report->id ? 'selected' : '' }}
                        >
                            #{{ $report->id }} —
                            {{ $report->title }} —
                            {{ $report->location }} —
                            {{ ucfirst($report->priority ?? 'normal') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="response_team_id">
                    Response Team <span class="required">*</span>
                </label>

                <select
                    id="response_team_id"
                    name="response_team_id"
                    required
                    {{ $teams->isEmpty() ? 'disabled' : '' }}
                >
                    <option value="">Select an available team</option>

                    @foreach($teams as $team)
                        <option
                            value="{{ $team->id }}"
                            {{ old('response_team_id') == $team->id ? 'selected' : '' }}
                        >
                            {{ $team->name }} —
                            {{ ucfirst($team->team_type ?? 'response team') }}
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

            <div class="notice notice-info">
                <strong>Before Assigning</strong>
                <p>
                    Verify the incident location and choose the appropriate response team.
                    For a real emergency, contact campus security or emergency services directly.
                </p>
            </div>

            <div class="form-actions">
                <button
                    type="submit"
                    class="btn btn-primary"
                    {{ $reports->isEmpty() || $teams->isEmpty() ? 'disabled' : '' }}
                >
                    Assign Response Team
                </button>

                <a href="{{ route('incident-assignments.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>

    </div>
</div>

@endsection
@extends('layouts.app')

@section('title', 'Incident Assignments')
@section('heading', 'Incident Assignments')

@section('content')

<div class="page-heading">
    <div>
        <h1>Incident Assignments</h1>
        <p class="muted">
            Monitor emergency reports assigned to campus response teams.
        </p>
    </div>

    <a href="{{ route('incident-assignments.create') }}" class="btn btn-primary">
        + Assign Response Team
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Emergency Report</th>
                    <th>Response Team</th>
                    <th>Assigned By</th>
                    <th>Assignment Date</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($assignments as $assignment)
                    <tr>
                        <td>#{{ $assignment->id }}</td>

                        <td>
                            <strong>
                                {{ $assignment->report->title ?? 'Report unavailable' }}
                            </strong>

                            @if($assignment->report)
                                <p class="muted" style="margin-top:5px;">
                                    {{ $assignment->report->location }}
                                </p>
                            @endif
                        </td>

                        <td>
                            <strong>
                                {{ $assignment->team->name ?? 'Team unavailable' }}
                            </strong>

                            @if($assignment->team)
                                <p class="muted" style="margin-top:5px;">
                                    {{ ucfirst($assignment->team->team_type) }}
                                </p>
                            @endif
                        </td>

                        <td>{{ $assignment->assignedBy->name ?? 'Unknown' }}</td>

                        <td>
                            {{ $assignment->assigned_at
                                ? $assignment->assigned_at->format('d M Y, h:i A')
                                : $assignment->created_at->format('d M Y') }}
                        </td>

                        <td>
                            <span class="badge {{ $assignment->status }}">
                                {{ str_replace('_', ' ', $assignment->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty">
                                <h3>No Assignments Yet</h3>

                                <p>
                                    Emergency response team assignments will appear here.
                                </p>

                                <div style="margin-top:18px;">
                                    <a
                                        href="{{ route('incident-assignments.create') }}"
                                        class="btn btn-primary"
                                    >
                                        + Create First Assignment
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        {{ $assignments->links() }}
    </div>
</div>

@endsection
@extends('layouts.app')

@section('title', 'Incident Assignments')
@section('heading', 'Incident Assignments')

@section('content')

<style>
    .assignments-page {
        width: 100%;
        max-width: 1600px;
        margin: 0 auto;
        color: #0f172a;
    }

    .assignments-page * {
        box-sizing: border-box;
    }

    .assignments-page .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 30px;
    }

    .assignments-page .page-header h1 {
        margin: 0 0 10px;
        color: #10233f;
        font-size: 32px;
        font-weight: 750;
        line-height: 1.4;
    }

    .assignments-page .page-header p {
        margin: 0;
        color: #64748b;
        font-size: 16px;
        line-height: 1.8;
        max-width: 700px;
    }

    .assignments-page .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 14px 20px;
        min-height: 48px;
        border: 1px solid transparent;
        border-radius: 9px;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .assignments-page .btn-primary {
        color: #fff;
        background: #123a70;
    }

    .assignments-page .btn-primary:hover {
        background: #0b2850;
    }

    .assignments-page .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
        margin-bottom: 30px;
    }

    .assignments-page .stat-card {
        position: relative;
        overflow: hidden;
        padding: 25px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 5px 18px rgba(15, 23, 42, 0.04);
    }

    .assignments-page .stat-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 5px;
        height: 100%;
        background: #2563eb;
    }

    .assignments-page .stat-card.pending::before {
        background: #d97706;
    }

    .assignments-page .stat-card.completed::before {
        background: #16a34a;
    }

    .assignments-page .stat-label {
        margin-bottom: 12px;
        color: #64748b;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.6;
    }

    .assignments-page .stat-number {
        color: #10233f;
        font-size: 34px;
        font-weight: 800;
        line-height: 1.3;
    }

    .assignments-page .stat-description {
        margin-top: 8px;
        color: #94a3b8;
        font-size: 13px;
        line-height: 1.7;
    }

    .assignments-page .assignments-card {
        overflow: hidden;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 5px 20px rgba(15, 23, 42, 0.04);
    }

    .assignments-page .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        padding: 25px;
        border-bottom: 1px solid #e2e8f0;
    }

    .assignments-page .card-header h2 {
        margin: 0;
        color: #10233f;
        font-size: 22px;
        font-weight: 750;
        line-height: 1.5;
    }

    .assignments-page .card-header p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.8;
    }

    .assignments-page .count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 15px;
        color: #1d4ed8;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 750;
        white-space: nowrap;
    }

    .assignments-page .table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .assignments-page table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
        text-align: left;
    }

    .assignments-page thead th {
        padding: 19px 20px;
        color: #334155;
        background: #f1f5f9;
        border-bottom: 1px solid #e2e8f0;
        font-size: 14px;
        font-weight: 750;
        white-space: nowrap;
    }

    .assignments-page tbody td {
        padding: 22px 20px;
        color: #334155;
        border-bottom: 1px solid #e9eef5;
        font-size: 15px;
        line-height: 1.8;
        vertical-align: top;
    }

    .assignments-page tbody tr:last-child td {
        border-bottom: none;
    }

    .assignments-page tbody tr:hover {
        background: #f8fafc;
    }

    .assignments-page .assignment-id {
        color: #1d4ed8;
        font-weight: 750;
        white-space: nowrap;
    }

    .assignments-page .report-title,
    .assignments-page .team-name {
        min-width: 180px;
        color: #10233f;
        font-size: 16px;
        font-weight: 750;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    .assignments-page .cell-description {
        margin-top: 6px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.8;
        overflow-wrap: anywhere;
    }

    .assignments-page .assigned-by {
        font-weight: 600;
        min-width: 120px;
        overflow-wrap: anywhere;
    }

    .assignments-page .assignment-date {
        min-width: 145px;
        white-space: nowrap;
        font-size: 14px;
    }

    .assignments-page .status-badge {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 750;
        text-transform: capitalize;
        white-space: nowrap;
    }

    .assignments-page .status-pending {
        color: #92400e;
        background: #fef3c7;
    }

    .assignments-page .status-assigned {
        color: #1d4ed8;
        background: #dbeafe;
    }

    .assignments-page .status-in-progress {
        color: #6d28d9;
        background: #ede9fe;
    }

    .assignments-page .status-completed,
    .assignments-page .status-resolved {
        color: #166534;
        background: #dcfce7;
    }

    .assignments-page .status-default {
        color: #475569;
        background: #e2e8f0;
    }

    .assignments-page .empty-state {
        padding: 65px 24px;
        text-align: center;
    }

    .assignments-page .empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 78px;
        height: 78px;
        margin: 0 auto 22px;
        color: #1d4ed8;
        background: #eff6ff;
        border-radius: 50%;
        font-size: 35px;
    }

    .assignments-page .empty-state h3 {
        margin: 0 0 12px;
        color: #10233f;
        font-size: 24px;
        font-weight: 750;
        line-height: 1.5;
    }

    .assignments-page .empty-state p {
        max-width: 570px;
        margin: 0 auto 25px;
        color: #64748b;
        font-size: 15px;
        line-height: 1.9;
    }

    .assignments-page .pagination-area {
        padding: 20px 24px;
        border-top: 1px solid #e2e8f0;
    }

    .assignments-page .pagination-area nav {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    @media (max-width: 900px) {
        .assignments-page .stats-grid {
            grid-template-columns: 1fr;
        }

        .assignments-page .page-header h1 {
            font-size: 27px;
        }
    }

    @media (max-width: 600px) {
        .assignments-page .page-header {
            align-items: stretch;
        }

        .assignments-page .page-header .btn {
            width: 100%;
        }

        .assignments-page .stat-card {
            padding: 21px;
        }

        .assignments-page .card-header {
            padding: 20px;
        }

        .assignments-page .empty-state {
            padding: 45px 18px;
        }
    }
</style>

@php
    $assignmentCollection = collect($assignments->items());

    $totalAssignments = $assignments->total();

    $pendingAssignments = $assignmentCollection->filter(function ($assignment) {
        return strtolower(str_replace('_', '-', $assignment->status ?? 'pending')) === 'pending';
    })->count();

    $completedAssignments = $assignmentCollection->filter(function ($assignment) {
        return in_array(
            strtolower(str_replace('_', '-', $assignment->status ?? '')),
            ['completed', 'resolved']
        );
    })->count();
@endphp

<div class="assignments-page">

    <div class="page-header">
        <div>
            <h1>Incident Assignments</h1>
            <p>
                Monitor emergency response operations, track assigned campus teams
                and review the status of incident assignments.
            </p>
        </div>

        <a href="{{ route('incident-assignments.create') }}"
           class="btn btn-primary">
            + Assign Response Team
        </a>
    </div>

    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-label">Total Assignments</div>
            <div class="stat-number">{{ $totalAssignments }}</div>
            <div class="stat-description">
                All registered response team assignments
            </div>
        </div>

        <div class="stat-card pending">
            <div class="stat-label">Pending Assignments</div>
            <div class="stat-number">{{ $pendingAssignments }}</div>
            <div class="stat-description">
                Pending assignments in the displayed results
            </div>
        </div>

        <div class="stat-card completed">
            <div class="stat-label">Completed Assignments</div>
            <div class="stat-number">{{ $completedAssignments }}</div>
            <div class="stat-description">
                Completed or resolved assignments in the displayed results
            </div>
        </div>

    </div>

    <div class="assignments-card">

        <div class="card-header">
            <div>
                <h2>Campus Response Assignments</h2>
                <p>
                    View the incident, assigned response team, responsible person
                    and current assignment status.
                </p>
            </div>

            <span class="count-badge">
                Total: {{ $totalAssignments }}
            </span>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Assignment ID</th>
                        <th>Emergency Report</th>
                        <th>Response Team</th>
                        <th>Assigned By</th>
                        <th>Assignment Date</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($assignments as $assignment)

                        @php
                            $status = strtolower(
                                str_replace('_', '-', $assignment->status ?? 'pending')
                            );

                            $statusClass = in_array(
                                $status,
                                ['pending', 'assigned', 'in-progress', 'completed', 'resolved']
                            ) ? 'status-' . $status : 'status-default';
                        @endphp

                        <tr>
                            <td>
                                <span class="assignment-id">
                                    #{{ $assignment->id }}
                                </span>
                            </td>

                            <td>
                                <div class="report-title">
                                    {{ $assignment->report->title ?? 'Report unavailable' }}
                                </div>

                                @if($assignment->report)
                                    <div class="cell-description">
                                        {{ $assignment->report->location ?? 'Location not provided' }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                <div class="team-name">
                                    {{ $assignment->team->name ?? 'Team unavailable' }}
                                </div>

                                @if($assignment->team)
                                    <div class="cell-description">
                                        {{ ucfirst($assignment->team->team_type ?? 'Response Team') }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                <div class="assigned-by">
                                    {{ $assignment->assignedBy->name ?? 'Unknown' }}
                                </div>
                            </td>

                            <td class="assignment-date">
                                @if($assignment->assigned_at)
                                    {{ $assignment->assigned_at->format('d M Y') }}
                                    <div class="cell-description">
                                        {{ $assignment->assigned_at->format('h:i A') }}
                                    </div>
                                @elseif($assignment->created_at)
                                    {{ $assignment->created_at->format('d M Y') }}
                                    <div class="cell-description">
                                        {{ $assignment->created_at->format('h:i A') }}
                                    </div>
                                @else
                                    Not available
                                @endif
                            </td>

                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ ucfirst(str_replace('-', ' ', $status)) }}
                                </span>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-icon">🛡️</div>

                                    <h3>No Incident Assignments Yet</h3>

                                    <p>
                                        No emergency response teams have been assigned
                                        to incidents yet. Create an assignment to connect
                                        an emergency report with the appropriate campus
                                        response team.
                                    </p>

                                    <a href="{{ route('incident-assignments.create') }}"
                                       class="btn btn-primary">
                                        + Create First Assignment
                                    </a>
                                </div>
                            </td>
                        </tr>

                    @endforelse
                </tbody>
            </table>
        </div>

        @if($assignments->hasPages())
            <div class="pagination-area">
                {{ $assignments->links() }}
            </div>
        @endif

    </div>

</div>

@endsection
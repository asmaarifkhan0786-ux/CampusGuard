@extends('layouts.app')

@section('title', 'Emergency Reports')
@section('heading', 'Emergency Reports')

@section('content')

<style>
    .reports-page {
        width: 100%;
        max-width: 1600px;
        margin: 0 auto;
        color: #0f172a;
    }

    .reports-page * {
        box-sizing: border-box;
    }

    .reports-page .reports-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 28px;
    }

    .reports-page .reports-header h1 {
        margin: 0 0 10px;
        font-size: 30px;
        font-weight: 750;
        color: #10233f;
        line-height: 1.3;
    }

    .reports-page .reports-header p {
        margin: 0;
        color: #64748b;
        font-size: 16px;
        line-height: 1.7;
    }

    .reports-page .report-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }

    .reports-page .stat-card {
        background: #fff;
        padding: 24px;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
    }

    .reports-page .stat-label {
        color: #64748b;
        font-size: 15px;
        font-weight: 500;
        margin-bottom: 12px;
    }

    .reports-page .stat-value {
        color: #10233f;
        font-size: 32px;
        font-weight: 750;
        line-height: 1.2;
    }

    .reports-page .reports-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
    }

    .reports-page .card-heading {
        padding: 24px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .reports-page .card-heading h2 {
        font-size: 21px;
        color: #10233f;
        margin: 0;
        font-weight: 700;
    }

    .reports-page .card-heading p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }

    .reports-page .table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .reports-page table {
        width: 100%;
        min-width: 1100px;
        border-collapse: collapse;
        text-align: left;
    }

    .reports-page thead th {
        padding: 18px 20px;
        background: #f1f5f9;
        color: #334155;
        font-size: 14px;
        font-weight: 700;
        white-space: nowrap;
        border-bottom: 1px solid #e2e8f0;
    }

    .reports-page tbody td {
        padding: 22px 20px;
        border-bottom: 1px solid #e9eef5;
        color: #334155;
        font-size: 15px;
        line-height: 1.7;
        vertical-align: top;
    }

    .reports-page tbody tr:last-child td {
        border-bottom: none;
    }

    .reports-page tbody tr:hover {
        background: #f8fafc;
    }

    .reports-page .report-id {
        font-weight: 750;
        color: #1d4ed8;
        white-space: nowrap;
    }

    .reports-page .incident-title {
        font-size: 16px;
        font-weight: 700;
        color: #10233f;
        line-height: 1.6;
        min-width: 200px;
    }

    .reports-page .incident-description {
        margin-top: 8px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.8;
        min-width: 200px;
        max-width: 360px;
        overflow-wrap: anywhere;
    }

    .reports-page .location-text {
        min-width: 145px;
        font-size: 14px;
        line-height: 1.8;
        overflow-wrap: anywhere;
    }

    .reports-page .priority-badge,
    .reports-page .status-badge {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 750;
        text-transform: capitalize;
        white-space: nowrap;
    }

    .reports-page .priority-critical {
        color: #991b1b;
        background: #fee2e2;
    }

    .reports-page .priority-high {
        color: #9a3412;
        background: #ffedd5;
    }

    .reports-page .priority-medium {
        color: #854d0e;
        background: #fef9c3;
    }

    .reports-page .priority-low {
        color: #166534;
        background: #dcfce7;
    }

    .reports-page .status-pending {
        color: #92400e;
        background: #fef3c7;
    }

    .reports-page .status-in-progress {
        color: #1d4ed8;
        background: #dbeafe;
    }

    .reports-page .status-resolved,
    .reports-page .status-closed {
        color: #166534;
        background: #dcfce7;
    }

    .reports-page .status-default {
        color: #475569;
        background: #e2e8f0;
    }

    .reports-page .reporter-name {
        font-weight: 600;
        color: #334155;
        white-space: nowrap;
    }

    .reports-page .report-date {
        min-width: 125px;
        white-space: nowrap;
        font-size: 14px;
    }

    .reports-page .empty-state {
        text-align: center;
        padding: 60px 24px;
    }

    .reports-page .empty-state h3 {
        font-size: 22px;
        color: #10233f;
        margin: 0 0 12px;
    }

    .reports-page .empty-state p {
        font-size: 15px;
        color: #64748b;
        line-height: 1.7;
        margin: 0 0 22px;
    }

    .reports-page .btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 13px 19px;
        min-height: 46px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 15px;
        font-weight: 650;
        white-space: nowrap;
        cursor: pointer;
        border: 1px solid transparent;
    }

    .reports-page .btn-primary {
        background: #123a70;
        color: #fff;
    }

    .reports-page .btn-primary:hover {
        background: #0b2850;
    }

    .reports-page .date-cell {
        white-space: nowrap;
    }

    @media (max-width: 900px) {
        .reports-page .report-stats {
            grid-template-columns: 1fr;
        }

        .reports-page .reports-header h1 {
            font-size: 26px;
        }
    }

    @media (max-width: 600px) {
        .reports-page .reports-header {
            align-items: stretch;
        }

        .reports-page .reports-header .btn {
            width: 100%;
        }

        .reports-page .card-heading {
            padding: 18px;
        }

        .reports-page .stat-card {
            padding: 20px;
        }
    }
</style>

<div class="reports-page">

    <div class="reports-header">
        <div>
            <h1>Emergency Reports</h1>
            <p>
                View, monitor and manage reported campus emergencies.
                Review incident details and track response status.
            </p>
        </div>

        <a href="{{ route('emergency-reports.create') }}"
           class="btn btn-primary">
            + Create Emergency Report
        </a>
    </div>

    <div class="report-stats">

        <div class="stat-card">
            <div class="stat-label">Total Emergency Reports</div>
            <div class="stat-value">{{ $reports->count() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Critical Incidents</div>
            <div class="stat-value">
                {{ $reports->where('priority', 'critical')->count() }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Pending Reports</div>
            <div class="stat-value">
                {{ $reports->where('status', 'pending')->count() }}
            </div>
        </div>

    </div>

    <div class="reports-card">

        <div class="card-heading">
            <div>
                <h2>Reported Campus Incidents</h2>
                <p>Complete details of emergency reports submitted to the system.</p>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Report ID</th>
                        <th>Emergency Details</th>
                        <th>Location</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Reported By</th>
                        <th>Report Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($reports as $report)

                        @php
                            $priority = strtolower($report->priority ?? 'low');
                            $status = strtolower($report->status ?? 'pending');

                            $priorityClass = in_array($priority, ['critical', 'high', 'medium', 'low'])
                                ? 'priority-' . $priority
                                : 'priority-low';

                            $statusClass = in_array($status, ['pending', 'in-progress', 'resolved', 'closed'])
                                ? 'status-' . $status
                                : 'status-default';
                        @endphp

                        <tr>
                            <td>
                                <span class="report-id">
                                    #{{ $report->id }}
                                </span>
                            </td>

                            <td>
                                <div class="incident-title">
                                    {{ $report->title ?? 'Untitled Emergency' }}
                                </div>

                                <div class="incident-description">
                                    {{ $report->description ?? 'No additional description provided.' }}
                                </div>
                            </td>

                            <td>
                                <div class="location-text">
                                    {{ $report->location ?? 'Location not provided' }}
                                </div>
                            </td>

                            <td>
                                <span class="priority-badge {{ $priorityClass }}">
                                    {{ ucfirst($priority) }}
                                </span>
                            </td>

                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </span>
                            </td>

                            <td>
                                <span class="reporter-name">
                                    {{ $report->reportedBy->name ?? $report->user->name ?? 'Unknown' }}
                                </span>
                            </td>

                            <td class="report-date">
                                {{ $report->created_at ? $report->created_at->format('d M Y') : 'N/A' }}
                                @if($report->created_at)
                                    <div style="color:#64748b;font-size:13px;margin-top:4px;">
                                        {{ $report->created_at->format('h:i A') }}
                                    </div>
                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <h3>No Emergency Reports Found</h3>
                                    <p>
                                        No campus emergencies have been reported yet.
                                        Create a report to start monitoring incidents.
                                    </p>

                                    <a href="{{ route('emergency-reports.create') }}"
                                       class="btn btn-primary">
                                        + Create First Emergency Report
                                    </a>
                                </div>
                            </td>
                        </tr>

                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection
@extends('layouts.app')

@section('title', 'Emergency Alerts')
@section('heading', 'Emergency Alerts')

@section('content')

<style>
    .alerts-page {
        width: 100%;
        max-width: 1600px;
        margin: 0 auto;
        color: #0f172a;
    }

    .alerts-page * {
        box-sizing: border-box;
    }

    .alerts-page .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 30px;
    }

    .alerts-page .page-header h1 {
        margin: 0 0 10px;
        color: #10233f;
        font-size: 32px;
        font-weight: 750;
        line-height: 1.35;
    }

    .alerts-page .page-header p {
        margin: 0;
        color: #64748b;
        font-size: 16px;
        line-height: 1.8;
        max-width: 700px;
    }

    .alerts-page .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 14px 20px;
        min-height: 48px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 15px;
        font-weight: 700;
        border: 1px solid transparent;
        cursor: pointer;
        white-space: nowrap;
    }

    .alerts-page .btn-primary {
        background: #123a70;
        color: #fff;
    }

    .alerts-page .btn-primary:hover {
        background: #0b2850;
    }

    .alerts-page .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
        margin-bottom: 30px;
    }

    .alerts-page .stat-card {
        position: relative;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 5px 18px rgba(15, 23, 42, 0.04);
    }

    .alerts-page .stat-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: #2563eb;
    }

    .alerts-page .stat-card.stat-critical::before {
        background: #dc2626;
    }

    .alerts-page .stat-card.stat-active::before {
        background: #16a34a;
    }

    .alerts-page .stat-label {
        margin-bottom: 12px;
        color: #64748b;
        font-size: 15px;
        font-weight: 600;
    }

    .alerts-page .stat-number {
        color: #10233f;
        font-size: 34px;
        font-weight: 800;
        line-height: 1.25;
    }

    .alerts-page .stat-description {
        margin-top: 9px;
        color: #94a3b8;
        font-size: 13px;
        line-height: 1.6;
    }

    .alerts-page .register-card {
        overflow: hidden;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 5px 20px rgba(15, 23, 42, 0.04);
    }

    .alerts-page .register-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        padding: 25px;
        border-bottom: 1px solid #e2e8f0;
    }

    .alerts-page .register-header h2 {
        margin: 0;
        color: #10233f;
        font-size: 22px;
        font-weight: 750;
        line-height: 1.5;
    }

    .alerts-page .register-header p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.7;
    }

    .alerts-page .total-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 15px;
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 750;
        white-space: nowrap;
    }

    .alerts-page .table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .alerts-page table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
        text-align: left;
    }

    .alerts-page thead th {
        padding: 19px 20px;
        background: #f1f5f9;
        border-bottom: 1px solid #e2e8f0;
        color: #334155;
        font-size: 14px;
        font-weight: 750;
        white-space: nowrap;
    }

    .alerts-page tbody td {
        padding: 22px 20px;
        border-bottom: 1px solid #e9eef5;
        color: #334155;
        font-size: 15px;
        line-height: 1.8;
        vertical-align: top;
    }

    .alerts-page tbody tr:last-child td {
        border-bottom: none;
    }

    .alerts-page tbody tr:hover {
        background: #f8fafc;
    }

    .alerts-page .alert-id {
        color: #1d4ed8;
        font-weight: 750;
        white-space: nowrap;
    }

    .alerts-page .alert-title {
        min-width: 200px;
        color: #10233f;
        font-size: 16px;
        font-weight: 750;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    .alerts-page .alert-message {
        min-width: 220px;
        max-width: 380px;
        margin-top: 8px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.9;
        overflow-wrap: anywhere;
    }

    .alerts-page .location-cell {
        min-width: 140px;
        overflow-wrap: anywhere;
    }

    .alerts-page .severity-badge,
    .alerts-page .status-badge {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 750;
        text-transform: capitalize;
        white-space: nowrap;
    }

    .alerts-page .severity-critical {
        color: #991b1b;
        background: #fee2e2;
    }

    .alerts-page .severity-high {
        color: #9a3412;
        background: #ffedd5;
    }

    .alerts-page .severity-medium {
        color: #854d0e;
        background: #fef9c3;
    }

    .alerts-page .severity-low {
        color: #166534;
        background: #dcfce7;
    }

    .alerts-page .severity-default {
        color: #475569;
        background: #e2e8f0;
    }

    .alerts-page .status-active {
        color: #166534;
        background: #dcfce7;
    }

    .alerts-page .status-inactive,
    .alerts-page .status-expired {
        color: #475569;
        background: #e2e8f0;
    }

    .alerts-page .status-scheduled {
        color: #1d4ed8;
        background: #dbeafe;
    }

    .alerts-page .status-default {
        color: #92400e;
        background: #fef3c7;
    }

    .alerts-page .date-cell {
        min-width: 155px;
        white-space: nowrap;
        font-size: 14px;
    }

    .alerts-page .date-time {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 13px;
    }

    .alerts-page .empty-state {
        padding: 65px 24px;
        text-align: center;
    }

    .alerts-page .empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 76px;
        height: 76px;
        margin: 0 auto 22px;
        border-radius: 50%;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 34px;
    }

    .alerts-page .empty-state h3 {
        margin: 0 0 12px;
        color: #10233f;
        font-size: 23px;
        font-weight: 750;
        line-height: 1.5;
    }

    .alerts-page .empty-state p {
        max-width: 550px;
        margin: 0 auto 25px;
        color: #64748b;
        font-size: 15px;
        line-height: 1.9;
    }

    @media (max-width: 900px) {
        .alerts-page .stats-grid {
            grid-template-columns: 1fr;
        }

        .alerts-page .page-header h1 {
            font-size: 27px;
        }
    }

    @media (max-width: 600px) {
        .alerts-page .page-header {
            align-items: stretch;
        }

        .alerts-page .page-header .btn {
            width: 100%;
        }

        .alerts-page .stat-card {
            padding: 21px;
        }

        .alerts-page .register-header {
            padding: 20px;
        }

        .alerts-page .empty-state {
            padding: 45px 18px;
        }
    }
</style>

<div class="alerts-page">

    <div class="page-header">
        <div>
            <h1>Emergency Alerts</h1>
            <p>
                Create, publish and manage emergency notifications for the campus community.
                Monitor alert severity, locations and notification schedules from one place.
            </p>
        </div>

        <a href="{{ route('emergency-alerts.create') }}"
           class="btn btn-primary">
            + Create New Alert
        </a>
    </div>

    @php
        $alertCollection = $alerts instanceof \Illuminate\Pagination\AbstractPaginator
            ? collect($alerts->items())
            : collect($alerts);

        $totalAlerts = method_exists($alerts, 'total')
            ? $alerts->total()
            : $alertCollection->count();

        $criticalAlerts = $alertCollection->filter(function ($alert) {
            return strtolower($alert->severity ?? '') === 'critical';
        })->count();

        $activeAlerts = $alertCollection->filter(function ($alert) {
            return (bool) ($alert->is_active ?? false);
        })->count();
    @endphp

    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-label">Total Emergency Alerts</div>
            <div class="stat-number">{{ $totalAlerts }}</div>
            <div class="stat-description">
                All alerts registered in the system
            </div>
        </div>

        <div class="stat-card stat-critical">
            <div class="stat-label">Critical Severity</div>
            <div class="stat-number">{{ $criticalAlerts }}</div>
            <div class="stat-description">
                Critical alerts in the displayed results
            </div>
        </div>

        <div class="stat-card stat-active">
            <div class="stat-label">Active Alerts</div>
            <div class="stat-number">{{ $activeAlerts }}</div>
            <div class="stat-description">
                Active alerts in the displayed results
            </div>
        </div>

    </div>

    <div class="register-card">

        <div class="register-header">
            <div>
                <h2>Campus Alert Register</h2>
                <p>Review emergency notifications and their current status.</p>
            </div>

            <span class="total-count">
                Total: {{ $totalAlerts }}
            </span>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Alert ID</th>
                        <th>Alert Details</th>
                        <th>Severity</th>
                        <th>Location</th>
                        <th>Start Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($alertCollection as $alert)

                        @php
                            $severity = strtolower($alert->severity ?? 'normal');
                            $severityClass = in_array($severity, ['critical', 'high', 'medium', 'low'])
                                ? 'severity-' . $severity
                                : 'severity-default';

                            $isActive = (bool) ($alert->is_active ?? false);

                            $startsAt = $alert->starts_at ?? null;
                            $expiresAt = $alert->expires_at ?? null;

                            if (!$isActive) {
                                $statusText = 'Inactive';
                                $statusClass = 'status-inactive';
                            } elseif ($expiresAt && \Carbon\Carbon::parse($expiresAt)->isPast()) {
                                $statusText = 'Expired';
                                $statusClass = 'status-expired';
                            } elseif ($startsAt && \Carbon\Carbon::parse($startsAt)->isFuture()) {
                                $statusText = 'Scheduled';
                                $statusClass = 'status-scheduled';
                            } else {
                                $statusText = 'Active';
                                $statusClass = 'status-active';
                            }
                        @endphp

                        <tr>
                            <td>
                                <span class="alert-id">#{{ $alert->id }}</span>
                            </td>

                            <td>
                                <div class="alert-title">
                                    {{ $alert->title ?? 'Untitled Alert' }}
                                </div>

                                <div class="alert-message">
                                    {{ $alert->message ?? 'No additional details provided.' }}
                                </div>
                            </td>

                            <td>
                                <span class="severity-badge {{ $severityClass }}">
                                    {{ ucfirst($severity) }}
                                </span>
                            </td>

                            <td>
                                <div class="location-cell">
                                    {{ $alert->location ?? 'Campus-wide' }}
                                </div>
                            </td>

                            <td class="date-cell">
                                @if($startsAt)
                                    {{ \Carbon\Carbon::parse($startsAt)->format('d M Y') }}
                                    <span class="date-time">
                                        {{ \Carbon\Carbon::parse($startsAt)->format('h:i A') }}
                                    </span>
                                @else
                                    Not scheduled
                                @endif
                            </td>

                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ $statusText }}
                                </span>
                            </td>

                            <td>
                                <span style="color:#64748b;font-size:14px;">
                                    —
                                </span>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon">🔔</div>

                                    <h3>No Emergency Alerts Found</h3>

                                    <p>
                                        There are currently no emergency alerts registered in the system.
                                        Create your first alert to share important safety information
                                        with students, faculty and campus staff.
                                    </p>

                                    <a href="{{ route('emergency-alerts.create') }}"
                                       class="btn btn-primary">
                                        + Create First Alert
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
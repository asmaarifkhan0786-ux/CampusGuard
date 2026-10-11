@extends('layouts.app')

@section('title', 'Reports & Analytics')

@section('content')
@php
    $total = $totalIncidents ?? 0;
    $active = $activeIncidents ?? 0;
    $resolved = $resolvedIncidents ?? 0;
    $pending = max(0, $total - $active - $resolved);

    $resolutionRate = $total > 0
        ? round(($resolved / $total) * 100)
        : 0;

    $activeRate = $total > 0
        ? round(($active / $total) * 100)
        : 0;

    $resolvedRate = $total > 0
        ? round(($resolved / $total) * 100)
        : 0;
@endphp

<style>
    .ra-page {
        color: #172b4d;
        padding-bottom: 35px;
    }

    .ra-page * {
        box-sizing: border-box;
    }

    .ra-hero {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        padding: 32px;
        margin-bottom: 25px;
        color: white;
        background: linear-gradient(120deg, #061d40, #164579);
        border-radius: 18px;
    }

    .ra-hero h1 {
        color: white;
        font-size: 30px;
        font-weight: 800;
        margin: 0 0 10px;
    }

    .ra-hero p {
        color: #dbeafe;
        font-size: 16px;
        line-height: 1.8;
        margin: 0;
        max-width: 650px;
    }

    .ra-hero-icon {
        width: 88px;
        height: 88px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,.12);
        border-radius: 18px;
        font-size: 43px;
    }

    .ra-section-title {
        font-size: 22px;
        color: #102c50;
        font-weight: 800;
        margin: 0 0 7px;
    }

    .ra-section-subtitle {
        color: #64748b;
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
    }

    .ra-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 28px;
    }

    .ra-stat {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        padding: 23px;
        box-shadow: 0 5px 18px rgba(15,23,42,.04);
    }

    .ra-stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
    }

    .ra-stat-label {
        font-size: 14px;
        font-weight: 700;
        color: #64748b;
    }

    .ra-stat-icon {
        width: 45px;
        height: 45px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #eff6ff;
        font-size: 23px;
    }

    .ra-stat-number {
        color: #102c50;
        font-size: 34px;
        font-weight: 800;
        line-height: 1.2;
    }

    .ra-stat-note {
        font-size: 12px;
        color: #64748b;
        margin-top: 9px;
    }

    .ra-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.1fr) minmax(0, .9fr);
        gap: 22px;
        margin-bottom: 25px;
    }

    .ra-panel {
        min-width: 0;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 18px rgba(15,23,42,.04);
    }

    .ra-panel-heading {
        margin-bottom: 25px;
    }

    .ra-progress-row {
        margin-bottom: 25px;
    }

    .ra-progress-row:last-child {
        margin-bottom: 0;
    }

    .ra-progress-label {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: 700;
        color: #334155;
    }

    .ra-progress-track {
        height: 12px;
        width: 100%;
        overflow: hidden;
        background: #e2e8f0;
        border-radius: 30px;
    }

    .ra-progress-fill {
        height: 100%;
        border-radius: 30px;
        transition: width .3s ease;
    }

    .ra-fill-blue {
        background: #2563eb;
    }

    .ra-fill-green {
        background: #16a34a;
    }

    .ra-fill-orange {
        background: #ea580c;
    }

    .ra-fill-purple {
        background: #7c3aed;
    }

    .ra-resolution {
        display: flex;
        align-items: center;
        gap: 23px;
        flex-wrap: wrap;
    }

    .ra-ring {
        width: 135px;
        height: 135px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: conic-gradient(
            #16a34a {{ $resolutionRate * 1 }}%,
            #e2e8f0 {{ $resolutionRate * 1 }}% 100%
        );
        position: relative;
    }

    .ra-ring::before {
        content: "";
        position: absolute;
        width: 103px;
        height: 103px;
        border-radius: 50%;
        background: white;
    }

    .ra-ring-inner {
        position: relative;
        z-index: 1;
        text-align: center;
    }

    .ra-ring-inner strong {
        display: block;
        font-size: 27px;
        font-weight: 800;
        color: #102c50;
    }

    .ra-ring-inner span {
        color: #64748b;
        font-size: 11px;
    }

    .ra-resolution-copy {
        flex: 1;
        min-width: 140px;
    }

    .ra-resolution-copy h3 {
        font-size: 18px;
        color: #102c50;
        font-weight: 800;
        margin: 0 0 8px;
    }

    .ra-resolution-copy p {
        font-size: 14px;
        color: #64748b;
        line-height: 1.8;
        margin: 0;
    }

    .ra-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 22px;
    }

    .ra-legend-item {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        color: #64748b;
    }

    .ra-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        display: inline-block;
    }

    .ra-table-wrap {
        overflow-x: auto;
        width: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        margin-top: 22px;
    }

    .ra-table {
        width: 100%;
        min-width: 680px;
        border-collapse: collapse;
        text-align: left;
    }

    .ra-table thead {
        background: #f1f5f9;
    }

    .ra-table th {
        padding: 16px 18px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .4px;
        color: #475569;
        white-space: nowrap;
    }

    .ra-table td {
        padding: 17px 18px;
        font-size: 14px;
        color: #334155;
        border-top: 1px solid #e2e8f0;
        vertical-align: middle;
    }

    .ra-table tbody tr:hover {
        background: #f8fafc;
    }

    .ra-empty {
        text-align: center;
        padding: 35px 20px;
        color: #64748b;
    }

    .ra-empty-icon {
        font-size: 38px;
        margin-bottom: 10px;
    }

    .ra-empty h3 {
        color: #102c50;
        font-size: 18px;
        margin: 0 0 8px;
    }

    .ra-empty p {
        font-size: 14px;
        margin: 0;
        line-height: 1.7;
    }

    .ra-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .ra-badge-green {
        color: #166534;
        background: #dcfce7;
    }

    .ra-badge-blue {
        color: #1d4ed8;
        background: #dbeafe;
    }

    .ra-badge-orange {
        color: #9a3412;
        background: #ffedd5;
    }

    .ra-badge-red {
        color: #991b1b;
        background: #fee2e2;
    }

    @media(max-width: 1150px) {
        .ra-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .ra-layout {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width: 600px) {
        .ra-hero {
            padding: 22px;
        }

        .ra-hero h1 {
            font-size: 24px;
        }

        .ra-hero-icon {
            display: none;
        }

        .ra-stats {
            grid-template-columns: 1fr;
        }

        .ra-panel {
            padding: 18px;
        }

        .ra-resolution {
            justify-content: center;
        }

        .ra-resolution-copy {
            flex-basis: 100%;
        }
    }
</style>

<div class="ra-page">

    <div class="ra-hero">
        <div>
            <h1>Reports &amp; Analytics</h1>
            <p>
                Monitor campus emergency activity, track incident resolution
                and review key safety indicators in one centralized dashboard.
            </p>
        </div>
        <div class="ra-hero-icon">📊</div>
    </div>

    <div style="margin-bottom:20px;">
        <h2 class="ra-section-title">Incident Overview</h2>
        <p class="ra-section-subtitle">
            A summary of the incident records currently supplied by the system.
        </p>
    </div>

    <div class="ra-stats">
        <div class="ra-stat">
            <div class="ra-stat-top">
                <span class="ra-stat-label">Total Incidents</span>
                <span class="ra-stat-icon">📋</span>
            </div>
            <div class="ra-stat-number">{{ $total }}</div>
            <div class="ra-stat-note">All recorded incidents</div>
        </div>

        <div class="ra-stat">
            <div class="ra-stat-top">
                <span class="ra-stat-label">Active Incidents</span>
                <span class="ra-stat-icon">🚨</span>
            </div>
            <div class="ra-stat-number">{{ $active }}</div>
            <div class="ra-stat-note">Incidents requiring attention</div>
        </div>

        <div class="ra-stat">
            <div class="ra-stat-top">
                <span class="ra-stat-label">Resolved Incidents</span>
                <span class="ra-stat-icon">✅</span>
            </div>
            <div class="ra-stat-number">{{ $resolved }}</div>
            <div class="ra-stat-note">Incidents marked resolved</div>
        </div>

        <div class="ra-stat">
            <div class="ra-stat-top">
                <span class="ra-stat-label">Pending / Other</span>
                <span class="ra-stat-icon">⏳</span>
            </div>
            <div class="ra-stat-number">{{ $pending }}</div>
            <div class="ra-stat-note">Other statuses based on the supplied totals</div>
        </div>
    </div>

    <div class="ra-layout">
        <section class="ra-panel">
            <div class="ra-panel-heading">
                <h2 class="ra-section-title">Incident Status Breakdown</h2>
                <p class="ra-section-subtitle">
                    Compare active, resolved and other incidents.
                </p>
            </div>

            <div class="ra-progress-row">
                <div class="ra-progress-label">
                    <span>Active Incidents</span>
                    <span>{{ $active }} ({{ $activeRate }}%)</span>
                </div>
                <div class="ra-progress-track">
                    <div class="ra-progress-fill ra-fill-orange"
                         style="width: {{ $activeRate }}%;"></div>
                </div>
            </div>

            <div class="ra-progress-row">
                <div class="ra-progress-label">
                    <span>Resolved Incidents</span>
                    <span>{{ $resolved }} ({{ $resolvedRate }}%)</span>
                </div>
                <div class="ra-progress-track">
                    <div class="ra-progress-fill ra-fill-green"
                         style="width: {{ $resolvedRate }}%;"></div>
                </div>
            </div>

            <div class="ra-progress-row">
                <div class="ra-progress-label">
                    <span>Pending / Other</span>
                    <span>{{ $pending }}</span>
                </div>
                <div class="ra-progress-track">
                    <div class="ra-progress-fill ra-fill-purple"
                         style="width: {{ $total > 0 ? round(($pending / $total) * 100) : 0 }}%;"></div>
                </div>
            </div>

            <div class="ra-legend">
                <span class="ra-legend-item">
                    <span class="ra-dot" style="background:#ea580c;"></span>
                    Active
                </span>
                <span class="ra-legend-item">
                    <span class="ra-dot" style="background:#16a34a;"></span>
                    Resolved
                </span>
                <span class="ra-legend-item">
                    <span class="ra-dot" style="background:#7c3aed;"></span>
                    Other
                </span>
            </div>
        </section>

        <section class="ra-panel">
            <div class="ra-panel-heading">
                <h2 class="ra-section-title">Resolution Performance</h2>
                <p class="ra-section-subtitle">
                    Percentage of recorded incidents marked resolved.
                </p>
            </div>

            <div class="ra-resolution">
                <div class="ra-ring">
                    <div class="ra-ring-inner">
                        <strong>{{ $resolutionRate }}%</strong>
                        <span>Resolved</span>
                    </div>
                </div>

                <div class="ra-resolution-copy">
                    <h3>Resolution Rate</h3>
                    <p>
                        {{ $resolved }} of {{ $total }} recorded incidents
                        are marked resolved.
                    </p>
                </div>
            </div>

            <div class="ra-legend">
                <span class="ra-legend-item">
                    <span class="ra-dot" style="background:#16a34a;"></span>
                    Resolved: {{ $resolved }}
                </span>
                <span class="ra-legend-item">
                    <span class="ra-dot" style="background:#cbd5e1;"></span>
                    Not resolved: {{ max(0, $total - $resolved) }}
                </span>
            </div>
        </section>
    </div>

    <section class="ra-panel">
        <div class="ra-panel-heading">
            <h2 class="ra-section-title">Recent Incident Records</h2>
            <p class="ra-section-subtitle">
                Recent incidents will appear here when the controller supplies
                their records to this page.
            </p>
        </div>

        @php
            $recentIncidents = $incidents ?? $reports ?? collect();

            if ($recentIncidents instanceof \Illuminate\Pagination\AbstractPaginator) {
                $recentIncidents = $recentIncidents->getCollection();
            }

            $recentIncidents = collect($recentIncidents);
        @endphp

        <div class="ra-table-wrap">
            <table class="ra-table">
                <thead>
                    <tr>
                        <th>Incident</th>
                        <th>Location</th>
                        <th>Priority</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentIncidents->take(10) as $incident)
                        @php
                            $incidentTitle = $incident->title
                                ?? $incident->incident_type
                                ?? $incident->type
                                ?? ('Incident #' . ($incident->id ?? ''));

                            $incidentLocation = $incident->location
                                ?? $incident->campus_location
                                ?? 'Not specified';

                            if (is_object($incidentLocation)) {
                                $incidentLocation = $incidentLocation->name
                                    ?? $incidentLocation->location_name
                                    ?? 'Not specified';
                            }

                            $incidentStatus = $incident->status ?? 'Pending';
                            $incidentPriority = $incident->priority ?? 'Normal';

                            $statusClass = match (strtolower((string) $incidentStatus)) {
                                'resolved', 'closed', 'completed' => 'ra-badge-green',
                                'active', 'in progress', 'investigating' => 'ra-badge-orange',
                                default => 'ra-badge-blue',
                            };

                            $priorityClass = match (strtolower((string) $incidentPriority)) {
                                'critical', 'high', 'urgent' => 'ra-badge-red',
                                'medium' => 'ra-badge-orange',
                                default => 'ra-badge-blue',
                            };
                        @endphp

                        <tr>
                            <td>
                                <strong>{{ $incidentTitle }}</strong>
                                @if(isset($incident->id))
                                    <div style="font-size:12px;color:#64748b;margin-top:5px;">
                                        Incident #{{ $incident->id }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $incidentLocation }}</td>
                            <td>
                                <span class="ra-badge {{ $priorityClass }}">
                                    {{ ucfirst((string) $incidentPriority) }}
                                </span>
                            </td>
                            <td>
                                <span class="ra-badge {{ $statusClass }}">
                                    {{ ucfirst((string) $incidentStatus) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="ra-empty">
                                    <div class="ra-empty-icon">📈</div>
                                    <h3>No Incident Details Available</h3>
                                    <p>
                                        Summary figures are shown above. To display
                                        individual incidents, the controller must
                                        pass the incident records to this view.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</div>
@endsection
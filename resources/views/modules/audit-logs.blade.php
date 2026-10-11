@extends('layouts.app')

@section('title', 'Audit Logs')

@section('content')
@php
    $logs = $auditLogs ?? $activities ?? collect();

    if ($logs instanceof \Illuminate\Pagination\AbstractPaginator) {
        $logs = $logs->getCollection();
    }

    $logs = collect($logs);

    $totalLogs = $logs->count();

    $adminActions = $logs->filter(function ($log) {
        $role = strtolower((string) ($log->user->role ?? $log->role ?? ''));
        return $role === 'admin';
    })->count();

    $todayLogs = $logs->filter(function ($log) {
        $date = $log->created_at ?? null;
        return $date && \Illuminate\Support\Carbon::parse($date)->isToday();
    })->count();
@endphp

<style>
    .al-page {
        color: #172b4d;
        padding-bottom: 35px;
    }

    .al-page * {
        box-sizing: border-box;
    }

    .al-hero {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        padding: 30px;
        margin-bottom: 25px;
        color: #fff;
        background: linear-gradient(120deg, #061d40, #164579);
        border-radius: 18px;
    }

    .al-hero h1 {
        color: #fff;
        font-size: 30px;
        font-weight: 800;
        margin: 0 0 10px;
    }

    .al-hero p {
        color: #dbeafe;
        font-size: 16px;
        line-height: 1.8;
        margin: 0;
        max-width: 680px;
    }

    .al-hero-icon {
        width: 85px;
        height: 85px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,.13);
        border-radius: 18px;
        font-size: 42px;
    }

    .al-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 25px;
    }

    .al-stat {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        padding: 23px;
        box-shadow: 0 5px 18px rgba(15,23,42,.04);
    }

    .al-stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 17px;
    }

    .al-stat-label {
        color: #64748b;
        font-size: 14px;
        font-weight: 700;
    }

    .al-stat-icon {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #eff6ff;
        font-size: 22px;
    }

    .al-stat-number {
        color: #102c50;
        font-size: 32px;
        font-weight: 800;
    }

    .al-stat-note {
        margin-top: 7px;
        color: #64748b;
        font-size: 12px;
    }

    .al-panel {
        padding: 25px;
        margin-bottom: 24px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 5px 18px rgba(15,23,42,.04);
    }

    .al-panel-heading {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 22px;
    }

    .al-panel-heading h2 {
        color: #102c50;
        font-size: 22px;
        font-weight: 800;
        margin: 0 0 7px;
    }

    .al-panel-heading p {
        color: #64748b;
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
    }

    .al-filter-grid {
        display: grid;
        grid-template-columns: minmax(200px, 1fr) 220px;
        gap: 14px;
        margin-bottom: 22px;
    }

    .al-search {
        position: relative;
    }

    .al-search span {
        position: absolute;
        top: 12px;
        left: 14px;
        font-size: 17px;
    }

    .al-search input,
    .al-filter-grid select {
        width: 100%;
        height: 47px;
        padding: 11px 13px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        background: white;
        color: #334155;
        font-size: 14px;
        outline: none;
    }

    .al-search input {
        padding-left: 42px;
    }

    .al-search input:focus,
    .al-filter-grid select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,.1);
    }

    .al-table-wrap {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }

    .al-table {
        width: 100%;
        min-width: 760px;
        border-collapse: collapse;
        text-align: left;
    }

    .al-table thead {
        background: #f1f5f9;
    }

    .al-table th {
        padding: 16px 18px;
        color: #475569;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .4px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .al-table td {
        padding: 17px 18px;
        color: #334155;
        font-size: 14px;
        border-top: 1px solid #e2e8f0;
        vertical-align: middle;
    }

    .al-table tbody tr:hover {
        background: #f8fafc;
    }

    .al-user {
        display: flex;
        align-items: center;
        gap: 11px;
        min-width: 170px;
    }

    .al-avatar {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #dbeafe;
        color: #1d4ed8;
        font-weight: 800;
        font-size: 14px;
    }

    .al-user-name {
        font-weight: 800;
        color: #102c50;
        margin-bottom: 4px;
    }

    .al-user-role {
        color: #64748b;
        font-size: 12px;
    }

    .al-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .al-badge-blue {
        color: #1d4ed8;
        background: #dbeafe;
    }

    .al-badge-green {
        color: #166534;
        background: #dcfce7;
    }

    .al-badge-orange {
        color: #9a3412;
        background: #ffedd5;
    }

    .al-badge-red {
        color: #991b1b;
        background: #fee2e2;
    }

    .al-empty {
        padding: 45px 20px;
        text-align: center;
    }

    .al-empty-icon {
        font-size: 42px;
        margin-bottom: 12px;
    }

    .al-empty h3 {
        color: #102c50;
        font-size: 19px;
        margin: 0 0 8px;
    }

    .al-empty p {
        color: #64748b;
        font-size: 14px;
        line-height: 1.8;
        margin: 0 auto;
        max-width: 520px;
    }

    .al-notice {
        padding: 15px 17px;
        margin-bottom: 22px;
        border-left: 4px solid #2563eb;
        border-radius: 8px;
        background: #eff6ff;
        color: #1e40af;
        font-size: 14px;
        line-height: 1.8;
    }

    @media(max-width: 850px) {
        .al-stats {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width: 600px) {
        .al-hero {
            padding: 22px;
        }

        .al-hero h1 {
            font-size: 24px;
        }

        .al-hero-icon {
            display: none;
        }

        .al-panel {
            padding: 17px;
        }

        .al-filter-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="al-page">

    <div class="al-hero">
        <div>
            <h1>Audit Logs &amp; Activity Monitoring</h1>
            <p>
                Review system activity, monitor user actions and maintain
                visibility into important campus safety system operations.
            </p>
        </div>
        <div class="al-hero-icon">🛡️</div>
    </div>

    <div class="al-stats">
        <div class="al-stat">
            <div class="al-stat-top">
                <span class="al-stat-label">Activity Records</span>
                <span class="al-stat-icon">📋</span>
            </div>
            <div class="al-stat-number">{{ $totalLogs }}</div>
            <div class="al-stat-note">Records supplied to this page</div>
        </div>

        <div class="al-stat">
            <div class="al-stat-top">
                <span class="al-stat-label">Today's Activities</span>
                <span class="al-stat-icon">🕒</span>
            </div>
            <div class="al-stat-number">{{ $todayLogs }}</div>
            <div class="al-stat-note">Records dated today</div>
        </div>

        <div class="al-stat">
            <div class="al-stat-top">
                <span class="al-stat-label">Admin Activities</span>
                <span class="al-stat-icon">🔐</span>
            </div>
            <div class="al-stat-number">{{ $adminActions }}</div>
            <div class="al-stat-note">Records associated with admin role</div>
        </div>
    </div>

    <div class="al-panel">
        <div class="al-panel-heading">
            <div>
                <h2>System Activity Log</h2>
                <p>
                    Search and filter the available activity records.
                </p>
            </div>
            <span class="al-badge al-badge-blue">
                {{ $totalLogs }} records
            </span>
        </div>

        <div class="al-notice">
            <strong>Audit tracking:</strong>
            This page displays activity records supplied by the application.
            To record every login, update, deletion and other user action,
            the backend must save those events in an audit log database table.
        </div>

        <div class="al-filter-grid">
            <div class="al-search">
                <span>🔎</span>
                <input
                    type="search"
                    id="alSearch"
                    placeholder="Search user, action or description..."
                    aria-label="Search audit records"
                >
            </div>

            <select id="alActionFilter" aria-label="Filter by action">
                <option value="">All Actions</option>
                @foreach($logs as $log)
                    @php
                        $actionName = $log->action
                            ?? $log->event
                            ?? $log->activity
                            ?? $log->description
                            ?? '';
                    @endphp

                    @if(trim((string) $actionName) !== '')
                        <option value="{{ strtolower($actionName) }}">
                            {{ ucfirst($actionName) }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="al-table-wrap">
            <table class="al-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>Date &amp; Time</th>
                    </tr>
                </thead>

                <tbody id="alTableBody">
                    @forelse($logs as $log)
                        @php
                            $userName = $log->user->name
                                ?? $log->user->username
                                ?? $log->user_name
                                ?? 'System';

                            $userRole = $log->user->role
                                ?? $log->role
                                ?? 'System';

                            $action = $log->action
                                ?? $log->event
                                ?? $log->activity
                                ?? 'Activity';

                            $description = $log->description
                                ?? $log->message
                                ?? $log->details
                                ?? 'No description available';

                            $date = $log->created_at ?? null;

                            $initial = strtoupper(substr((string) $userName, 0, 1));

                            $actionText = strtolower((string) $action);

                            $actionClass = str_contains($actionText, 'delete')
                                ? 'al-badge-red'
                                : (str_contains($actionText, 'create') ||
                                   str_contains($actionText, 'login')
                                   ? 'al-badge-green'
                                   : (str_contains($actionText, 'update') ||
                                      str_contains($actionText, 'edit')
                                      ? 'al-badge-orange'
                                      : 'al-badge-blue'));
                        @endphp

                        <tr
                            data-audit-row
                            data-search="{{ strtolower($userName . ' ' . $action . ' ' . $description . ' ' . $userRole) }}"
                            data-action="{{ strtolower((string) $action) }}"
                        >
                            <td>
                                <div class="al-user">
                                    <div class="al-avatar">{{ $initial ?: 'S' }}</div>
                                    <div>
                                        <div class="al-user-name">{{ $userName }}</div>
                                        <div class="al-user-role">{{ ucfirst((string) $userRole) }}</div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="al-badge {{ $actionClass }}">
                                    {{ ucfirst((string) $action) }}
                                </span>
                            </td>

                            <td>{{ $description }}</td>

                            <td>
                                @if($date)
                                    <strong>{{ \Illuminate\Support\Carbon::parse($date)->format('d M Y') }}</strong>
                                    <div style="font-size:12px;color:#64748b;margin-top:5px;">
                                        {{ \Illuminate\Support\Carbon::parse($date)->format('h:i A') }}
                                    </div>
                                @else
                                    <span style="color:#94a3b8;">Not recorded</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr id="alEmptyRow">
                            <td colspan="4">
                                <div class="al-empty">
                                    <div class="al-empty-icon">🗂️</div>
                                    <h3>No Activity Records Yet</h3>
                                    <p>
                                        There are no audit records available to display.
                                        Once audit tracking is connected and activities
                                        are saved, they will appear here.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <p id="alNoResults" hidden
           style="text-align:center;padding:25px;color:#64748b;">
            No matching activities found. Try a different search or action.
        </p>
    </div>
</div>

<script>
(function () {
    const search = document.getElementById('alSearch');
    const actionFilter = document.getElementById('alActionFilter');
    const rows = document.querySelectorAll('[data-audit-row]');
    const noResults = document.getElementById('alNoResults');

    // Remove duplicate action options from the filter.
    const seen = new Set();

    Array.from(actionFilter.options).forEach(function (option, index) {
        if (index === 0) return;

        const value = option.value.trim().toLowerCase();

        if (seen.has(value)) {
            option.remove();
        } else {
            seen.add(value);
        }
    });

    function filterLogs() {
        const query = search.value.toLowerCase().trim();
        const selectedAction = actionFilter.value.toLowerCase();
        let visible = 0;

        rows.forEach(function (row) {
            const text = row.dataset.search || '';
            const action = row.dataset.action || '';

            const matchesText = !query || text.includes(query);
            const matchesAction = !selectedAction || action === selectedAction;
            const show = matchesText && matchesAction;

            row.style.display = show ? '' : 'none';

            if (show) visible++;
        });

        noResults.hidden = visible > 0 || rows.length === 0;
    }

    search.addEventListener('input', filterLogs);
    actionFilter.addEventListener('change', filterLogs);
})();
</script>
@endsection
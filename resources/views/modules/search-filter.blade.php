@extends('layouts.app')

@section('content')
@php
    $incidents = $incidents ?? $reports ?? collect();

    if (is_array($incidents)) {
        $incidents = collect($incidents);
    }

    $searchText = request('search', '');
    $statusFilter = request('status', '');
    $priorityFilter = request('priority', '');

    $allIncidents = $incidents;

    $incidents = $incidents->filter(function ($incident) use ($searchText, $statusFilter, $priorityFilter) {
        $title = data_get($incident, 'title', data_get($incident, 'incident_title', ''));
        $description = data_get($incident, 'description', '');
        $location = data_get($incident, 'location', data_get($incident, 'campus_location', ''));

        $searchMatches = $searchText === '' ||
            str_contains(strtolower((string) $title), strtolower($searchText)) ||
            str_contains(strtolower((string) $description), strtolower($searchText)) ||
            str_contains(strtolower(is_string($location) ? $location : data_get($location, 'name', '')), strtolower($searchText));

        $status = strtolower((string) data_get($incident, 'status', 'pending'));
        $priority = strtolower((string) data_get($incident, 'priority', data_get($incident, 'severity', 'medium')));

        $statusMatches = $statusFilter === '' || $status === strtolower($statusFilter);
        $priorityMatches = $priorityFilter === '' || $priority === strtolower($priorityFilter);

        return $searchMatches && $statusMatches && $priorityMatches;
    });

    $totalCount = $allIncidents->count();
    $criticalCount = $allIncidents->filter(fn($i) => in_array(strtolower((string) data_get($i, 'priority', data_get($i, 'severity', ''))), ['critical', 'high']))->count();
    $pendingCount = $allIncidents->filter(fn($i) => in_array(strtolower((string) data_get($i, 'status', 'pending')), ['pending', 'open']))->count();
    $resolvedCount = $allIncidents->filter(fn($i) => in_array(strtolower((string) data_get($i, 'status', '')), ['resolved', 'closed', 'completed']))->count();
@endphp

<style>
.search-page {
    --navy: #102746;
    --blue: #1769aa;
    --muted: #718096;
    color: #172b46;
    padding: 28px;
    font-family: Inter, "Segoe UI", Arial, sans-serif;
}
.search-page * { box-sizing: border-box; }
.search-page .page-heading {
    display:flex; justify-content:space-between; align-items:flex-start;
    gap:20px; flex-wrap:wrap; margin-bottom:28px;
}
.search-page .eyebrow {
    color:#1672b8; font-size:13px; font-weight:800;
    letter-spacing:1.6px; text-transform:uppercase; margin-bottom:10px;
}
.search-page h1 {
    font-size:clamp(30px, 3vw, 42px); line-height:1.2;
    margin:0 0 12px; font-weight:850; color:var(--navy);
}
.search-page .subtitle {
    color:var(--muted); font-size:16px; line-height:1.7; margin:0;
}
.search-page .security-chip {
    display:inline-flex; align-items:center; gap:9px;
    background:#e9f7ef; color:#167344; border-radius:30px;
    padding:12px 17px; font-weight:750; font-size:13px;
}
.search-page .search-stats {
    display:grid; grid-template-columns:repeat(4,minmax(0,1fr));
    gap:18px; margin-bottom:26px;
}
.search-page .stat-card {
    background:#fff; border:1px solid #e6edf5; border-radius:17px;
    padding:23px; box-shadow:0 5px 20px rgba(16,39,70,.045);
    min-width:0;
}
.search-page .stat-top {
    display:flex; justify-content:space-between; align-items:center; gap:10px;
}
.search-page .stat-label { font-size:14px; color:#65758b; font-weight:650; }
.search-page .stat-number {
    font-size:34px; font-weight:850; color:var(--navy);
    margin-top:17px; line-height:1.2;
}
.search-page .stat-icon {
    display:grid; place-items:center; width:45px; height:45px;
    border-radius:13px; font-size:21px; background:#edf5ff;
}
.search-page .stat-note { font-size:12px; color:#8794a6; margin-top:9px; }
.search-page .panel {
    background:#fff; border:1px solid #e4ebf3; border-radius:18px;
    box-shadow:0 7px 25px rgba(16,39,70,.045); overflow:hidden;
    margin-bottom:24px;
}
.search-page .panel-heading {
    padding:24px 26px; border-bottom:1px solid #edf1f6;
    display:flex; justify-content:space-between; align-items:center;
    gap:15px; flex-wrap:wrap;
}
.search-page .panel-heading h2 {
    font-size:21px; font-weight:800; margin:0 0 7px; color:var(--navy);
}
.search-page .panel-heading p { margin:0; color:var(--muted); font-size:14px; }
.search-page .filter-body { padding:25px 26px; }
.search-page .filter-grid {
    display:grid; grid-template-columns:minmax(220px,2fr) 1fr 1fr auto;
    gap:15px; align-items:end;
}
.search-page .field label {
    display:block; font-size:13px; font-weight:750;
    color:#354963; margin-bottom:9px;
}
.search-page .field input,
.search-page .field select {
    width:100%; min-height:49px; border:1px solid #d8e2ee;
    background:#fff; border-radius:10px; padding:12px 14px;
    color:#243a54; font-size:14px; outline:none;
}
.search-page .field input:focus,
.search-page .field select:focus {
    border-color:#3182ce; box-shadow:0 0 0 3px rgba(49,130,206,.12);
}
.search-page .btn {
    min-height:49px; border:0; border-radius:10px; padding:0 21px;
    display:inline-flex; justify-content:center; align-items:center;
    text-decoration:none; font-size:14px; font-weight:800; cursor:pointer;
    transition:.2s;
}
.search-page .btn-primary { background:#1769aa; color:#fff; }
.search-page .btn-primary:hover { background:#10558d; }
.search-page .btn-light { background:#edf2f7; color:#354963; }
.search-page .btn-light:hover { background:#e1e8f0; }
.search-page .results-count { font-size:14px; color:#65758b; font-weight:650; }
.search-page .table-wrap { width:100%; overflow-x:auto; }
.search-page table { width:100%; border-collapse:collapse; min-width:850px; }
.search-page thead { background:#f6f9fc; }
.search-page th {
    padding:17px 20px; text-align:left; white-space:nowrap;
    font-size:12px; letter-spacing:.6px; text-transform:uppercase;
    color:#64758b; font-weight:800; border-bottom:1px solid #e7edf4;
}
.search-page td {
    padding:19px 20px; border-bottom:1px solid #edf1f6;
    color:#40536b; font-size:14px; vertical-align:middle;
}
.search-page tbody tr:hover { background:#f8fbff; }
.search-page tbody tr:last-child td { border-bottom:0; }
.search-page .incident-title { color:#172b46; font-weight:800; font-size:14px; }
.search-page .incident-id { color:#1769aa; font-weight:800; }
.search-page .location-text { color:#66768b; }
.search-page .pill {
    display:inline-flex; align-items:center; border-radius:30px;
    padding:7px 11px; font-size:11px; text-transform:capitalize;
    font-weight:850; white-space:nowrap;
}
.search-page .critical { background:#ffebeb; color:#c53030; }
.search-page .high { background:#fff0e1; color:#b45309; }
.search-page .medium { background:#fff8d9; color:#946c00; }
.search-page .low { background:#e6f7ed; color:#167344; }
.search-page .pending { background:#fff2d9; color:#986500; }
.search-page .open { background:#e9f2ff; color:#245cb5; }
.search-page .resolved,
.search-page .closed,
.search-page .completed { background:#e3f7eb; color:#177245; }
.search-page .in-progress { background:#e7f2ff; color:#245cb5; }
.search-page .empty-state { text-align:center; padding:55px 20px; }
.search-page .empty-state .empty-icon {
    width:65px; height:65px; margin:0 auto 16px; display:grid;
    place-items:center; border-radius:18px; background:#edf5ff; font-size:27px;
}
.search-page .empty-state h3 { font-size:19px; margin:0 0 8px; color:var(--navy); }
.search-page .empty-state p { margin:0; color:var(--muted); font-size:14px; }
.search-page .table-footer {
    display:flex; justify-content:space-between; align-items:center;
    gap:12px; flex-wrap:wrap; padding:18px 25px;
    border-top:1px solid #edf1f6; color:#718096; font-size:13px;
}
.search-page .help-strip {
    display:flex; gap:15px; align-items:center; padding:21px 24px;
    background:#edf6ff; border:1px solid #d7eaff; border-radius:15px;
}
.search-page .help-icon { font-size:25px; }
.search-page .help-strip strong { display:block; color:#163d69; margin-bottom:5px; }
.search-page .help-strip span { color:#526d8b; font-size:13px; line-height:1.6; }
@media(max-width:1100px) {
    .search-page .search-stats { grid-template-columns:repeat(2,minmax(0,1fr)); }
    .search-page .filter-grid { grid-template-columns:repeat(2,minmax(0,1fr)); }
}
@media(max-width:650px) {
    .search-page { padding:16px; }
    .search-page .search-stats { grid-template-columns:1fr 1fr; gap:10px; }
    .search-page .stat-card { padding:15px; }
    .search-page .stat-number { font-size:27px; }
    .search-page .filter-grid { grid-template-columns:1fr; }
    .search-page .panel-heading, .search-page .filter-body { padding:19px; }
    .search-page .page-heading { margin-bottom:20px; }
}
</style>

<div class="search-page">
    <div class="page-heading">
        <div>
            <div class="eyebrow">CampusGuard / Incident Management</div>
            <h1>Search &amp; Filter Incidents</h1>
            <p class="subtitle">Find campus incidents quickly by title, description, location, priority or current status.</p>
        </div>
        <div class="security-chip">🛡️ Secure Incident Search</div>
    </div>

    <div class="search-stats">
        <div class="stat-card">
            <div class="stat-top"><span class="stat-label">Total Incidents</span><span class="stat-icon">📋</span></div>
            <div class="stat-number">{{ $totalCount }}</div>
            <div class="stat-note">All records currently available</div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="stat-label">Critical / High</span><span class="stat-icon" style="background:#fff0ed">🚨</span></div>
            <div class="stat-number">{{ $criticalCount }}</div>
            <div class="stat-note">Incidents requiring close attention</div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="stat-label">Pending / Open</span><span class="stat-icon" style="background:#fff8e8">⏳</span></div>
            <div class="stat-number">{{ $pendingCount }}</div>
            <div class="stat-note">Awaiting action or response</div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="stat-label">Resolved</span><span class="stat-icon" style="background:#e9f8ef">✓</span></div>
            <div class="stat-number">{{ $resolvedCount }}</div>
            <div class="stat-note">Resolved or completed incidents</div>
        </div>
    </div>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <h2>🔎 Find an Incident</h2>
                <p>Use one or more filters to narrow down the results.</p>
            </div>
        </div>

        <form method="GET" action="{{ url('/search-filter') }}" class="filter-body">
            <div class="filter-grid">
                <div class="field">
                    <label for="incident-search">Search by keyword</label>
                    <input id="incident-search" type="search" name="search"
                           value="{{ request('search') }}"
                           placeholder="Enter title, description or location...">
                </div>
                <div class="field">
                    <label for="incident-priority">Priority</label>
                    <select id="incident-priority" name="priority">
                        <option value="">All priorities</option>
                        @foreach(['critical' => 'Critical', 'high' => 'High', 'medium' => 'Medium', 'low' => 'Low'] as $value => $label)
                            <option value="{{ $value }}" @selected(request('priority') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="incident-status">Status</label>
                    <select id="incident-status" name="status">
                        <option value="">All statuses</option>
                        @foreach(['pending' => 'Pending', 'open' => 'Open', 'in-progress' => 'In Progress', 'resolved' => 'Resolved', 'closed' => 'Closed', 'completed' => 'Completed'] as $value => $label)
                            <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="display:flex;gap:9px;flex-wrap:wrap">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ url('/search-filter') }}" class="btn btn-light">Reset</a>
                </div>
            </div>
        </form>
    </section>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <h2>Incident Search Results</h2>
                <p>Review matching incidents and their current response status.</p>
            </div>
            <div class="results-count">Showing {{ $incidents->count() }} result(s)</div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Incident ID</th>
                        <th>Incident Details</th>
                        <th>Campus Location</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Reported Date</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($incidents as $incident)
                    @php
                        $id = data_get($incident, 'id', '—');
                        $title = data_get($incident, 'title', data_get($incident, 'incident_title', 'Untitled Incident'));
                        $location = data_get($incident, 'location', data_get($incident, 'campus_location', 'Not specified'));
                        if (!is_string($location)) {
                            $location = data_get($location, 'name', 'Not specified');
                        }
                        $priority = strtolower((string) data_get($incident, 'priority', data_get($incident, 'severity', 'medium')));
                        $status = strtolower(str_replace(' ', '-', (string) data_get($incident, 'status', 'pending')));
                        $date = data_get($incident, 'created_at', data_get($incident, 'incident_date'));
                    @endphp
                    <tr>
                        <td><span class="incident-id">#{{ $id }}</span></td>
                        <td>
                            <div class="incident-title">{{ $title }}</div>
                            @if(data_get($incident, 'description'))
                                <div style="margin-top:6px;color:#8390a2;font-size:12px">
                                    {{ \Illuminate\Support\Str::limit(data_get($incident, 'description'), 75) }}
                                </div>
                            @endif
                        </td>
                        <td><span class="location-text">📍 {{ $location }}</span></td>
                        <td><span class="pill {{ in_array($priority, ['critical','high','medium','low']) ? $priority : 'medium' }}">{{ $priority }}</span></td>
                        <td><span class="pill {{ in_array($status, ['pending','open','resolved','closed','completed','in-progress']) ? $status : 'pending' }}">{{ str_replace('-', ' ', $status) }}</span></td>
                        <td>{{ $date ? \Illuminate\Support\Carbon::parse($date)->format('d M Y') : '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon">🔍</div>
                                <h3>No matching incidents found</h3>
                                <p>Try a different keyword, priority or status. Reset the filters to see all available incidents.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <span>CampusGuard Incident Management System</span>
            <span>{{ $incidents->count() }} matching record(s)</span>
        </div>
    </section>

    <div class="help-strip">
        <div class="help-icon">🛡️</div>
        <div>
            <strong>Campus Safety Information</strong>
            <span>For an immediate emergency, contact your campus emergency response team or the official emergency helpline.</span>
        </div>
    </div>
</div>
@endsection
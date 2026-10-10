@extends('layouts.app')

@section('title', 'Emergency Alerts')
@section('heading', 'Emergency Alerts')

@section('content')

<div class="page-heading">
    <div>
        <h1>Emergency Alerts</h1>
        <p class="muted">
            Create and manage campus emergency notifications.
        </p>
    </div>

    <a href="{{ route('emergency-alerts.create') }}" class="btn btn-primary">
        + Create New Alert
    </a>
</div>

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert-error">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert-error">
        <strong>Please correct the following errors:</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:18px;">
        <div>
            <h3 style="margin:0;">Campus Alert Register</h3>
            <p class="muted" style="margin-top:5px;">
                All emergency alerts and announcements
            </p>
        </div>

        <span class="badge">
            Total: {{ $alerts->total() }}
        </span>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Alert Details</th>
                    <th>Severity</th>
                    <th>Location</th>
                    <th>Start Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($alerts as $alert)
                    <tr>
                        <td>#{{ $alert->id }}</td>

                        <td>
                            <strong>{{ $alert->title }}</strong>
                            <div class="muted" style="margin-top:5px;max-width:300px;">
                                {{ \Illuminate\Support\Str::limit($alert->message, 100) }}
                            </div>
                        </td>

                        <td>
                            @php
                                $severityColors = [
                                    'info' => '#2563eb',
                                    'warning' => '#d97706',
                                    'urgent' => '#ea580c',
                                    'critical' => '#dc2626',
                                ];

                                $severityColor = $severityColors[$alert->severity] ?? '#64748b';
                            @endphp

                            <span style="display:inline-block;background:{{ $severityColor }}15;color:{{ $severityColor }};padding:5px 9px;border-radius:20px;font-size:12px;font-weight:700;">
                                {{ strtoupper($alert->severity) }}
                            </span>
                        </td>

                        <td>{{ $alert->location ?: 'Campus-wide' }}</td>

                        <td>
                            {{ $alert->starts_at ? $alert->starts_at->format('d M Y, h:i A') : 'Immediately' }}
                        </td>

                        <td>
                            @if($alert->is_active)
                                <span class="badge" style="background:#dcfce7;color:#166534;">
                                    Active
                                </span>
                            @else
                                <span class="badge" style="background:#fee2e2;color:#991b1b;">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('emergency-alerts.show', $alert->id) }}"
                               class="btn btn-secondary"
                               style="padding:7px 10px;font-size:12px;">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty" style="padding:35px 10px;text-align:center;">
                                <div style="font-size:35px;margin-bottom:10px;">🔔</div>
                                <strong>No emergency alerts found</strong>
                                <p class="muted" style="margin-top:7px;">
                                    Create your first alert to notify the campus community.
                                </p>
                                <a href="{{ route('emergency-alerts.create') }}"
                                   class="btn btn-primary"
                                   style="margin-top:12px;">
                                    + Create First Alert
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        {{ $alerts->links() }}
    </div>
</div>

@endsection
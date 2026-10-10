@extends('layouts.app')

@section('title', 'Emergency Reports')
@section('heading', 'Emergency Reports')

@section('content')

<div class="page-heading">
    <div>
        <h1>Emergency Reports</h1>
        <p class="muted">View and monitor all reported campus emergencies.</p>
    </div>

    <a href="{{ route('emergency-reports.create') }}" class="btn btn-primary">
        + Create Emergency Report
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Emergency Details</th>
                    <th>Location</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Reported By</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($reports as $report)
                    <tr>
                        <td>#{{ $report->id }}</td>

                        <td>
                            <strong>{{ $report->title }}</strong>
                            <p class="muted" style="margin-top:5px;">
                                {{ \Illuminate\Support\Str::limit($report->description, 60) }}
                            </p>
                        </td>

                        <td>{{ $report->location }}</td>

                        <td>
                            <span class="badge {{ $report->priority }}">
                                {{ str_replace('_', ' ', $report->priority) }}
                            </span>
                        </td>

                        <td>
                            <span class="badge {{ $report->status }}">
                                {{ str_replace('_', ' ', $report->status) }}
                            </span>
                        </td>

                        <td>{{ $report->user->name ?? 'Unknown' }}</td>

                        <td>{{ $report->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty">
                                <h3>No Emergency Reports Yet</h3>
                                <p>Abhi koi emergency report submit nahi hui.</p>

                                <div style="margin-top:18px;">
                                    <a href="{{ route('emergency-reports.create') }}"
                                       class="btn btn-primary">
                                        Create First Report
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
        {{ $reports->links() }}
    </div>
</div>

@endsection
@extends('layouts.app')

@section('title', 'Create Emergency Alert')
@section('heading', 'Create Emergency Alert')

@section('content')

<div class="page-heading">
    <div>
        <h1>Create Emergency Alert</h1>
        <p class="muted">
            Send an important safety notification to the campus community.
        </p>
    </div>

    <a href="{{ route('emergency-alerts.index') }}" class="btn btn-secondary">
        ← Back to Alerts
    </a>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert-error">
        <strong>Please fix the following errors:</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card" style="max-width:900px;">

    <form action="{{ route('emergency-alerts.store') }}" method="POST">
        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label for="title">Alert Title *</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    maxlength="255"
                    placeholder="e.g. Fire Emergency in Block A"
                    required
                >
            </div>

            <div class="form-group">
                <label for="severity">Severity Level *</label>
                <select id="severity" name="severity" required>
                    <option value="info" {{ old('severity', 'warning') == 'info' ? 'selected' : '' }}>
                        Information
                    </option>
                    <option value="warning" {{ old('severity', 'warning') == 'warning' ? 'selected' : '' }}>
                        Warning
                    </option>
                    <option value="urgent" {{ old('severity') == 'urgent' ? 'selected' : '' }}>
                        Urgent
                    </option>
                    <option value="critical" {{ old('severity') == 'critical' ? 'selected' : '' }}>
                        Critical Emergency
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input
                    type="text"
                    id="location"
                    name="location"
                    value="{{ old('location') }}"
                    maxlength="255"
                    placeholder="e.g. Block A, Main Gate or Campus-wide"
                >
                <small class="muted">Leave blank if the alert applies to the entire campus.</small>
            </div>

            <div class="form-group">
                <label for="is_active">Alert Status *</label>
                <select id="is_active" name="is_active" required>
                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="starts_at">Start Date & Time</label>
                <input
                    type="datetime-local"
                    id="starts_at"
                    name="starts_at"
                    value="{{ old('starts_at') }}"
                >
                <small class="muted">Leave blank if no start time is scheduled.</small>
            </div>

            <div class="form-group">
                <label for="expires_at">Expiry Date & Time</label>
                <input
                    type="datetime-local"
                    id="expires_at"
                    name="expires_at"
                    value="{{ old('expires_at') }}"
                >
                <small class="muted">Optional. Set when this alert should expire.</small>
            </div>

        </div>

        <div class="form-group" style="margin-top:20px;">
            <label for="message">Alert Message *</label>
            <textarea
                id="message"
                name="message"
                rows="6"
                maxlength="5000"
                placeholder="Explain the emergency, affected area and safety instructions..."
                required
            >{{ old('message') }}</textarea>
        </div>

        <div style="background:#fff7ed;border-left:4px solid #f97316;padding:15px;border-radius:6px;margin:20px 0;">
            <strong style="color:#9a3412;">Safety Reminder</strong>
            <p style="margin-top:6px;color:#7c2d12;font-size:13px;">
                Verify the information before publishing an alert. For an actual emergency,
                contact campus emergency responders and the relevant emergency services directly.
            </p>
        </div>

        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <button type="submit" class="btn btn-primary">
                Publish Emergency Alert
            </button>

            <a href="{{ route('emergency-alerts.index') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection
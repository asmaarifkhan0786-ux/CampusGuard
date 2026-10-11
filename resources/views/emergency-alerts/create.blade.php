@extends('layouts.app')

@section('title', 'Create Emergency Alert')
@section('heading', 'Create Emergency Alert')

@section('content')

<div class="emergency-alert-page">

    {{-- Page Header --}}
    <div class="ea-page-heading">
        <div>
            <div class="ea-eyebrow">
                CAMPUSGUARD / EMERGENCY MANAGEMENT
            </div>

            <h1>Create Emergency Alert</h1>

            <p>
                Send an important safety notification to the campus community.
                Provide accurate details before publishing.
            </p>
        </div>

        <a href="{{ route('emergency-alerts.index') }}"
           class="ea-btn ea-btn-secondary">
            <span aria-hidden="true">&larr;</span>
            Back to Alerts
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="ea-success" role="status">
            <span class="ea-message-icon">&#10003;</span>
            <div>
                <strong>Success</strong>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="ea-error" role="alert">
            <strong>Please correct the following errors:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Emergency Alert Form --}}
    <div class="ea-card">

        <div class="ea-card-header">
            <div class="ea-header-icon" aria-hidden="true">
                !
            </div>

            <div>
                <h2>Emergency Alert Details</h2>
                <p>Fields marked with * are required.</p>
            </div>
        </div>

        <form action="{{ route('emergency-alerts.store') }}"
              method="POST">
            @csrf

            <div class="ea-form-body">

                {{-- Alert Information --}}
                <div class="ea-section-title">
                    <span class="ea-section-number">01</span>
                    <div>
                        <h3>Alert Information</h3>
                        <p>Enter the alert title and severity level.</p>
                    </div>
                </div>

                <div class="ea-form-grid">

                    <div class="ea-form-group">
                        <label for="title">
                            Alert Title <span class="ea-required">*</span>
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            maxlength="255"
                            placeholder="e.g. Fire Emergency in Block A"
                            class="@error('title') ea-invalid @enderror"
                            required
                        >

                        @error('title')
                            <small class="ea-field-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="ea-form-group">
                        <label for="severity">
                            Severity Level
                            <span class="ea-required">*</span>
                        </label>

                        <select
                            id="severity"
                            name="severity"
                            class="@error('severity') ea-invalid @enderror"
                            required
                        >
                            <option value="info"
                                {{ old('severity', 'warning') == 'info' ? 'selected' : '' }}>
                                Information
                            </option>

                            <option value="warning"
                                {{ old('severity', 'warning') == 'warning' ? 'selected' : '' }}>
                                Warning
                            </option>

                            <option value="urgent"
                                {{ old('severity') == 'urgent' ? 'selected' : '' }}>
                                Urgent
                            </option>

                            <option value="critical"
                                {{ old('severity') == 'critical' ? 'selected' : '' }}>
                                Critical Emergency
                            </option>
                        </select>

                        @error('severity')
                            <small class="ea-field-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="ea-form-group">
                        <label for="location">Affected Location</label>

                        <input
                            type="text"
                            id="location"
                            name="location"
                            value="{{ old('location') }}"
                            maxlength="255"
                            placeholder="e.g. Block A, Main Gate"
                            class="@error('location') ea-invalid @enderror"
                        >

                        <small class="ea-help">
                            Leave blank if the alert applies to the entire campus.
                        </small>

                        @error('location')
                            <small class="ea-field-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="ea-form-group">
                        <label for="is_active">
                            Alert Status
                            <span class="ea-required">*</span>
                        </label>

                        <select
                            id="is_active"
                            name="is_active"
                            class="@error('is_active') ea-invalid @enderror"
                            required
                        >
                            <option value="1"
                                {{ old('is_active', '1') == '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ old('is_active') === '0' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>

                        <small class="ea-help">
                            Active alerts may be displayed to the campus community.
                        </small>

                        @error('is_active')
                            <small class="ea-field-error">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                {{-- Schedule --}}
                <div class="ea-section-title ea-section-spaced">
                    <span class="ea-section-number">02</span>
                    <div>
                        <h3>Alert Schedule</h3>
                        <p>Set when the alert should start and expire.</p>
                    </div>
                </div>

                <div class="ea-form-grid">

                    <div class="ea-form-group">
                        <label for="starts_at">Start Date &amp; Time</label>

                        <input
                            type="datetime-local"
                            id="starts_at"
                            name="starts_at"
                            value="{{ old('starts_at') }}"
                            class="@error('starts_at') ea-invalid @enderror"
                        >

                        <small class="ea-help">
                            Optional. Leave blank if no start time is scheduled.
                        </small>

                        @error('starts_at')
                            <small class="ea-field-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="ea-form-group">
                        <label for="expires_at">Expiry Date &amp; Time</label>

                        <input
                            type="datetime-local"
                            id="expires_at"
                            name="expires_at"
                            value="{{ old('expires_at') }}"
                            class="@error('expires_at') ea-invalid @enderror"
                        >

                        <small class="ea-help">
                            Optional. Choose when the alert should expire.
                        </small>

                        @error('expires_at')
                            <small class="ea-field-error">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                {{-- Alert Message --}}
                <div class="ea-section-title ea-section-spaced">
                    <span class="ea-section-number">03</span>
                    <div>
                        <h3>Safety Message</h3>
                        <p>Explain the situation and provide clear instructions.</p>
                    </div>
                </div>

                <div class="ea-form-group">
                    <label for="message">
                        Alert Message <span class="ea-required">*</span>
                    </label>

                    <textarea
                        id="message"
                        name="message"
                        rows="6"
                        maxlength="5000"
                        placeholder="Explain the emergency, affected area and safety instructions..."
                        class="@error('message') ea-invalid @enderror"
                        required
                    >{{ old('message') }}</textarea>

                    <div class="ea-textarea-footer">
                        <small class="ea-help">
                            Keep your message clear, accurate and easy to understand.
                        </small>

                        <small class="ea-help">
                            <span id="ea-message-count">{{ strlen(old('message', '')) }}</span>/5000
                        </small>
                    </div>

                    @error('message')
                        <small class="ea-field-error">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Safety Reminder --}}
                <div class="ea-safety-notice">
                    <div class="ea-safety-icon" aria-hidden="true">!</div>

                    <div>
                        <strong>Safety Reminder</strong>

                        <p>
                            Verify all information before publishing.
                            For an actual emergency, contact campus emergency
                            responders and the relevant emergency services directly.
                        </p>
                    </div>
                </div>

            </div>

            {{-- Form Actions --}}
            <div class="ea-form-footer">
                <a href="{{ route('emergency-alerts.index') }}"
                   class="ea-btn ea-btn-secondary">
                    Cancel
                </a>

                <button type="submit" class="ea-btn ea-btn-primary">
                    <span aria-hidden="true">&#10003;</span>
                    Publish Emergency Alert
                </button>
            </div>

        </form>
    </div>

</div>

{{-- Page-specific styling: does not replace the dashboard layout --}}
<style>
    .emergency-alert-page {
        --ea-navy: #061d40;
        --ea-blue: #174ea6;
        --ea-border: #e2e8f0;
        --ea-muted: #64748b;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        color: #172b4d;
        font-family: inherit;
    }

    .emergency-alert-page *,
    .emergency-alert-page *::before,
    .emergency-alert-page *::after {
        box-sizing: border-box;
    }

    .emergency-alert-page .ea-page-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 25px;
    }

    .emergency-alert-page .ea-eyebrow {
        color: #64748b;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.4px;
        margin-bottom: 9px;
    }

    .emergency-alert-page .ea-page-heading h1 {
        margin: 0 0 8px;
        color: var(--ea-navy);
        font-size: clamp(24px, 3vw, 31px);
        font-weight: 800;
        line-height: 1.25;
    }

    .emergency-alert-page .ea-page-heading p {
        color: var(--ea-muted);
        margin: 0;
        font-size: 14px;
        line-height: 1.7;
    }

    .emergency-alert-page .ea-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 9px;
        min-height: 43px;
        padding: 11px 17px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s ease, border-color .2s ease;
    }

    .emergency-alert-page .ea-btn-secondary {
        color: #334155;
        background: #fff;
        border-color: #cbd5e1;
    }

    .emergency-alert-page .ea-btn-secondary:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
    }

    .emergency-alert-page .ea-btn-primary {
        color: #fff;
        background: var(--ea-navy);
        border-color: var(--ea-navy);
    }

    .emergency-alert-page .ea-btn-primary:hover {
        background: #123568;
        border-color: #123568;
    }

    .emergency-alert-page .ea-card {
        width: 100%;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--ea-border);
        border-radius: 13px;
        box-shadow: 0 5px 20px rgba(15, 35, 70, .045);
    }

    .emergency-alert-page .ea-card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 22px 26px;
        background: #f8fafc;
        border-bottom: 1px solid var(--ea-border);
    }

    .emergency-alert-page .ea-header-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 43px;
        height: 43px;
        color: #fff;
        background: var(--ea-navy);
        border-radius: 10px;
        font-size: 24px;
        font-weight: 800;
    }

    .emergency-alert-page .ea-card-header h2 {
        margin: 0 0 5px;
        color: var(--ea-navy);
        font-size: 18px;
        font-weight: 800;
    }

    .emergency-alert-page .ea-card-header p {
        margin: 0;
        color: var(--ea-muted);
        font-size: 12px;
    }

    .emergency-alert-page .ea-form-body {
        padding: 27px;
    }

    .emergency-alert-page .ea-section-title {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        margin-bottom: 21px;
    }

    .emergency-alert-page .ea-section-number {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 34px;
        height: 34px;
        color: var(--ea-blue);
        background: #eaf1ff;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 800;
    }

    .emergency-alert-page .ea-section-title h3 {
        margin: 1px 0 5px;
        color: var(--ea-navy);
        font-size: 15px;
        font-weight: 800;
    }

    .emergency-alert-page .ea-section-title p {
        margin: 0;
        color: var(--ea-muted);
        font-size: 12px;
        line-height: 1.6;
    }

    .emergency-alert-page .ea-section-spaced {
        margin-top: 32px;
    }

    .emergency-alert-page .ea-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px 24px;
    }

    .emergency-alert-page .ea-form-group {
        display: flex;
        flex-direction: column;
        min-width: 0;
        gap: 8px;
    }

    .emergency-alert-page .ea-form-group label {
        color: #24364b;
        font-size: 13px;
        font-weight: 700;
    }

    .emergency-alert-page .ea-required {
        color: #dc2626;
    }

    .emergency-alert-page .ea-form-group input,
    .emergency-alert-page .ea-form-group select,
    .emergency-alert-page .ea-form-group textarea {
        display: block;
        width: 100%;
        max-width: 100%;
        min-height: 45px;
        padding: 11px 13px;
        color: #1e293b;
        background: #fff;
        border: 1px solid #cbd5e1;
        border-radius: 7px;
        outline: none;
        font-family: inherit;
        font-size: 13px;
        line-height: 1.5;
        transition: border-color .2s, box-shadow .2s;
    }

    .emergency-alert-page .ea-form-group textarea {
        min-height: 145px;
        resize: vertical;
    }

    .emergency-alert-page .ea-form-group input:focus,
    .emergency-alert-page .ea-form-group select:focus,
    .emergency-alert-page .ea-form-group textarea:focus {
        border-color: #356ac3;
        box-shadow: 0 0 0 3px rgba(53, 106, 195, .12);
    }

    .emergency-alert-page .ea-form-group input::placeholder,
    .emergency-alert-page .ea-form-group textarea::placeholder {
        color: #94a3b8;
    }

    .emergency-alert-page .ea-form-group .ea-invalid {
        border-color: #dc2626;
    }

    .emergency-alert-page .ea-help {
        color: var(--ea-muted);
        font-size: 11px;
        line-height: 1.6;
    }

    .emergency-alert-page .ea-field-error {
        color: #dc2626;
        font-size: 12px;
    }

    .emergency-alert-page .ea-textarea-footer {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
    }

    .emergency-alert-page .ea-safety-notice {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        margin-top: 26px;
        padding: 17px;
        background: #fff8ed;
        border: 1px solid #fed7aa;
        border-left: 4px solid #f97316;
        border-radius: 8px;
    }

    .emergency-alert-page .ea-safety-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 28px;
        height: 28px;
        color: #9a3412;
        background: #ffedd5;
        border-radius: 50%;
        font-weight: 800;
    }

    .emergency-alert-page .ea-safety-notice strong {
        display: block;
        margin: 2px 0 6px;
        color: #9a3412;
        font-size: 13px;
    }

    .emergency-alert-page .ea-safety-notice p {
        margin: 0;
        color: #7c2d12;
        font-size: 12px;
        line-height: 1.8;
    }

    .emergency-alert-page .ea-form-footer {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 11px;
        padding: 19px 27px;
        background: #f8fafc;
        border-top: 1px solid var(--ea-border);
    }

    .emergency-alert-page .ea-success,
    .emergency-alert-page .ea-error {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 20px;
        padding: 15px 17px;
        border-radius: 8px;
        font-size: 13px;
    }

    .emergency-alert-page .ea-success {
        color: #166534;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
    }

    .emergency-alert-page .ea-success p {
        margin: 5px 0 0;
        line-height: 1.6;
    }

    .emergency-alert-page .ea-message-icon {
        font-size: 18px;
        font-weight: 800;
    }

    .emergency-alert-page .ea-error {
        display: block;
        color: #991b1b;
        background: #fef2f2;
        border: 1px solid #fecaca;
    }

    .emergency-alert-page .ea-error ul {
        margin: 9px 0 0;
        padding-left: 20px;
        line-height: 1.8;
    }

    @media (max-width: 700px) {
        .emergency-alert-page .ea-page-heading {
            flex-direction: column;
            align-items: stretch;
        }

        .emergency-alert-page .ea-page-heading > a {
            align-self: flex-start;
        }

        .emergency-alert-page .ea-form-grid {
            grid-template-columns: minmax(0, 1fr);
            gap: 19px;
        }

        .emergency-alert-page .ea-card-header {
            padding: 18px;
        }

        .emergency-alert-page .ea-form-body {
            padding: 20px 17px;
        }

        .emergency-alert-page .ea-form-footer {
            padding: 17px;
        }

        .emergency-alert-page .ea-form-footer .ea-btn {
            flex: 1 1 auto;
        }
    }

    @media (max-width: 400px) {
        .emergency-alert-page .ea-form-footer {
            flex-direction: column-reverse;
        }

        .emergency-alert-page .ea-form-footer .ea-btn {
            width: 100%;
        }
    }
</style>

{{-- Message Character Counter --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const message = document.getElementById('message');
    const counter = document.getElementById('ea-message-count');

    if (message && counter) {
        const updateCounter = function () {
            counter.textContent = message.value.length;
        };

        message.addEventListener('input', updateCounter);
        updateCounter();
    }
});
</script>

@endsection
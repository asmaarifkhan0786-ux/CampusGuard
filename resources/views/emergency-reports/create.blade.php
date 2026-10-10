<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Report Emergency | CampusGuard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f6fb;
            color: #172b4d;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            flex-shrink: 0;
            background: #071d3b;
            color: white;
            padding: 25px 16px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 5px 8px 25px;
            border-bottom: 1px solid #263d5c;
        }

        .brand-icon {
            font-size: 32px;
        }

        .brand h2 {
            font-size: 16px;
            line-height: 1.5;
        }

        .brand p {
            font-size: 11px;
            color: #b9c8dc;
            margin-top: 5px;
        }

        .nav {
            margin-top: 25px;
        }

        .nav a {
            display: block;
            padding: 13px 12px;
            margin-bottom: 7px;
            border-radius: 8px;
            color: #dce6f5;
            text-decoration: none;
            font-size: 14px;
        }

        .nav a:hover,
        .nav a.active {
            background: #1769df;
            color: white;
        }

        .helpline {
            margin-top: 35px;
            padding: 15px;
            background: #102b4d;
            border-radius: 10px;
        }

        .helpline h3 {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .helpline strong {
            color: #8fc2ff;
            font-size: 14px;
        }

        .helpline p {
            margin-top: 7px;
            font-size: 12px;
            color: #bdcce0;
        }

        .main {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            min-height: 75px;
            background: white;
            padding: 18px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            box-shadow: 0 2px 12px rgba(20, 45, 80, .05);
        }

        .topbar h3 {
            font-size: 18px;
        }

        .user {
            font-size: 14px;
            color: #526681;
        }

        .content {
            max-width: 1050px;
            margin: 35px auto;
            padding: 0 25px;
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 28px;
            color: #102b50;
            margin-bottom: 9px;
        }

        .page-heading p {
            color: #718198;
            font-size: 14px;
            line-height: 1.6;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 18px;
            color: #1769df;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .form-card {
            background: white;
            border: 1px solid #e3eaf3;
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 8px 28px rgba(20, 45, 80, .06);
        }

        .card-heading {
            border-bottom: 1px solid #e8edf5;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .card-heading h2 {
            font-size: 19px;
            margin-bottom: 7px;
        }

        .card-heading p {
            color: #718198;
            font-size: 13px;
            line-height: 1.5;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 23px;
        }

        .form-group {
            min-width: 0;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 9px;
            color: #253b59;
        }

        .required {
            color: #e33445;
        }

        input,
        select,
        textarea {
            display: block;
            width: 100%;
            padding: 13px 14px;
            background: #fff;
            border: 1px solid #d6dfeb;
            border-radius: 8px;
            color: #263b57;
            font-family: inherit;
            font-size: 14px;
            outline: none;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #1769df;
            box-shadow: 0 0 0 3px rgba(23, 105, 223, .10);
        }

        select {
            cursor: pointer;
        }

        textarea {
            min-height: 150px;
            resize: vertical;
            line-height: 1.6;
        }

        .hint {
            margin-top: 7px;
            font-size: 12px;
            color: #8491a5;
            line-height: 1.5;
        }

        .error {
            color: #c62838;
            font-size: 12px;
            margin-top: 7px;
        }

        .alert {
            margin-bottom: 22px;
            padding: 14px 16px;
            border-radius: 8px;
            font-size: 14px;
            line-height: 1.7;
        }

        .alert-error {
            background: #fff0f0;
            color: #a51f2b;
            border: 1px solid #ffc9ce;
        }

        .alert-success {
            background: #eaf8ef;
            color: #176b37;
            border: 1px solid #bce7ca;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
            padding-top: 23px;
            border-top: 1px solid #e8edf5;
        }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-cancel {
            background: #edf1f7;
            color: #526681;
        }

        .btn-submit {
            background: #1769df;
            color: white;
        }

        .btn-submit:hover {
            background: #1054b8;
        }

        .footer {
            padding: 20px 25px;
            text-align: center;
            color: #8290a4;
            font-size: 12px;
        }

        @media (max-width: 800px) {
            .sidebar {
                width: 215px;
            }

            .content {
                margin-top: 25px;
                padding: 0 16px;
            }

            .form-card {
                padding: 22px;
            }
        }

        @media (max-width: 600px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                padding: 15px;
            }

            .brand {
                padding-bottom: 15px;
            }

            .nav {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 5px;
                margin-top: 15px;
            }

            .nav a {
                font-size: 12px;
                margin: 0;
                padding: 11px 8px;
            }

            .helpline {
                margin-top: 15px;
            }

            .topbar {
                padding: 16px;
            }

            .content {
                margin: 25px auto;
                padding: 0 13px;
            }

            .page-heading h1 {
                font-size: 23px;
            }

            .form-card {
                padding: 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .full-width {
                grid-column: auto;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <div class="brand-icon">🛡️</div>

            <div>
                <h2>Campus Crisis &<br>Emergency Management</h2>
                <p>Safe Campus, Secure Future</p>
            </div>
        </div>

        <nav class="nav">
            <a href="{{ url('/dashboard') }}">⌂ Dashboard</a>

            <a href="{{ route('emergency-reports.create') }}"
               class="active">
                ⚠ Report Incident
            </a>

            <a href="{{ route('emergency-reports.index') }}">
                ▣ All Incidents
            </a>

            <a href="{{ url('/response-teams') }}">
                👥 Emergency Teams
            </a>

            <a href="{{ url('/emergency-alerts') }}">
                🔔 Emergency Alerts
            </a>

            <a href="{{ url('/incident-assignments') }}">
                ✓ Team Assignments
            </a>
        </nav>

        <div class="helpline">
            <h3>☎ Emergency Helpline</h3>
            <strong>+92 300 1234567</strong>
            <p>24/7 Campus Support</p>
        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="main">

        <header class="topbar">
            <h3>Emergency Management</h3>

            <div class="user">
                👤 {{ auth()->user()->name ?? 'Campus User' }}
            </div>
        </header>


        <div class="content">

            <a href="{{ route('emergency-reports.index') }}"
               class="back-link">
                ← Back to Emergency Reports
            </a>

            <div class="page-heading">
                <h1>Report an Emergency</h1>

                <p>
                    Submit a campus emergency report so the relevant
                    response team can review and manage the incident.
                </p>
            </div>


            <!-- SUCCESS MESSAGE -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <!-- VALIDATION ERRORS -->
            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>Please correct the following:</strong>

                    <ul style="padding-left: 20px; margin-top: 8px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- EMERGENCY REPORT FORM -->
            <div class="form-card">

                <div class="card-heading">
                    <h2>Emergency Details</h2>

                    <p>
                        Fields marked with * are required.
                        Provide accurate information.
                    </p>
                </div>


                <form
                    action="{{ route('emergency-reports.store') }}"
                    method="POST"
                >
                    @csrf

                    <div class="form-grid">

                        <!-- TITLE -->
                        <div class="form-group full-width">
                            <label for="title">
                                Emergency Title
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="e.g. Fire Emergency in Science Block"
                                maxlength="255"
                                required
                            >

                            @error('title')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- CATEGORY -->
                        <div class="form-group">
                            <label for="crisis_category_id">
                                Crisis Category
                            </label>

                            <select
                                name="crisis_category_id"
                                id="crisis_category_id"
                            >
                                <option value="">
                                    Select category
                                </option>

                                @forelse ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ (string) old('crisis_category_id') === (string) $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>
                                @empty
                                    <option value="" disabled>
                                        No categories available
                                    </option>
                                @endforelse
                            </select>

                            @if ($categories->isEmpty())
                                <p class="hint">
                                    No active categories were found.
                                    Please add or activate categories
                                    in the Crisis Categories section.
                                </p>
                            @endif

                            @error('crisis_category_id')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- PRIORITY -->
                        <div class="form-group">
                            <label for="priority">
                                Priority
                                <span class="required">*</span>
                            </label>

                            <select
                                name="priority"
                                id="priority"
                                required
                            >
                                <option value="">Select priority</option>

                                <option value="low"
                                    {{ old('priority') === 'low' ? 'selected' : '' }}>
                                    Low
                                </option>

                                <option value="medium"
                                    {{ old('priority') === 'medium' ? 'selected' : '' }}>
                                    Medium
                                </option>

                                <option value="high"
                                    {{ old('priority') === 'high' ? 'selected' : '' }}>
                                    High
                                </option>

                                <option value="critical"
                                    {{ old('priority') === 'critical' ? 'selected' : '' }}>
                                    Critical
                                </option>
                            </select>

                            @error('priority')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- LOCATION -->
                        <div class="form-group full-width">
                            <label for="location">
                                Emergency Location
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                id="location"
                                name="location"
                                value="{{ old('location') }}"
                                placeholder="Building name, room number or campus area"
                                maxlength="255"
                                required
                            >

                            @error('location')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- CONTACT -->
                        <div class="form-group full-width">
                            <label for="contact_number">
                                Contact Number
                            </label>

                            <input
                                type="tel"
                                id="contact_number"
                                name="contact_number"
                                value="{{ old('contact_number') }}"
                                placeholder="e.g. 03001234567"
                                maxlength="30"
                            >

                            <p class="hint">
                                Enter a number the response team can use
                                to contact the person reporting the incident.
                            </p>

                            @error('contact_number')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- DESCRIPTION -->
                        <div class="form-group full-width">
                            <label for="description">
                                Emergency Description
                                <span class="required">*</span>
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                placeholder="Describe what happened, where it happened, and what assistance is required..."
                                maxlength="5000"
                                required
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>


                    <!-- BUTTONS -->
                    <div class="form-actions">

                        <a
                            href="{{ route('emergency-reports.index') }}"
                            class="btn btn-cancel"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="btn btn-submit"
                        >
                            Submit Emergency Report →
                        </button>

                    </div>

                </form>

            </div>

        </div>


        <footer class="footer">
            Campus Crisis & Emergency Management
            · Safe Campus, Secure Future
        </footer>

    </main>

</div>

</body>
</html>
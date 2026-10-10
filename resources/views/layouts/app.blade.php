<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'CampusGuard')</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f8fc;
            color: #102a43;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 285px;
            background: linear-gradient(180deg, #06234b 0%, #031936 100%);
            color: white;
            z-index: 1000;
            overflow-y: auto;
        }

        .brand {
            padding: 20px 18px;
            display: flex;
            gap: 12px;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,.10);
        }

        .brand-logo {
            width: 48px;
            height: 55px;
            border: 2px solid #fff;
            clip-path: polygon(50% 0, 92% 15%, 88% 67%, 50% 100%, 12% 67%, 8% 15%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            background: rgba(255,255,255,.08);
        }

        .brand-title {
            font-size: 17px;
            line-height: 1.25;
            font-weight: 700;
        }

        .brand-subtitle {
            color: #b9c9dd;
            font-size: 10px;
            margin-top: 5px;
        }

        .menu {
            padding: 18px 14px;
        }

        .menu-label {
            font-size: 10px;
            color: #8fa7c4;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 14px 12px 8px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 14px;
            margin-bottom: 5px;
            border-radius: 8px;
            font-size: 14px;
            color: #e5edf7;
            transition: .2s;
        }

        .menu a:hover {
            background: rgba(255,255,255,.10);
        }

        .menu a.active {
            background: linear-gradient(90deg,#0878ed,#1264d7);
            box-shadow: 0 5px 15px rgba(0,100,220,.25);
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 19px;
        }

        .helpline {
            margin: 20px 16px;
            padding: 16px;
            background: linear-gradient(135deg,#ee2338,#d7192e);
            border-radius: 9px;
        }

        .helpline strong {
            display: block;
            font-size: 14px;
            margin-bottom: 7px;
        }

        .helpline .number {
            font-size: 17px;
            font-weight: 800;
        }

        .helpline small {
            display: block;
            margin-top: 5px;
            opacity: .9;
        }

        /* MAIN */

        .main {
            margin-left: 285px;
            min-height: 100vh;
        }

        .topbar {
            height: 68px;
            background: white;
            border-bottom: 1px solid #dce5ef;
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .hamburger {
            font-size: 22px;
            color: #0a3569;
        }

        .search-box {
            flex: 1;
            max-width: 650px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            border: none;
            background: #edf4fb;
            border-radius: 22px;
            padding: 12px 18px 12px 45px;
            outline: none;
            color: #234;
        }

        .search-icon {
            position: absolute;
            left: 17px;
            top: 10px;
            font-size: 18px;
        }

        .top-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification {
            font-size: 21px;
            position: relative;
        }

        .notification span {
            position: absolute;
            top: -7px;
            right: -8px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #ef233c;
            color: white;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 1px solid #e1e7ef;
            padding-left: 18px;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #dbe8f8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .profile strong {
            display: block;
            font-size: 13px;
        }

        .profile small {
            color: #789;
        }

        .content {
            padding: 24px;
        }

        .welcome {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .welcome h1 {
            font-size: 26px;
            color: #092c59;
        }

        .welcome p {
            margin-top: 5px;
            color: #65788f;
        }

        /* BUTTONS */

        .btn {
            border: none;
            border-radius: 7px;
            padding: 10px 17px;
            display: inline-block;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
        }

        .btn-primary {
            background: #0768dc;
            color: white;
        }

        .btn-danger {
            background: #ef233c;
            color: white;
        }

        .btn-secondary {
            background: #eaf1f8;
            color: #123b67;
        }

        /* CARDS */

        .card {
            background: white;
            border: 1px solid #dce6f0;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(15,50,90,.04);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 14px;
        }

        .stat-card {
            background: white;
            border-radius: 9px;
            padding: 17px;
            border: 1px solid #d9e4ef;
            min-height: 125px;
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
        }

        .red {
            background: #ffe5e7;
            color: #ed1c35;
        }

        .orange {
            background: #fff0d7;
            color: #ef8c00;
        }

        .green {
            background: #dcf8ec;
            color: #11a66d;
        }

        .blue {
            background: #dcecff;
            color: #0869dc;
        }

        .purple {
            background: #eee3ff;
            color: #7b36d7;
        }

        .stat-title {
            color: #65778c;
            font-size: 12px;
        }

        .stat-number {
            font-size: 27px;
            font-weight: 800;
            margin-top: 6px;
            color: #102f59;
        }

        .stat-footer {
            margin-top: 8px;
            font-size: 11px;
            color: #159d68;
        }

        /* DASHBOARD GRID */

        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0,2fr) minmax(300px,1fr);
            gap: 15px;
            margin-top: 15px;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .section-title h3 {
            color: #11365f;
            font-size: 16px;
        }

        .section-title a {
            color: #0869dc;
            font-size: 12px;
        }

        /* CHART */

        .chart {
            height: 245px;
            position: relative;
            background:
                linear-gradient(#e9f0f7 1px, transparent 1px);
            background-size: 100% 48px;
            border-bottom: 1px solid #dce5ee;
            overflow: hidden;
        }

        .chart-line {
            position: absolute;
            left: 0;
            right: 0;
            height: 100%;
        }

        .chart-line svg {
            width: 100%;
            height: 100%;
        }

        .chart-legend {
            display: flex;
            gap: 20px;
            margin-bottom: 10px;
            font-size: 11px;
            color: #60748c;
        }

        .dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 4px;
        }

        .dot-red { background:#ef233c; }
        .dot-blue { background:#0878ed; }
        .dot-orange { background:#f3a000; }
        .dot-purple { background:#7c3aed; }

        /* ALERTS */

        .alert-item {
            display: flex;
            gap: 12px;
            padding: 13px 0;
            border-bottom: 1px solid #edf1f5;
        }

        .alert-item:last-child {
            border-bottom: none;
        }

        .alert-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .alert-item strong {
            display: block;
            font-size: 13px;
            color: #17395f;
        }

        .alert-item small {
            display: block;
            margin-top: 4px;
            color: #8291a4;
        }

        /* QUICK ACTIONS */

        .quick-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .quick-action {
            border: 1px solid #e0e8f1;
            border-radius: 8px;
            padding: 18px 10px;
            text-align: center;
            background: #f9fbfd;
        }

        .quick-action-icon {
            font-size: 25px;
            margin-bottom: 7px;
        }

        .quick-action span {
            font-size: 12px;
            color: #17395f;
            font-weight: 600;
        }

        /* TABLE */

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f4f8fc;
            color: #49647f;
            text-align: left;
            font-size: 11px;
            padding: 11px;
        }

        td {
            padding: 11px;
            border-bottom: 1px solid #edf1f5;
            font-size: 12px;
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 15px;
            background: #e8f1fc;
            color: #1264bb;
            font-size: 10px;
            font-weight: 700;
        }

        .badge-critical {
            background:#ffe0e3;
            color:#d71932;
        }

        .badge-high {
            background:#fff0d5;
            color:#c26b00;
        }

        .badge-resolved {
            background:#d9f7e8;
            color:#078451;
        }

        /* FORM */

        .page-heading {
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:15px;
            margin-bottom:20px;
        }

        .page-heading h1 {
            font-size:24px;
            color:#092c59;
        }

        .muted {
            color:#74869a;
            font-size:13px;
        }

        .form-grid {
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:18px;
        }

        .form-group {
            margin-bottom:18px;
        }

        .form-group label {
            display:block;
            font-size:13px;
            font-weight:700;
            margin-bottom:7px;
            color:#183d66;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width:100%;
            padding:11px 12px;
            border:1px solid #ccd8e5;
            border-radius:7px;
            outline:none;
            background:#fff;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color:#1478df;
            box-shadow:0 0 0 3px rgba(20,120,223,.10);
        }

        .alert-success,
        .alert-error {
            padding:12px 15px;
            border-radius:7px;
            margin-bottom:15px;
        }

        .alert-success {
            background:#dcf8e9;
            color:#087044;
        }

        .alert-error {
            background:#ffe4e6;
            color:#a9142b;
        }

        .empty {
            text-align:center;
            padding:30px;
            color:#789;
        }

        /* MOBILE */

        @media(max-width:1100px) {
            .stats-grid {
                grid-template-columns:1fr 1fr;
            }

            .sidebar {
                width:230px;
            }

            .main {
                margin-left:230px;
            }
        }

        @media(max-width:800px) {
            .sidebar {
                position:relative;
                width:100%;
                height:auto;
            }

            .main {
                margin-left:0;
            }

            .menu {
                display:grid;
                grid-template-columns:1fr 1fr;
            }

            .helpline {
                display:none;
            }

            .dashboard-grid,
            .stats-grid,
            .form-grid {
                grid-template-columns:1fr;
            }

            .topbar {
                padding:0 15px;
            }

            .profile-name {
                display:none;
            }

            .content {
                padding:15px;
            }
        }

        @media(max-width:500px) {
            .menu {
                grid-template-columns:1fr;
            }

            .welcome,
            .page-heading {
                align-items:flex-start;
                flex-direction:column;
            }

            .stats-grid {
                grid-template-columns:1fr;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<aside class="sidebar">

    <div class="brand">
        <div class="brand-logo">🛡</div>

        <div>
            <div class="brand-title">
                Campus Crisis &<br>
                Emergency Management
            </div>

            <div class="brand-subtitle">
                Safe Campus, Secure Future
            </div>
        </div>
    </div>

    <nav class="menu">

        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="menu-icon">⌂</span>
            Dashboard
        </a>

        <a href="{{ route('emergency-reports.create') }}">
            <span class="menu-icon">⚠</span>
            Report Incident
        </a>

        <a href="{{ route('emergency-reports.index') }}">
            <span class="menu-icon">▣</span>
            All Incidents
        </a>

        <a href="{{ route('response-teams.index') }}">
            <span class="menu-icon">👥</span>
            Emergency Teams
        </a>

        <a href="{{ route('emergency-alerts.index') }}">
            <span class="menu-icon">🔔</span>
            Emergency Alerts
        </a>

        <a href="{{ route('incident-assignments.index') }}">
            <span class="menu-icon">✓</span>
            Team Assignments
        </a>

        <a href="#">
            <span class="menu-icon">⌖</span>
            Campus Locations
        </a>

        <a href="#">
            <span class="menu-icon">▣</span>
            Resources & Equipment
        </a>

        <a href="#">
            <span class="menu-icon">♟</span>
            Users & Roles
        </a>

        <a href="#">
            <span class="menu-icon">▥</span>
            Reports & Analytics
        </a>

        <a href="#">
            <span class="menu-icon">▤</span>
            Audit Logs
        </a>

        <a href="#">
            <span class="menu-icon">⌕</span>
            Search & Filter
        </a>

        <a href="#">
            <span class="menu-icon">▰</span>
            Map & Navigation
        </a>

        <a href="#">
            <span class="menu-icon">⚙</span>
            Settings
        </a>

    </nav>

    <div class="helpline">
        <strong>☎ Emergency Helpline</strong>
        <div class="number">+92 300 1234567</div>
        <small>24/7 Campus Support</small>
    </div>

</aside>

<main class="main">

    <header class="topbar">

        <div class="hamburger">☰</div>

        <div class="search-box">
            <span class="search-icon">⌕</span>
            <input
                type="text"
                placeholder="Search incidents, buildings, teams, users..."
            >
        </div>

        <div class="top-actions">

            <div class="notification">
                🔔
                <span>3</span>
            </div>

            <div class="profile">
                <div class="profile-avatar">👤</div>

                <div class="profile-name">
                    <strong>Asma Khan</strong>
                    <small>Admin</small>
                </div>

                <span>⌄</span>
            </div>

        </div>

    </header>

    <section class="content">

        @yield('content')

    </section>

</main>

@stack('scripts')

</body>
</html>
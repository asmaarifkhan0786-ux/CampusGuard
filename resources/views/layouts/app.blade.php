<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'CampusGuard')</title>

    {{-- Same fonts/icons as the main Dashboard --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >

    {{-- ORIGINAL DASHBOARD CSS --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    @stack('styles')
</head>

<body>

<div class="app">

    {{-- ================= SIDEBAR ================= --}}
    <aside class="sidebar" id="sidebar">

        <a class="brand" href="{{ route('dashboard') }}">

            <span class="shield">
                <i class="fa-solid fa-shield-halved"></i>
            </span>

            <span>
                <b>
                    Campus Crisis &amp;<br>
                    Emergency Management
                </b>

                <small>
                    Safe Campus, Secure Future
                </small>
            </span>

        </a>


        <nav>

            {{-- DASHBOARD --}}
            <a
                class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
                href="{{ route('dashboard') }}"
            >
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>


            {{-- REPORT INCIDENT --}}
            <a
                class="{{ request()->routeIs('emergency-reports.create') ? 'active' : '' }}"
                href="{{ route('emergency-reports.create') }}"
            >
                <i class="fa-solid fa-triangle-exclamation"></i>
                Report Incident
            </a>


            {{-- ALL INCIDENTS --}}
            <a
                class="{{ request()->routeIs('emergency-reports.index') ? 'active' : '' }}"
                href="{{ route('emergency-reports.index') }}"
            >
                <i class="fa-solid fa-clipboard-list"></i>
                All Incidents
            </a>


            {{-- EMERGENCY TEAMS --}}
            <a
                class="{{ request()->routeIs('response-teams.*') ? 'active' : '' }}"
                href="{{ route('response-teams.index') }}"
            >
                <i class="fa-solid fa-people-group"></i>
                Emergency Teams
            </a>


            {{-- EMERGENCY ALERTS --}}
            <a
                class="{{ request()->routeIs('emergency-alerts.*') ? 'active' : '' }}"
                href="{{ route('emergency-alerts.index') }}"
            >
                <i class="fa-solid fa-bell"></i>
                Emergency Alerts
            </a>


            {{-- TEAM ASSIGNMENTS --}}
            <a
                class="{{ request()->routeIs('incident-assignments.*') ? 'active' : '' }}"
                href="{{ route('incident-assignments.index') }}"
            >
                <i class="fa-solid fa-check"></i>
                Team Assignments
            </a>


            {{-- CAMPUS LOCATIONS --}}
            <a href="{{ url('/campus-locations') }}">
                <i class="fa-solid fa-location-dot"></i>
                Campus Locations
            </a>


            {{-- RESOURCES --}}
            <a href="{{ url('/resources-equipment') }}">
                <i class="fa-solid fa-kit-medical"></i>
                Resources &amp; Equipment
            </a>


            {{-- USERS --}}
            <a href="{{ url('/users-roles') }}">
                <i class="fa-solid fa-user-shield"></i>
                Users &amp; Roles
            </a>


            {{-- REPORTS --}}
            <a href="{{ url('/reports-analytics') }}">
                <i class="fa-solid fa-chart-column"></i>
                Reports &amp; Analytics
            </a>


            {{-- AUDIT --}}
            <a href="{{ url('/audit-logs') }}">
                <i class="fa-solid fa-file-lines"></i>
                Audit Logs
            </a>


            {{-- SEARCH --}}
            <a href="{{ url('/search-filter') }}">
                <i class="fa-solid fa-magnifying-glass"></i>
                Search &amp; Filter
            </a>


            {{-- MAP --}}
            <a href="{{ url('/map-navigation') }}">
                <i class="fa-solid fa-map-location-dot"></i>
                Map &amp; Navigation
            </a>


            {{-- SETTINGS --}}
            <a
                class="{{ request()->routeIs('settings') ? 'active' : '' }}"
                href="{{ route('settings') }}"
            >
                <i class="fa-solid fa-gear"></i>
                Settings
            </a>

        </nav>


        {{-- ================= SIDEBAR BOTTOM ================= --}}
        <div class="side-bottom">

            <a
                class="helpline"
                href="tel:+923001234567"
            >

                <i class="fa-solid fa-phone-volume"></i>

                <span>
                    <b>Emergency Helpline</b>
                    <strong>+92 300 1234567</strong>
                    <small>24/7 Support</small>
                </span>

            </a>


            <div class="promo">

                <b>
                    Together for a<br>
                    Safer Campus
                </b>

                <img
                    src="https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=650&q=85"
                    alt="University campus"
                >

                <small>
                    Safety is Everyone's Responsibility
                </small>

            </div>

        </div>

    </aside>


    {{-- ================= MAIN ================= --}}
    <main class="main">


        {{-- ================= TOP BAR ================= --}}
        <header class="topbar">

            <button
                id="menuToggle"
                class="plain"
                aria-label="Open menu"
                type="button"
            >
                <i class="fa-solid fa-bars"></i>
            </button>


            <label class="search">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    id="globalSearch"
                    type="text"
                    placeholder="Search incidents, buildings, teams, users..."
                >

                <kbd>Ctrl K</kbd>

            </label>


            <div class="actions">

                {{-- Notifications --}}
                <button
                    id="notifications"
                    class="plain bell"
                    type="button"
                    aria-label="Notifications"
                >
                    <i class="fa-regular fa-bell"></i>
                    <em>3</em>
                </button>


                {{-- Profile --}}
                <button
                    id="profileButton"
                    class="profile"
                    type="button"
                >

                    <img
                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=100&h=100&q=85"
                        alt="Asma Arif"
                    >

                    <span>
                        <b>{{ auth()->user()->name ?? 'Asma Arif' }}</b>
                        <small>Admin</small>
                    </span>

                    <i class="fa-solid fa-chevron-down"></i>

                </button>


                {{-- Profile Dropdown --}}
                <div
                    id="profileMenu"
                    class="profile-menu"
                >

                    <a href="{{ route('profile.edit') }}">
                        My Profile
                    </a>

                    <a href="{{ route('settings') }}">
                        Settings
                    </a>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        style="margin:0;"
                    >
                        @csrf

                        <button
                            type="submit"
                            style="
                                width:100%;
                                background:none;
                                border:none;
                                padding:10px 15px;
                                text-align:left;
                                cursor:pointer;
                                font:inherit;
                                color:inherit;
                            "
                        >
                            Logout
                        </button>

                    </form>

                </div>

            </div>

        </header>


        {{-- ================= PAGE CONTENT ================= --}}
        <div class="content">

            @yield('content')

        </div>

    </main>

</div>


{{-- Small layout JavaScript --}}
<script>

    // Sidebar mobile toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');

    if (menuToggle && sidebar) {

        menuToggle.addEventListener('click', function () {
            sidebar.classList.toggle('open');
        });

    }


    // Profile dropdown
    const profileButton = document.getElementById('profileButton');
    const profileMenu = document.getElementById('profileMenu');

    if (profileButton && profileMenu) {

        profileButton.addEventListener('click', function (event) {

            event.stopPropagation();

            profileMenu.classList.toggle('show');

        });


        document.addEventListener('click', function () {

            profileMenu.classList.remove('show');

        });

    }


    // Ctrl + K search
    document.addEventListener('keydown', function (event) {

        if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 'k') {

            event.preventDefault();

            const search = document.getElementById('globalSearch');

            if (search) {
                search.focus();
            }

        }

    });

</script>

@stack('scripts')

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campus Crisis & Emergency Management</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
<div class="app">

    <aside class="sidebar" id="sidebar">
        <a class="brand" href="{{ url('/dashboard') }}">
            <span class="shield"><i class="fa-solid fa-shield-halved"></i></span>
            <span>
                <b>Campus Crisis &amp;<br>Emergency Management</b>
                <small>Safe Campus, Secure Future</small>
            </span>
        </a>

        <nav>
            <a class="active" href="{{ url('/dashboard') }}"><i class="fa-solid fa-house"></i>Dashboard</a>
            <a href="{{ url('/report-incident') }}"><i class="fa-solid fa-triangle-exclamation"></i>Report Incident</a>
            <a href="{{ url('/incidents') }}"><i class="fa-solid fa-clipboard-list"></i>All Incidents</a>
            <a href="{{ url('/emergency-teams') }}"><i class="fa-solid fa-people-group"></i>Emergency Teams</a>
            <a href="{{ url('/campus-locations') }}"><i class="fa-solid fa-location-dot"></i>Campus Locations</a>
            <a href="{{ url('/resources-equipment') }}"><i class="fa-solid fa-kit-medical"></i>Resources &amp; Equipment</a>
            <a href="{{ url('/users-roles') }}"><i class="fa-solid fa-user-shield"></i>Users &amp; Roles</a>
            <a href="{{ url('/reports-analytics') }}"><i class="fa-solid fa-chart-column"></i>Reports &amp; Analytics</a>
            <a href="{{ url('/audit-logs') }}"><i class="fa-solid fa-file-lines"></i>Audit Logs</a>
            <a href="{{ url('/search-filter') }}"><i class="fa-solid fa-magnifying-glass"></i>Search &amp; Filter</a>
            <a href="{{ url('/map-navigation') }}"><i class="fa-solid fa-map-location-dot"></i>Map &amp; Navigation</a>
            <a href="{{ url('/settings') }}"><i class="fa-solid fa-gear"></i>Settings</a>
        </nav>

        <div class="side-bottom">
            <a class="helpline" href="tel:+923001234567">
                <i class="fa-solid fa-phone-volume"></i>
                <span>
                    <b>Emergency Helpline</b>
                    <strong>+92 300 1234567</strong>
                    <small>24/7 Support</small>
                </span>
            </a>

            <div class="promo">
                <b>Together for a<br>Safer Campus</b>
                <img src="https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=650&q=85" alt="University campus">
                <small>Safety is Everyone's Responsibility</small>
            </div>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <button id="menuToggle" class="plain" aria-label="Open menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <label class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input id="globalSearch" placeholder="Search incidents, buildings, teams, users...">
                <kbd>Ctrl K</kbd>
            </label>

            <div class="actions">
                <button id="notifications" class="plain bell" aria-label="Notifications">
                    <i class="fa-regular fa-bell"></i><em>3</em>
                </button>

                <button id="profileButton" class="profile">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=100&h=100&q=85" alt="Asma Arif">
                    <span><b>Asma Arif</b><small>Admin</small></span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>

                <div id="profileMenu" class="profile-menu">
                    <a href="{{ url('/profile') }}">My Profile</a>
                    <a href="{{ url('/settings') }}">Settings</a>
                    <a href="{{ url('/logout') }}">Logout</a>
                </div>
            </div>
        </header>

        <div class="content">
            <section class="welcome">
                <div>
                    <h1>Good Morning, Asma! 👋</h1>
                    <p>Here's what's happening at your campus today.</p>
                </div>

                <div class="weather">
                    <div>
                        <i class="fa-regular fa-calendar-days"></i>
                        <span><b id="currentDate"></b><small id="currentTime"></small></span>
                    </div>
                    <div>
                        <i class="fa-solid fa-sun sun"></i>
                        <span><b>28°C</b><small>Clear</small></span>
                    </div>
                </div>
            </section>

            <section class="stats">
                <article class="stat red">
                    <i class="fa-solid fa-tower-broadcast big-icon"></i>
                    <div><span>Total Incidents</span><strong>28</strong><small><b>↑ 12%</b> vs. last 7 days</small></div>
                    <svg class="spark" viewBox="0 0 100 40"><polyline points="2,35 18,23 30,28 43,10 57,25 72,7 85,15 98,2"/></svg>
                </article>

                <article class="stat orange">
                    <i class="fa-solid fa-fire-flame-curved big-icon"></i>
                    <div><span>Active Emergencies</span><strong>7</strong><small><b>↑ 3%</b> in progress</small></div>
                    <svg class="spark" viewBox="0 0 100 40"><polyline points="2,34 18,25 30,29 43,12 57,23 72,8 85,16 98,2"/></svg>
                </article>

                <article class="stat green">
                    <i class="fa-solid fa-check big-icon"></i>
                    <div><span>Resolved Cases</span><strong>21</strong><small><b>↑ 18%</b> this week</small></div>
                    <svg class="spark" viewBox="0 0 100 40"><polyline points="2,34 18,28 30,30 43,12 57,23 72,8 85,16 98,2"/></svg>
                </article>

                <article class="stat blue">
                    <i class="fa-solid fa-people-group big-icon"></i>
                    <div><span>Available Teams</span><strong>4</strong><small>of 5 teams</small></div>
                    <svg class="spark" viewBox="0 0 100 40"><polyline points="2,34 18,25 30,29 43,12 57,23 72,8 85,16 98,2"/></svg>
                </article>
            </section>

            <section class="analytics">
                <article class="panel">
                    <div class="heading">
                        <h2><i class="fa-solid fa-chart-column"></i> Incident Overview</h2>
                        <select id="chartPeriod">
                            <option value="7">Last 7 Days</option>
                            <option value="5">Last 5 Days</option>
                        </select>
                    </div>
                    <div class="legend">
                        <span>🔴 Fire</span><span>🔵 Medical</span><span>🟠 Security</span>
                        <span>🟣 Lab Accident</span><span>🟢 Other</span>
                    </div>
                    <div class="line-wrap"><canvas id="incidentChart"></canvas></div>
                </article>

                <article class="panel">
                    <div class="heading">
                        <h2>Incidents by Type</h2>
                        <button class="text-link" data-go="/incidents">View All ↗</button>
                    </div>
                    <div class="type-layout">
                        <div class="donut">
                            <canvas id="typeChart"></canvas>
                            <div><b>28</b><small>Total</small></div>
                        </div>
                        <div class="type-legend">
                            <span><i class="dot red-dot"></i>Fire <b>7 <small>(25%)</small></b></span>
                            <span><i class="dot blue-dot"></i>Medical <b>6 <small>(21%)</small></b></span>
                            <span><i class="dot orange-dot"></i>Security <b>5 <small>(18%)</small></b></span>
                            <span><i class="dot purple-dot"></i>Lab Accident <b>4 <small>(14%)</small></b></span>
                            <span><i class="dot teal-dot"></i>Building Damage <b>3 <small>(11%)</small></b></span>
                            <span><i class="dot slate-dot"></i>Others <b>3 <small>(11%)</small></b></span>
                        </div>
                    </div>
                </article>
            </section>

            <section class="lower">
                <div class="left">
                    <article class="panel map-panel">
                        <div class="heading">
                            <h2><i class="fa-solid fa-location-dot"></i> Campus Map &amp; Live Incidents</h2>
                            <button class="text-link" data-go="/map-navigation">View Full Map ↗</button>
                        </div>
                        <div class="map-layout">
                            <div id="campusMap"></div>
                            <div class="map-legend">
                                <span>🔴 Fire</span><span>🔵 Medical</span><span>🟠 Security</span>
                                <span>🟣 Lab Accident</span><span>🟢 Building Damage</span><span>⚪ Others</span>
                            </div>
                        </div>
                    </article>

                    <article class="panel recent">
                        <div class="heading">
                            <h2><i class="fa-regular fa-clock"></i> Recent Incidents</h2>
                            <button class="text-link" data-go="/incidents">View All ↗</button>
                        </div>

                        <div class="table-wrap">
                            <table id="incidentsTable">
                                <thead><tr><th>ID</th><th>Type</th><th>Location</th><th>Priority</th><th>Status</th><th>Reported At</th><th>Action</th></tr></thead>
                                <tbody>
                                    <tr><td>INC-2025-0047</td><td>🔥 Fire</td><td>Science Block (B-102)</td><td><i class="pill critical">Critical</i></td><td><i class="pill progress">In Progress</i></td><td>10:12 AM</td><td><button class="view" data-incident="INC-2025-0047">View</button></td></tr>
                                    <tr><td>INC-2025-0046</td><td>✚ Medical</td><td>Hostel B (Room 204)</td><td><i class="pill high">High</i></td><td><i class="pill assigned">Assigned</i></td><td>09:48 AM</td><td><button class="view" data-incident="INC-2025-0046">View</button></td></tr>
                                    <tr><td>INC-2025-0045</td><td>⚠ Security</td><td>Library</td><td><i class="pill high">High</i></td><td><i class="pill assigned">Assigned</i></td><td>09:32 AM</td><td><button class="view" data-incident="INC-2025-0045">View</button></td></tr>
                                    <tr><td>INC-2025-0044</td><td>🧪 Lab Accident</td><td>Lab 3 (Chemistry)</td><td><i class="pill medium">Medium</i></td><td><i class="pill resolved">Resolved</i></td><td>08:20 AM</td><td><button class="view" data-incident="INC-2025-0044">View</button></td></tr>
                                    <tr><td>INC-2025-0043</td><td>🏢 Building Damage</td><td>Admin Block</td><td><i class="pill low">Low</i></td><td><i class="pill resolved">Resolved</i></td><td>07:15 AM</td><td><button class="view" data-incident="INC-2025-0043">View</button></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </article>
                </div>

                <aside class="right">
                    <article class="panel alerts">
                        <div class="alert-title">
                            <h2>🔔 Active Emergency Alerts</h2>
                            <button data-go="/emergency-alerts">View All</button>
                        </div>
                        <div class="alert-item">
                            <span class="alert-icon fire">🔥</span>
                            <div><b>Fire Emergency – Science Block</b><p><i class="pill critical">Critical</i> <small>2 mins ago</small></p></div>
                            <i class="fa-solid fa-chevron-right arrow"></i>
                        </div>
                        <div class="alert-item">
                            <span class="alert-icon medical">✚</span>
                            <div><b>Medical Emergency – Hostel B</b><p><i class="pill high">High</i> <small>8 mins ago</small></p></div>
                            <i class="fa-solid fa-chevron-right arrow"></i>
                        </div>
                    </article>

                    <article class="panel">
                        <div class="heading"><h2>⚡ Quick Actions</h2><button class="text-link" data-go="/quick-actions">View All</button></div>
                        <div class="quick-grid">
                            <a class="quick red-q" href="{{ url('/report-incident') }}"><i class="fa-solid fa-tower-broadcast"></i>Report Incident</a>
                            <a class="quick blue-q" href="{{ url('/emergency-teams') }}"><i class="fa-solid fa-user-plus"></i>Assign Team</a>
                            <a class="quick green-q" href="{{ url('/map-navigation') }}"><i class="fa-solid fa-map"></i>View Map</a>
                            <a class="quick purple-q" href="{{ url('/reports-analytics') }}"><i class="fa-solid fa-file-lines"></i>Generate Report</a>
                        </div>
                    </article>

                    <article class="panel teams">
                        <div class="heading"><h2>👥 Emergency Teams Status</h2><button class="text-link" data-go="/emergency-teams">View All</button></div>
                        <div class="team"><i class="fa-solid fa-kit-medical team-green"></i><span><b>Medical Team</b><small>2 available / 2 assigned</small></span><i class="status available">Available</i></div>
                        <div class="team"><i class="fa-solid fa-shield-halved team-blue"></i><span><b>Security Team</b><small>1 available / 2 assigned</small></span><i class="status busy">Busy</i></div>
                        <div class="team"><i class="fa-solid fa-fire-flame-curved team-red"></i><span><b>Fire Response Team</b><small>1 available / 1 assigned</small></span><i class="status busy">Busy</i></div>
                        <div class="team"><i class="fa-solid fa-screwdriver-wrench team-purple"></i><span><b>Maintenance Team</b><small>2 available / 1 assigned</small></span><i class="status available">Available</i></div>
                    </article>
                </aside>
            </section>

            <footer>Campus Crisis &amp; Emergency Management • Dashboard demo data</footer>
        </div>
    </main>
</div>

<div id="toast" class="toast"></div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
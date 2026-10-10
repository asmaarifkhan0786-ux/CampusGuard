<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response Teams | CampusGuard</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f3f6fb; color: #17243b; }
        nav {
            background: #10233f; color: white; padding: 19px 6%;
            display: flex; justify-content: space-between; align-items: center;
            gap: 15px; flex-wrap: wrap;
        }
        .logo { font-size: 24px; font-weight: bold; }
        .logo span { color: #39d5bd; }
        nav a { color: white; text-decoration: none; margin-left: 18px; font-size: 14px; }
        .container { max-width: 1200px; margin: 38px auto; padding: 0 20px; }
        .top {
            display: flex; justify-content: space-between; align-items: center;
            gap: 18px; flex-wrap: wrap; margin-bottom: 25px;
        }
        h1 { font-size: 30px; margin-bottom: 9px; }
        .muted { color: #718096; line-height: 1.6; }
        .btn {
            display: inline-block; padding: 12px 17px; border-radius: 8px;
            background: #0f9f8f; color: white; text-decoration: none;
            font-weight: bold; border: none; cursor: pointer; font-size: 14px;
        }
        .panel {
            background: white; border: 1px solid #e4eaf2; border-radius: 13px;
            padding: 22px; box-shadow: 0 5px 22px #10233f0a;
        }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 850px; }
        th, td { padding: 15px 13px; text-align: left; border-bottom: 1px solid #edf1f6; }
        th { color: #607086; font-size: 12px; text-transform: uppercase; letter-spacing: .5px; }
        td { font-size: 14px; }
        .team-name { font-weight: bold; color: #17243b; }
        .badge {
            display: inline-block; border-radius: 30px; padding: 6px 10px;
            font-size: 12px; font-weight: bold; background: #e8eef5; color: #475569;
        }
        .available { background: #dcfce7; color: #166534; }
        .busy { background: #fef3c7; color: #92400e; }
        .unavailable { background: #fee2e2; color: #991b1b; }
        .active { background: #d1fae5; color: #065f46; }
        .inactive { background: #e5e7eb; color: #374151; }
        .empty { text-align: center; padding: 40px 15px; color: #718096; }
        .empty h3 { color: #17243b; margin-bottom: 10px; }
        .pagination { margin-top: 20px; }
        .pagination nav { background: transparent; padding: 0; color: inherit; }
        .pagination a, .pagination span { margin: 3px; }
        footer { text-align: center; padding: 25px; color: #718096; font-size: 13px; }
        @media(max-width: 600px) {
            .container { padding: 0 13px; margin-top: 25px; }
            h1 { font-size: 25px; }
        }
    </style>
</head>
<body>

<nav>
    <div class="logo">Campus<span>Guard</span></div>
    <div>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('emergency-reports.index') }}">Reports</a>
    </div>
</nav>

<main class="container">
    <div class="top">
        <div>
            <h1>Response Teams</h1>
            <p class="muted">Manage campus medical, security, fire, and rescue teams.</p>
        </div>
        <a class="btn" href="{{ route('response-teams.create') }}">+ Add Response Team</a>
    </div>

    <div class="panel">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Team Name</th>
                        <th>Team Type</th>
                        <th>Team Leader</th>
                        <th>Contact</th>
                        <th>Availability</th>
                        <th>Status</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($teams as $team)
                    <tr>
                        <td>
                            <span class="team-name">{{ $team->name }}</span>
                        </td>
                        <td>{{ ucfirst($team->team_type) }}</td>
                        <td>{{ $team->leader_name ?: 'Not specified' }}</td>
                        <td>{{ $team->contact_number ?: 'Not specified' }}</td>
                        <td>
                            <span class="badge {{ $team->availability }}">
                                {{ ucfirst($team->availability) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $team->is_active ? 'active' : 'inactive' }}">
                                {{ $team->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ $team->location ?: 'Not specified' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty">
                                <h3>No response teams added yet</h3>
                                <p>Add a medical, security, fire, or rescue team to get started.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $teams->links() }}
        </div>
    </div>
</main>

<footer>CampusGuard — Campus Crisis & Emergency Management System</footer>

</body>
</html>

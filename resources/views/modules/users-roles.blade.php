@extends('layouts.app')

@section('title', 'Users & Roles')

@section('content')
<style>
    .ur-page {
        color: #172b4d;
        padding-bottom: 35px;
    }

    .ur-page * {
        box-sizing: border-box;
    }

    .ur-hero {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        background: linear-gradient(120deg, #061d40, #164579);
        border-radius: 18px;
        padding: 30px;
        margin-bottom: 25px;
        color: white;
    }

    .ur-hero h1 {
        margin: 0 0 10px;
        color: white;
        font-size: 30px;
        font-weight: 800;
    }

    .ur-hero p {
        margin: 0;
        color: #dbeafe;
        font-size: 16px;
        line-height: 1.7;
    }

    .ur-hero-icon {
        width: 85px;
        height: 85px;
        border-radius: 18px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(255,255,255,.13);
        font-size: 43px;
    }

    .ur-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 25px;
    }

    .ur-stat {
        background: #fff;
        padding: 23px;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        box-shadow: 0 5px 18px rgba(15,23,42,.04);
    }

    .ur-stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .ur-stat-label {
        font-size: 14px;
        font-weight: 700;
        color: #64748b;
    }

    .ur-stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        background: #eff6ff;
        border-radius: 12px;
        font-size: 22px;
    }

    .ur-stat-number {
        font-size: 32px;
        font-weight: 800;
        color: #102c50;
    }

    .ur-stat-note {
        margin-top: 6px;
        font-size: 13px;
        color: #64748b;
    }

    .ur-panel {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 18px rgba(15,23,42,.04);
    }

    .ur-panel-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 22px;
    }

    .ur-panel-heading h2 {
        font-size: 23px;
        font-weight: 800;
        color: #102c50;
        margin: 0 0 7px;
    }

    .ur-panel-heading p {
        font-size: 14px;
        line-height: 1.7;
        color: #64748b;
        margin: 0;
    }

    .ur-filters {
        display: grid;
        grid-template-columns: minmax(200px, 1fr) 220px;
        gap: 14px;
        margin-bottom: 22px;
    }

    .ur-search {
        position: relative;
    }

    .ur-search span {
        position: absolute;
        left: 14px;
        top: 12px;
        font-size: 17px;
    }

    .ur-search input,
    .ur-filters select {
        width: 100%;
        height: 47px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        padding: 11px 13px;
        color: #334155;
        background: white;
        font-size: 14px;
        outline: none;
    }

    .ur-search input {
        padding-left: 42px;
    }

    .ur-search input:focus,
    .ur-filters select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,.1);
    }

    .ur-table-wrap {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }

    .ur-table {
        width: 100%;
        min-width: 700px;
        border-collapse: collapse;
        text-align: left;
    }

    .ur-table thead {
        background: #f1f5f9;
    }

    .ur-table th {
        padding: 17px 20px;
        color: #475569;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .4px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .ur-table td {
        padding: 19px 20px;
        border-top: 1px solid #e2e8f0;
        color: #334155;
        font-size: 15px;
        vertical-align: middle;
    }

    .ur-table tbody tr:hover {
        background: #f8fafc;
    }

    .ur-user {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 180px;
    }

    .ur-avatar {
        width: 46px;
        height: 46px;
        min-width: 46px;
        border-radius: 50%;
        background: #dbeafe;
        color: #1d4ed8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        font-weight: 800;
    }

    .ur-user-name {
        font-size: 15px;
        font-weight: 800;
        color: #102c50;
        margin-bottom: 4px;
        overflow-wrap: anywhere;
    }

    .ur-user-caption {
        color: #64748b;
        font-size: 12px;
    }

    .ur-email {
        overflow-wrap: anywhere;
        min-width: 210px;
    }

    .ur-role {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 20px;
        background: #dbeafe;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 800;
        text-transform: capitalize;
    }

    .ur-empty {
        padding: 40px 20px;
        text-align: center;
        color: #64748b;
    }

    .ur-empty-icon {
        font-size: 40px;
        margin-bottom: 12px;
    }

    .ur-empty h3 {
        color: #102c50;
        font-size: 19px;
        margin: 0 0 8px;
    }

    .ur-empty p {
        font-size: 14px;
        margin: 0;
    }

    .ur-count {
        display: inline-block;
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 8px;
        padding: 7px 11px;
        font-size: 13px;
        font-weight: 800;
    }

    @media(max-width: 850px) {
        .ur-stats {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width: 600px) {
        .ur-hero {
            padding: 22px;
        }

        .ur-hero h1 {
            font-size: 24px;
        }

        .ur-hero-icon {
            display: none;
        }

        .ur-panel {
            padding: 17px;
        }

        .ur-panel-heading h2 {
            font-size: 20px;
        }

        .ur-filters {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="ur-page">

    <div class="ur-hero">
        <div>
            <h1>Users &amp; Roles Management</h1>
            <p>
                Manage registered campus users, review account details and
                monitor assigned access roles from one place.
            </p>
        </div>
        <div class="ur-hero-icon">👥</div>
    </div>

    @php
        $userRecords = $users ?? collect();
        $userRecords = $userRecords instanceof \Illuminate\Pagination\AbstractPaginator
            ? $userRecords->getCollection()
            : collect($userRecords);

        $totalUsers = $userRecords->count();
        $adminUsers = $userRecords->filter(function ($user) {
            return strtolower((string) ($user->role ?? 'student')) === 'admin';
        })->count();

        $studentUsers = $userRecords->filter(function ($user) {
            return strtolower((string) ($user->role ?? 'student')) === 'student';
        })->count();
    @endphp

    <div class="ur-stats">
        <div class="ur-stat">
            <div class="ur-stat-top">
                <span class="ur-stat-label">Registered Users</span>
                <span class="ur-stat-icon">👥</span>
            </div>
            <div class="ur-stat-number">{{ $totalUsers }}</div>
            <div class="ur-stat-note">Users currently listed on this page</div>
        </div>

        <div class="ur-stat">
            <div class="ur-stat-top">
                <span class="ur-stat-label">Administrators</span>
                <span class="ur-stat-icon">🛡️</span>
            </div>
            <div class="ur-stat-number">{{ $adminUsers }}</div>
            <div class="ur-stat-note">Accounts with the admin role</div>
        </div>

        <div class="ur-stat">
            <div class="ur-stat-top">
                <span class="ur-stat-label">Student Accounts</span>
                <span class="ur-stat-icon">🎓</span>
            </div>
            <div class="ur-stat-number">{{ $studentUsers }}</div>
            <div class="ur-stat-note">Accounts with the student role</div>
        </div>
    </div>

    <div class="ur-panel">
        <div class="ur-panel-heading">
            <div>
                <h2>Registered Users</h2>
                <p>Search accounts by name or email and filter them by role.</p>
            </div>
            <span class="ur-count">{{ $totalUsers }} users</span>
        </div>

        <div class="ur-filters">
            <div class="ur-search">
                <span>🔎</span>
                <input
                    type="search"
                    id="urSearch"
                    placeholder="Search by user name or email..."
                    aria-label="Search users"
                >
            </div>

            <select id="urRoleFilter" aria-label="Filter by role">
                <option value="">All Roles</option>
                @foreach($userRecords->pluck('role')->filter()->unique()->sort() as $role)
                    <option value="{{ strtolower($role) }}">
                        {{ ucfirst($role) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="ur-table-wrap">
            <table class="ur-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email Address</th>
                        <th>Access Role</th>
                    </tr>
                </thead>
                <tbody id="urUsersBody">
                    @forelse($userRecords as $user)
                        @php
                            $displayName = $user->name ?? $user->username ?? 'Unnamed User';
                            $displayEmail = $user->email ?? 'No email available';
                            $displayRole = $user->role ?? 'student';
                            $initials = collect(explode(' ', trim($displayName)))
                                ->filter()
                                ->map(function ($part) {
                                    return strtoupper(substr($part, 0, 1));
                                })
                                ->take(2)
                                ->implode('');
                        @endphp

                        <tr
                            data-user-row
                            data-name="{{ strtolower($displayName) }}"
                            data-email="{{ strtolower($displayEmail) }}"
                            data-role="{{ strtolower($displayRole) }}"
                        >
                            <td>
                                <div class="ur-user">
                                    <div class="ur-avatar">
                                        {{ $initials ?: 'U' }}
                                    </div>
                                    <div>
                                        <div class="ur-user-name">{{ $displayName }}</div>
                                        <div class="ur-user-caption">Campus account</div>
                                    </div>
                                </div>
                            </td>
                            <td class="ur-email">{{ $displayEmail }}</td>
                            <td>
                                <span class="ur-role">{{ $displayRole }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr id="urEmptyRow">
                            <td colspan="3">
                                <div class="ur-empty">
                                    <div class="ur-empty-icon">👤</div>
                                    <h3>No Users Found</h3>
                                    <p>Registered user accounts will appear here.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <p id="urNoResults" hidden
           style="text-align:center;padding:25px;color:#64748b;font-size:14px;">
            No matching users found. Try another search or role.
        </p>
    </div>
</div>

<script>
(function () {
    const searchInput = document.getElementById('urSearch');
    const roleFilter = document.getElementById('urRoleFilter');
    const body = document.getElementById('urUsersBody');
    const noResults = document.getElementById('urNoResults');

    function filterUsers() {
        const query = searchInput.value.toLowerCase().trim();
        const selectedRole = roleFilter.value.toLowerCase();
        const rows = body.querySelectorAll('[data-user-row]');
        let visible = 0;

        rows.forEach(function (row) {
            const name = row.dataset.name || '';
            const email = row.dataset.email || '';
            const role = row.dataset.role || '';

            const matchesSearch =
                name.includes(query) || email.includes(query);
            const matchesRole =
                !selectedRole || role === selectedRole;
            const show = matchesSearch && matchesRole;

            row.style.display = show ? '' : 'none';

            if (show) visible++;
        });

        noResults.hidden = visible > 0 || rows.length === 0;
    }

    searchInput.addEventListener('input', filterUsers);
    roleFilter.addEventListener('change', filterUsers);
})();
</script>
@endsection
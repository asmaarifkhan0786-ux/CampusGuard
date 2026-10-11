<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Settings - CampusGuard</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #172033;
        }

        .header {
            background: #061d3b;
            color: white;
            padding: 22px 40px;
        }

        .brand {
            font-size: 22px;
            font-weight: 800;
        }

        .brand span {
            display: block;
            font-size: 13px;
            color: #b9c9dc;
            margin-top: 4px;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .back {
            display: inline-block;
            color: #1c5fa8;
            text-decoration: none;
            font-weight: 700;
            margin-bottom: 20px;
        }

        h1 {
            margin-bottom: 8px;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 28px;
            border-radius: 16px;
            margin-bottom: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,.06);
        }

        .card h2 {
            margin-top: 0;
        }

        .setting {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .setting:last-child {
            border-bottom: none;
        }

        .setting strong {
            display: block;
            margin-bottom: 5px;
        }

        .setting p {
            margin: 0;
            color: #6b7280;
            font-size: 14px;
        }

        .back-btn {
            display: inline-block;
            background: #061d3b;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 700;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<header class="header">

    <div class="brand">
        🛡 Campus Crisis & Emergency Management
        <span>Safe Campus, Secure Future</span>
    </div>

</header>

<div class="container">

    <a href="{{ route('dashboard') }}" class="back">
        ← Back to Dashboard
    </a>

    <h1>Settings</h1>

    <p class="subtitle">
        Manage your CampusGuard system preferences.
    </p>

    <div class="card">

        <h2>System Settings</h2>

        <div class="setting">
            <div>
                <strong>Emergency Notifications</strong>
                <p>Receive notifications about active campus emergencies.</p>
            </div>

            <input type="checkbox" checked>
        </div>

        <div class="setting">
            <div>
                <strong>Incident Alerts</strong>
                <p>Receive alerts when a new incident is reported.</p>
            </div>

            <input type="checkbox" checked>
        </div>

        <div class="setting">
            <div>
                <strong>System Updates</strong>
                <p>Receive important CampusGuard system updates.</p>
            </div>

            <input type="checkbox" checked>
        </div>

    </div>

    <div class="card">

        <h2>Account</h2>

        <div class="setting">
            <div>
                <strong>My Profile</strong>
                <p>Update your personal account information.</p>
            </div>

            <a href="{{ route('profile.edit') }}">
                Edit Profile
            </a>
        </div>

    </div>

    <a href="{{ route('dashboard') }}" class="back-btn">
        Return to Dashboard
    </a>

</div>

</body>
</html>
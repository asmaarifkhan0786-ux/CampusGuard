<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Response Team | CampusGuard</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f3f6fb; color: #17243b; }
        nav {
            background: #10233f; color: white; padding: 20px 7%;
            display: flex; justify-content: space-between; align-items: center;
            gap: 15px; flex-wrap: wrap;
        }
        .logo { font-size: 24px; font-weight: bold; }
        .logo span { color: #39d5bd; }
        nav a { color: white; text-decoration: none; margin-left: 18px; }
        .container { max-width: 850px; margin: 40px auto; padding: 0 20px; }
        h1 { font-size: 30px; margin-bottom: 10px; }
        .subtitle { color: #718096; line-height: 1.7; margin-bottom: 25px; }
        .card {
            background: white; border: 1px solid #e4eaf2; border-radius: 14px;
            padding: 30px; box-shadow: 0 5px 22px #10233f0a;
        }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .field { margin-bottom: 20px; }
        .full { grid-column: 1 / -1; }
        label { display: block; font-weight: bold; font-size: 14px; margin-bottom: 9px; }
        input, select {
            width: 100%; padding: 13px; border: 1px solid #d4deea;
            border-radius: 8px; font-size: 15px; background: white; color: #17243b;
        }
        input:focus, select:focus { outline: 2px solid #a4eee1; border-color: #159d8b; }
        .error { color: #c62828; font-size: 13px; margin-top: 7px; }
        .summary { background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .actions { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 5px; }
        .btn {
            display: inline-block; padding: 13px 20px; border-radius: 8px;
            text-decoration: none; font-size: 14px; font-weight: bold; border: none; cursor: pointer;
        }
        .primary { background: #0f9f8f; color: white; }
        .secondary { background: #e8eef5; color: #24364d; }
        footer { text-align: center; padding: 25px; color: #718096; font-size: 13px; }
        @media(max-width: 600px) {
            .grid { grid-template-columns: 1fr; }
            .full { grid-column: auto; }
            .card { padding: 20px; }
        }
    </style>
</head>
<body>

<nav>
    <div class="logo">Campus<span>Guard</span></div>
    <div>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('response-teams.index') }}">Response Teams</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </div>
</nav>

<main class="container">
    <h1>Add Response Team</h1>
    <p class="subtitle">Register a campus team responsible for emergency response and coordination.</p>

    @if ($errors->any())
        <div class="summary">
            <strong>Please correct these errors:</strong>
            <ul style="margin: 10px 0 0 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="card" action="{{ route('response-teams.store') }}" method="POST">
        @csrf

        <div class="grid">
            <div class="field full">
                <label for="name">Team Name *</label>
                <input id="name" name="name" value="{{ old('name') }}"
                       placeholder="Example: Campus Medical Response Team" required maxlength="255">
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="team_type">Team Type *</label>
                <select id="team_type" name="team_type" required>
                    <option value="">Select team type</option>
                    <option value="medical" {{ old('team_type') == 'medical' ? 'selected' : '' }}>Medical</option>
                    <option value="security" {{ old('team_type') == 'security' ? 'selected' : '' }}>Security</option>
                    <option value="fire" {{ old('team_type') == 'fire' ? 'selected' : '' }}>Fire Safety</option>
                    <option value="rescue" {{ old('team_type') == 'rescue' ? 'selected' : '' }}>Rescue</option>
                    <option value="other" {{ old('team_type') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('team_type') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="availability">Availability *</label>
                <select id="availability" name="availability" required>
                    <option value="available" {{ old('availability', 'available') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="busy" {{ old('availability') == 'busy' ? 'selected' : '' }}>Busy</option>
                    <option value="unavailable" {{ old('availability') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
                @error('availability') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="leader_name">Team Leader</label>
                <input id="leader_name" name="leader_name" value="{{ old('leader_name') }}"
                       placeholder="Leader's full name" maxlength="255">
                @error('leader_name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="contact_number">Contact Number</label>
                <input id="contact_number" name="contact_number" value="{{ old('contact_number') }}"
                       placeholder="Phone number" maxlength="30">
                @error('contact_number') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="email">Email Address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}"
                       placeholder="team@university.edu">
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="location">Team Location</label>
                <input id="location" name="location" value="{{ old('location') }}"
                       placeholder="Example: Main Campus, Block A">
                @error('location') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="actions">
            <button class="btn primary" type="submit">Save Response Team</button>
            <a class="btn secondary" href="{{ route('response-teams.index') }}">Cancel</a>
        </div>
    </form>
</main>

<footer>CampusGuard — Campus Crisis & Emergency Management System</footer>

</body>
</html>
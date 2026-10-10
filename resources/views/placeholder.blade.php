
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle ?? 'Campus Crisis Management' }}</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body style="padding:30px">
    <main class="panel" style="max-width:900px;margin:auto">
        <h1>{{ $pageTitle ?? 'Campus Crisis Management' }}</h1>
        <p>This module is ready for its form, table and database functionality.</p>
        <a href="{{ url('/dashboard') }}">← Back to Dashboard</a>
    </main>
</body>
</html>
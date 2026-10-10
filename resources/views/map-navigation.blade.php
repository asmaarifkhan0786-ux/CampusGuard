
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campus Map & Live Incidents</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <style>
        body { padding: 20px; }
        .map-page { max-width: 1500px; margin: auto; }
        #fullCampusMap { height: 75vh; min-height: 400px; border-radius: 12px; }
        .map-header { display:flex; justify-content:space-between; align-items:center; gap:15px; margin-bottom:18px; }
        .back-link { color:#087af5; text-decoration:none; font-weight:700; }
    </style>
</head>
<body>
    <main class="map-page">
        <div class="map-header">
            <div>
                <h1>📍 Campus Map & Live Incidents</h1>
                <p>View campus locations and sample emergency markers.</p>
            </div>
            <a class="back-link" href="{{ url('/dashboard') }}">← Dashboard</a>
        </div>

        <div class="panel">
            <div id="fullCampusMap"></div>
        </div>
    </main>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('fullCampusMap').setView([25.3960, 68.3578], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const places = [
            { name: 'Science Block', detail: '🔥 Fire emergency', coords: [25.3970, 68.3570] },
            { name: 'Hostel B', detail: '✚ Medical emergency', coords: [25.3954, 68.3590] },
            { name: 'Library', detail: '⚠ Security incident', coords: [25.3965, 68.3559] },
            { name: 'Cafeteria', detail: '🟢 Power fault', coords: [25.3949, 68.3574] }
        ];

        places.forEach(place => {
            L.marker(place.coords)
                .addTo(map)
                .bindPopup('<b>' + place.name + '</b><br>' + place.detail);
        });
    </script>
</body>
</html>
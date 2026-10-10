
document.addEventListener("DOMContentLoaded", function () {
    const $ = id => document.getElementById(id);

    function showToast(message) {
        const toast = $("toast");
        toast.textContent = message;
        toast.classList.add("show");

        clearTimeout(window.toastTimer);
        window.toastTimer = setTimeout(() => {
            toast.classList.remove("show");
        }, 3000);
    }

    // Live date and time
    function updateClock() {
        const now = new Date();

        $("currentDate").textContent = now.toLocaleDateString("en-US", {
            month: "long",
            day: "numeric",
            year: "numeric"
        });

        $("currentTime").textContent = now.toLocaleTimeString("en-US", {
            hour: "2-digit",
            minute: "2-digit"
        });
    }

    updateClock();
    setInterval(updateClock, 60000);

    // Sidebar menu
    $("menuToggle").addEventListener("click", function () {
        $("sidebar").classList.toggle("open");
    });

    // Profile dropdown
    $("profileButton").addEventListener("click", function () {
        $("profileMenu").classList.toggle("open");
    });

    document.addEventListener("click", function (event) {
        if (!event.target.closest(".actions")) {
            $("profileMenu").classList.remove("open");
        }
    });

    // Ctrl + K focuses the search box
    document.addEventListener("keydown", function (event) {
        if ((event.ctrlKey || event.metaKey) &&
            event.key.toLowerCase() === "k") {
            event.preventDefault();
            $("globalSearch").focus();
        }
    });

    // Search/filter incident table
    $("globalSearch").addEventListener("input", function () {
        const query = this.value.toLowerCase().trim();

        document.querySelectorAll("#incidentsTable tbody tr").forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(query)
                ? ""
                : "none";
        });
    });

    // Line chart
    if (window.Chart) {
        const labels = [
            "Apr 19", "Apr 20", "Apr 21",
            "Apr 22", "Apr 23", "Apr 24", "Apr 25"
        ];

        const values = {
            "Fire": [5, 7, 7, 10, 7, 9, 6],
            "Medical": [3, 5, 4, 12, 8, 6, 8],
            "Security": [6, 11, 10, 17, 11, 13, 11],
            "Lab Accident": [2, 4, 3, 8, 5, 3, 2],
            "Other": [1, 3, 2, 7, 2, 3, 1]
        };

        const colors = {
            "Fire": "#ff354b",
            "Medical": "#087af5",
            "Security": "#ffad0a",
            "Lab Accident": "#873cff",
            "Other": "#059b77"
        };

        const lineChart = new Chart($("incidentChart"), {
            type: "line",
            data: {
                labels: labels,
                datasets: Object.keys(values).map(name => ({
                    label: name,
                    data: values[name],
                    borderColor: colors[name],
                    backgroundColor: colors[name],
                    tension: 0.35,
                    borderWidth: 2,
                    pointRadius: 2,
                    pointHoverRadius: 5,
                    fill: false
                }))
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: "index",
                    intersect: false
                },
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 20,
                        ticks: {
                            stepSize: 5,
                            color: "#657994"
                        },
                        grid: { color: "#e9eff7" }
                    },
                    x: {
                        ticks: {
                            color: "#657994",
                            maxRotation: 0
                        },
                        grid: { color: "#edf2f8" }
                    }
                }
            }
        });

        $("chartPeriod").addEventListener("change", function () {
            const count = Number(this.value);

            lineChart.data.labels = labels.slice(-count);

            lineChart.data.datasets.forEach(dataset => {
                dataset.data = values[dataset.label].slice(-count);
            });

            lineChart.update();
        });

        // Incidents by Type doughnut chart
        new Chart($("typeChart"), {
            type: "doughnut",
            data: {
                labels: [
                    "Fire", "Medical", "Security",
                    "Lab Accident", "Building Damage", "Others"
                ],
                datasets: [{
                    data: [7, 6, 5, 4, 3, 3],
                    backgroundColor: [
                        "#ff354b", "#087af5", "#ffad0a",
                        "#873cff", "#059b77", "#77879d"
                    ],
                    borderWidth: 0,
                    hoverOffset: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: "68%",
                plugins: {
                    legend: { display: false }
                }
            }
        });
    } else {
        showToast("Charts could not load. Please check your internet connection.");
    }

    // Interactive OpenStreetMap
    if (window.L) {
        const map = L.map("campusMap").setView([25.3960, 68.3578], 16);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: "&copy; OpenStreetMap contributors"
        }).addTo(map);

        const locations = [
            {
                name: "Science Block",
                detail: "Fire emergency",
                position: [25.3970, 68.3570],
                color: "#ef233c",
                emoji: "🔥"
            },
            {
                name: "Hostel B",
                detail: "Medical emergency",
                position: [25.3954, 68.3590],
                color: "#087af5",
                emoji: "✚"
            },
            {
                name: "Library",
                detail: "Security incident",
                position: [25.3965, 68.3559],
                color: "#f2a100",
                emoji: "⚠"
            },
            {
                name: "Cafeteria",
                detail: "Power fault",
                position: [25.3949, 68.3574],
                color: "#059b77",
                emoji: "●"
            }
        ];

        locations.forEach(location => {
            const icon = L.divIcon({
                className: "custom-marker",
                html: `<span style="background:${location.color}">${location.emoji}</span>`,
                iconSize: [30, 30],
                iconAnchor: [15, 15]
            });

            L.marker(location.position, { icon })
                .addTo(map)
                .bindPopup(
                    `<b>${location.name}</b><br>${location.detail}`
                );
        });

        window.campusMap = map;

        // Fix map sizing after the page has rendered
        setTimeout(() => map.invalidateSize(), 300);
    } else {
        $("campusMap").innerHTML =
            "Map could not load. Please check your internet connection.";
    }

    // View All and navigation buttons
    document.querySelectorAll("[data-go]").forEach(button => {
        button.addEventListener("click", function () {
            window.location.href = this.dataset.go;
        });
    });

    // Demo incident details
    document.querySelectorAll("[data-incident]").forEach(button => {
        button.addEventListener("click", function () {
            showToast(
                "Incident " + this.dataset.incident +
                " is sample data. Connect your incident details route."
            );
        });
    });

    // Demo notifications
    $("notifications").addEventListener("click", function () {
        showToast(
            "3 demo notifications: Fire Emergency, Medical Emergency and Team Assignment."
        );
    });
});
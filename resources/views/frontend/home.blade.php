@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow" role="alert">
        <i class="fas fa-check-circle fs-4 me-3"></i>
        <div>
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow" role="alert">
        <i class="fas fa-exclamation-triangle fs-4 me-3"></i>
        <div>
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

<div class="row mt-4">
    <!-- Left Side (Weather & Quick Actions) -->
    <div class="col-md-4">
        <!-- Live Weather Card -->
        <div class="card shadow text-center border-danger">
            <div class="card-body">
                <h5 class="card-title text-danger"><i class="fas fa-temperature-high"></i> Current Weather</h5>
                <h1 id="temp" class="display-1 fw-bold">--°C</h1>
                <p id="weather-desc" class="text-muted">Fetching data...</p>
            </div>
        </div>

        <!-- Quick Action Buttons (Grid Layout) -->
        <h6 class="text-uppercase text-muted mt-4 mb-2 fw-bold">Quick Actions</h6>
        <div class="row g-2">
            <div class="col-6">
                <a href="{{ route('disasters.create') }}" class="btn btn-danger w-100 h-100 d-flex align-items-center justify-content-center flex-column py-3">
                    <i class="fas fa-map-marked-alt fa-lg mb-1"></i> <span class="small">Report Disaster</span>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('aid_requests.create') }}" class="btn btn-warning w-100 h-100 d-flex align-items-center justify-content-center flex-column py-3 text-dark">
                    <i class="fas fa-hands-helping fa-lg mb-1"></i> <span class="small">Request Aid</span>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('missing.create') }}" class="btn btn-info w-100 h-100 d-flex align-items-center justify-content-center flex-column py-3 text-dark">
                    <i class="fas fa-walking fa-lg mb-1"></i> <span class="small">Report Missing</span>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('donations.create') }}" class="btn btn-success w-100 h-100 d-flex align-items-center justify-content-center flex-column py-3">
                    <i class="fas fa-hand-holding-usd fa-lg mb-1"></i> <span class="small">Donate</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Right Side (Alerts) -->
    <div class="col-md-8">
        <h3><i class="fas fa-bell text-danger"></i> Latest Alerts </h3>
        
        <!-- Give it an ID so JS can fill it -->
        <div id="alerts-list">
            <!-- JavaScript will inject alerts here -->
        </div>
    </div>
</div>

<script>
    // Function to fetch and display weather
    function fetchWeather(lat, lon, cityName) {
        fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`)
            .then(response => response.json())
            .then(data => {
                const temp = data.current_weather.temperature;
                const code = data.current_weather.weathercode;
                
                let desc = "Clear Sky";
                if (code >= 51 && code <= 67) desc = "Rainy";
                else if (code >= 71 && code <= 77) desc = "Snowy";
                else if (code >= 80 && code <= 82) desc = "Rain Showers";
                else if (code >= 95) desc = "Thunderstorm";

                document.getElementById('temp').innerText = temp + '°C';
                document.getElementById('weather-desc').innerText = desc + ' in ' + cityName;
            })
            .catch(error => console.error("Weather fetch failed"));
    }

    // Function to get city name from coordinates (Reverse Geocoding)
    function getCityAndWeather(lat, lon) {
        fetch(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lon}&localityLanguage=en`)
            .then(response => response.json())
            .then(data => {
                let cityName = data.city || data.locality || data.principalSubdivision || 'Your Location';
                fetchWeather(lat, lon, cityName);
            })
            .catch(() => {
                fetchWeather(lat, lon, 'Your Location');
            });
    }

    // 1. Ask user for permission to show browser notifications
    if (Notification.permission !== "granted") {
        Notification.requestPermission();
    }

    let lastAlertId = null;

    // 2. Function to play a 30-second siren sound using Web Audio API
    function playSiren() {
        const ctx = new (window.AudioContext || window.webkitAudioContext)();
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        
        osc.type = 'square'; 
        osc.connect(gain);
        gain.connect(ctx.destination);
        
        gain.gain.setValueAtTime(0.5, ctx.currentTime);
        
        let time = ctx.currentTime;
        const duration = 30; 
        const interval = 0.5; 
        
        while(time < ctx.currentTime + duration) {
            osc.frequency.setValueAtTime(800, time); 
            time += interval;
            osc.frequency.setValueAtTime(1200, time); 
            time += interval;
        }
        
        gain.gain.setValueAtTime(0.5, ctx.currentTime + duration - 1);
        gain.gain.linearRampToValueAtTime(0, ctx.currentTime + duration);
        
        osc.start(ctx.currentTime);
        osc.stop(ctx.currentTime + duration);
    }

    // 3. Check for new alerts every 2 seconds (for Siren & Pop-up)
    setInterval(function() {
        fetch('{{ route("check.alert") }}')
            .then(response => response.json())
            .then(data => {
                if(data && data.id) {
                    if(lastAlertId === null) {
                        lastAlertId = data.id;
                    } 
                    else if(data.id !== lastAlertId) {
                        lastAlertId = data.id;
                        playSiren();
                        if (Notification.permission === "granted") {
                            new Notification("🚨 DISASTER ALERT: " + data.title, {
                                body: data.message,
                                icon: "https://cdn-icons-png.flaticon.com/512/1793/1793936.png"
                            });
                        }
                    }
                }
            })
            .catch(error => console.error("Error checking alerts: " + error));
    }, 2000); 

    // 4. Get User's Live Location for Weather
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                getCityAndWeather(lat, lon);
            },
            () => {
                // Fallback to Birtamod
                fetchWeather(26.6645, 87.9914, 'Birtamod');
            }
        );
    } else {
        // Fallback to Birtamod
        fetchWeather(26.6645, 87.9914, 'Birtamod');
    }

    // 5. Fetch Live Alerts List for User Dashboard
    function loadLiveAlerts() {
        fetch('{{ route("api.alerts") }}')
            .then(response => response.json())
            .then(data => {
                let container = document.getElementById('alerts-list');
                container.innerHTML = ''; // Clear old alerts

                if(!data || data.length === 0) {
                    container.innerHTML = '<div class="alert alert-secondary">No active alerts right now. Stay safe!</div>';
                    return;
                }

                data.forEach(function(alert) {
                    let alertClass = alert.severity === 'Critical' ? 'danger' : (alert.severity === 'Warning' ? 'warning' : 'info');
                    let timeStr = new Date(alert.created_at).toLocaleString();
                    
                    container.innerHTML += `
                        <div class="alert alert-${alertClass} shadow-sm">
                            <strong>${alert.title}</strong> <span class="badge bg-dark float-end">${timeStr}</span>
                            <p class="mb-0 mt-1">${alert.message}</p>
                        </div>
                    `;
                });
            })
            .catch(error => console.error("Error fetching live alerts: " + error));
    }

    // Load immediately
    loadLiveAlerts();
    // Refresh every 2 seconds
    setInterval(loadLiveAlerts, 2000);
</script>
@endsection
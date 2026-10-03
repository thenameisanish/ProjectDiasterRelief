@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-4"><i class="fas fa-map-marked-alt text-danger"></i> Active Disaster Zones Map</h2>
    
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"> Avoid These Active Areas</h5>
        </div>
        <div class="card-body p-0">
            <div id="publicDisasterMap" style="height: 500px; width: 100%;"></div>
        </div>
    </div>
</div>

<script>
    // Initialize Map
    var publicDisasterMap = L.map('publicDisasterMap').setView([26.6645, 87.9914], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(publicDisasterMap);

    // Fix for sidebar layout
    setTimeout(function(){ publicDisasterMap.invalidateSize() }, 300);

    // Get disasters from database
    var disasters = {{ Js::from($disasters) }};

    // Loop through and add red markers
    disasters.forEach(function(disaster) {
        if(disaster.latitude && disaster.longitude) {
            L.marker([disaster.latitude, disaster.longitude]).addTo(publicDisasterMap)
                .bindPopup(
                    '<b>Disaster:</b> ' + disaster.disaster_type + '<br>' +
                    '<b>Status:</b> ' + disaster.status + '<br>' +
                    '<b>Description:</b> ' + disaster.description
                );
        }
    });
</script>
@endsection
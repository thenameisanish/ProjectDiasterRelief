@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-4"><i class="fas fa-home text-success"></i> Nearby Holding Centers</h2>
    
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"> Shelter Locations Map</h5>
        </div>
        <div class="card-body p-0">
            <div id="shelterMap" style="height: 500px; width: 100%;"></div>
        </div>
    </div>
</div>

<script>
    var shelterMap = L.map('shelterMap').setView([26.6645, 87.9914], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(shelterMap);

    setTimeout(function(){ shelterMap.invalidateSize() }, 300);

    var shelters = {{ Js::from($shelters) }};

    // Loop through shelters and add green markers
    shelters.forEach(function(shelter) {
        if(shelter.latitude && shelter.longitude) {
            L.marker([shelter.latitude, shelter.longitude]).addTo(shelterMap)
                .bindPopup(
                    '<b>' + shelter.name + '</b><br>' +
                    'Capacity: ' + shelter.capacity + ' people'
                );
        }
    });
</script>
@endsection
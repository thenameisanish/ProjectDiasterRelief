@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Report Disaster on Map</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('disasters.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Disaster Type</label>
                                <select name="disaster_type" class="form-select" required>
                                    <option value="Flood">Flood</option>
                                    <option value="Earthquake">Earthquake</option>
                                    <option value="Fire">Fire</option>
                                    <option value="Landslide">Landslide</option>
                                    <option value="Pandemic">Pandemic</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="Active">Active</option>
                                    <option value="Contained">Contained</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Coordinates</label>
                                <input type="text" id="coordsDisplay" class="form-control" placeholder="Click on map..." readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="2" required></textarea>
                        </div>

                        <!-- Hidden Fields for Latitude and Longitude -->
                        <input type="hidden" name="latitude" id="latitude" required>
                        <input type="hidden" name="longitude" id="longitude" required>

                        <div class="mb-3">
                            <label class="form-label fw-bold">📍 Click on Map to Set Location</label>
                            <!-- Leaflet Map Container -->
                            <div id="map" style="height: 400px; width: 100%; border-radius: 5px;"></div>
                        </div>

                        <button type="submit" class="btn btn-danger w-100">Submit Report</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize Leaflet Map
    var map = L.map('map').setView([27.7172, 85.3240], 13); 

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Fix for maps inside sidebars
    setTimeout(function(){ map.invalidateSize() }, 300);

    var marker;

    function onMapClick(e) {
        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
        document.getElementById('coordsDisplay').value = e.latlng.lat.toFixed(4) + ", " + e.latlng.lng.toFixed(4);

        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(e.latlng).addTo(map);
    }

    map.on('click', onMapClick);
</script>
@endsection
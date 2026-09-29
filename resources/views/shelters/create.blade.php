@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Add Holding Center / Shelter</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('shelters.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Shelter Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g., Public School Hall" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Capacity (Number of people)</label>
                            <input type="number" name="capacity" class="form-control" min="1" required>
                        </div>

                        <!-- Hidden fields for coordinates -->
                        <input type="hidden" name="latitude" id="latitude" required>
                        <input type="hidden" name="longitude" id="longitude" required>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-danger"> Click on map to set Shelter Location</label>
                            <div id="map" style="height: 300px; border-radius: 5px;"></div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Save Shelter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var map = L.map('map').setView([26.6645, 87.9914], 13); // Default to Birtamod

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Fix for sidebar layout
    setTimeout(function(){ map.invalidateSize() }, 300);

    var marker;

    function onMapClick(e) {
        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;

        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(e.latlng).addTo(map);
    }

    map.on('click', onMapClick);
</script>
@endsection
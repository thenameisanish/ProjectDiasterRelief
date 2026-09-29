@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Disaster Reports Map </h2>
        <a href="{{ route('disasters.create') }}" class="btn btn-danger">Report New Disaster</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Admin Master Map -->
    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"> Live Disaster Locations (Reported by Users)</h5>
        </div>
        <div class="card-body p-0">
            <div id="masterMap" style="height: 450px; width: 100%;"></div>
        </div>
    </div>

    <!-- Table of Reports -->
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Location (Lat, Lng)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <td><span class="badge bg-danger">{{ $report->disaster_type }}</span></td>
                                <td>{{ $report->description }}</td>
                                <td>
                                    @if($report->status == 'Active')
                                        <span class="badge bg-warning text-dark">{{ $report->status }}</span>
                                    @elseif($report->status == 'Contained')
                                        <span class="badge bg-primary">{{ $report->status }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $report->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $report->latitude }}, {{ $report->longitude }}</td>
                                <td>
                                    <a href="{{ route('disasters.edit', $report->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit Status
                                    </a>
                                    <form action="{{ route('disasters.destroy', $report->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize Master Map
    var masterMap = L.map('masterMap').setView([26.6645, 87.9914], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(masterMap);

    // Fix for sidebar layout
    setTimeout(function(){ masterMap.invalidateSize() }, 300);

    // Use a LayerGroup so we can easily clear old markers when refreshing
    var markersLayer = L.layerGroup().addTo(masterMap);

    // Function to fetch and draw markers
    function loadLiveDisasters() {
        fetch('{{ route("api.disasters") }}')
            .then(response => response.json())
            .then(data => {
                markersLayer.clearLayers(); // Remove old pins
                
                data.forEach(function(report) {
                    L.marker([report.latitude, report.longitude]).addTo(markersLayer)
                        .bindPopup(
                            '<b>Disaster:</b> ' + report.disaster_type + '<br>' +
                            '<b>Status:</b> ' + report.status + '<br>' +
                            '<b>Description:</b> ' + report.description
                        );
                });
            })
            .catch(error => console.error("Error fetching live disasters: " + error));
    }

    // Load immediately
    loadLiveDisasters();
    // Refresh every 5 seconds
    setInterval(loadLiveDisasters, 5000);
</script>
@endsection
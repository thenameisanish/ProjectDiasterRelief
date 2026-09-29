@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-4">Admin Dashboard </h2>

    <div class="row mb-4">
        <!-- Affected Areas -->
        <div class="col-md-2">
            <div class="card text-white bg-danger shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Affected Areas</h5>
                    <h2 class="mb-0" id="stat-affected">{{ $affectedAreas }}</h2>
                    <small>Active Disasters</small>
                </div>
            </div>
        </div>
        
        <!-- Lost Lives -->
        <div class="col-md-2">
            <div class="card text-white bg-dark shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Lost Lives</h5>
                    <h2 class="mb-0" id="stat-lost">{{ $lostLives }}</h2>
                    <small>Deceased Found</small>
                </div>
            </div>
        </div>
        
        <!-- Missing People -->
        <div class="col-md-2">
            <div class="card text-white bg-warning shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Missing People</h5>
                    <h2 class="mb-0" id="stat-missing">{{ $missingPeople }}</h2>
                    <small>Still Missing</small>
                </div>
            </div>
        </div>
        
        <!-- Holding Centers -->
        <div class="col-md-2">
            <div class="card text-white bg-success shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Holding Centers</h5>
                    <h2 class="mb-0" id="stat-centers">{{ $holdingCenters }}</h2>
                    <small>Active Shelters</small>
                </div>
            </div>
        </div>

        <!-- Donations -->
        <div class="col-md-2">
            <div class="card text-white bg-info shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Donations</h5>
                    <h2 class="mb-0" id="stat-donations">Rs. {{ number_format($donations, 2) }}</h2>
                    <small>Verified Funds</small>
                </div>
            </div>
        </div>

        <!-- Relief Materials -->
        <div class="col-md-2">
            <div class="card text-white bg-secondary shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Relief Items</h5>
                    <h2 class="mb-0" id="stat-relief">{{ $reliefMaterials }}</h2>
                    <small>Total Materials</small>
                </div>
            </div>
        </div>
    </div>

    

<!-- JavaScript for Real-Time Polling -->
<script>
    // Function to update the UI
    function updateStats(data) {
        document.getElementById('stat-affected').innerText = data.affectedAreas;
        document.getElementById('stat-lost').innerText = data.lostLives;
        document.getElementById('stat-missing').innerText = data.missingPeople;
        document.getElementById('stat-centers').innerText = data.holdingCenters;
        document.getElementById('stat-donations').innerText = "Rs. " + parseFloat(data.donations).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        document.getElementById('stat-relief').innerText = data.reliefMaterials;
    }

    // Ask the server for new stats every 5 seconds
    setInterval(function() {
        fetch('{{ route("api.stats") }}')
            .then(response => response.json())
            .then(data => {
                updateStats(data);
            })
            .catch(error => console.error("Error fetching live stats: " + error));
    }, 5000); // 5000 ms = 5 seconds
</script>
@endsection
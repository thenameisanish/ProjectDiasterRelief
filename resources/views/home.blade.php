@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Admin Dashboard</h2>

        <div class="row mb-4">
        <!-- Affected Areas -->
        <div class="col-md-2">
            <div class="card text-white bg-danger shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Affected Areas</h5>
                    <h2 class="mb-0">{{ $affectedAreas }}</h2>
                    
                </div>
            </div>
        </div>
        
        <!-- Lost Lives -->
        <div class="col-md-2">
            <div class="card text-white bg-dark shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Lost Lives</h5>
                    <h2 class="mb-0">{{ $lostLives }}</h2>
                    
                </div>
            </div>
        </div>
        
        <!-- Missing People -->
        <div class="col-md-2">
            <div class="card text-white bg-warning shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Missing People</h5>
                    <h2 class="mb-0">{{ $missingPeople }}</h2>
                    
                </div>
            </div>
        </div>
        
        <!-- Holding Centers -->
        <div class="col-md-2">
            <div class="card text-white bg-success shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Holding Centers</h5>
                    <h2 class="mb-0">{{ $holdingCenters }}</h2>
                    
                </div>
            </div>
        </div>

        <!-- Donations -->
        <div class="col-md-2">
            <div class="card text-white bg-info shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Donations</h5>
                     <h2 class="mb-0">Rs {{ number_format($donations) }}</h2>
                    
                </div>
            </div>
        </div>

        <!-- Relief Materials -->
        <div class="col-md-2">
            <div class="card text-white bg-secondary shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Relief Items</h5>
                    <h2 class="mb-0">{{ $reliefMaterials }}</h2>
                    
                </div>
            </div>
        </div>
    </div>
        
            </div>
        </div>
        
    </div>
</div>
@endsection
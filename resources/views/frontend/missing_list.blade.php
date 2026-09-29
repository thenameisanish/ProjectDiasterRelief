@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-4"><i class="fas fa-walking text-info"></i> Missing Persons Reports</h2>
    
    <div class="row">
        @foreach($missingPeople as $person)
            <div class="col-md-3 mb-4">
                <div class="card shadow h-100">
                    @if($person->image)
                        <img src="{{ asset('storage/'.$person->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=No+Photo" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $person->name }}</h5>
                        <p class="card-text small mb-1"><i class="fas fa-map-marker-alt text-danger"></i> {{ $person->last_seen_location }}</p>
                        <p class="card-text small mb-1">Age: {{ $person->age }} | Gender: {{ $person->gender }}</p>
                        
                        @if($person->status == 'Missing')
                            <span class="badge bg-warning text-dark w-100 p-2">MISSING</span>
                        @elseif($person->status == 'Found Alive')
                            <span class="badge bg-success w-100 p-2">FOUND ALIVE</span>
                        @else
                            <span class="badge bg-dark w-100 p-2">FOUND DEAD</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
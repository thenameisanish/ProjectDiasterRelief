@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Missing Persons List</h2>
        <a href="{{ route('missing.create') }}" class="btn btn-warning text-dark">Add Person</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Last Seen</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($missingPeople as $person)
                            <tr>
                                <td>
                                    @if($person->image)
                                        <img src="{{ asset('storage/'.$person->image) }}" alt="{{ $person->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                    @else
                                        <img src="https://via.placeholder.com/50" alt="No Image" style="width: 50px; height: 50px; border-radius: 50%;">
                                    @endif
                                </td>
                                <td>{{ $person->name }}</td>
                                <td>{{ $person->age ?? 'N/A' }}</td>
                                <td>{{ $person->gender ?? 'N/A' }}</td>
                                <td>{{ $person->last_seen_location }}</td>
                                <td>
                                    @if($person->status == 'Missing')
                                        <span class="badge bg-warning text-dark">{{ $person->status }}</span>
                                    @elseif($person->status == 'Found Alive')
                                        <span class="badge bg-success">{{ $person->status }}</span>
                                    @else
                                        <span class="badge bg-dark">{{ $person->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('missing.edit', $person->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Update Status
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
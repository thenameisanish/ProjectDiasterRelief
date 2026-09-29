@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Holding Centers</h2>
        <a href="{{ route('shelters.create') }}" class="btn btn-success">Add New Shelter</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Capacity</th>
                        <th>Location (Lat, Lng)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shelters as $shelter)
                        <tr>
                            <td>{{ $shelter->name }}</td>
                            <td>{{ $shelter->location }}</td>
                            <td>{{ $shelter->capacity }}</td>
                            <td>{{ $shelter->latitude }}, {{ $shelter->longitude }}</td>
                            <td>
                                <form action="{{ route('shelters.destroy', $shelter->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Disaster Reports</h2>
        <a href="{{ route('disasters.create') }}" class="btn btn-danger">Report New Disaster</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
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
                                    <span class="badge bg-warning text-dark">Active</span>
                                @else
                                    <span class="badge bg-success">Contained</span>
                                @endif
                            </td>
                            <td>{{ $report->latitude }}, {{ $report->longitude }}</td>
                            <td>
                                <a href="{{ route('disasters.edit', $report->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('disasters.destroy', $report->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this report?')">Delete</button>
                                </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
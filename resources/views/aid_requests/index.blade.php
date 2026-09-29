@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-4"><i class="fas fa-hands-helping text-warning"></i> User Aid Requests</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Requester</th>
                        <th>Contact</th>
                        <th>Location</th>
                        <th>Need</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aidRequests as $request)
                        <tr>
    <td>{{ $request->requester_name }}</td>
    <td>{{ $request->contact_number }}</td>
    <td>{{ $request->location }}</td>
    <td><span class="badge bg-info text-dark">{{ $request->resource_needed }}</span></td>
    <td>{{ $request->quantity }} {{ $request->unit }}</td> <!-- Combined Qty and Unit -->
    <td>
        @if($request->status == 'Pending')
            <span class="badge bg-warning text-dark">Pending</span>
        @else
            <span class="badge bg-success">Approved</span>
        @endif
    </td>
    <td>
        @if($request->status == 'Pending')
            <a href="{{ route('aid_requests.approve', $request->id) }}" class="btn btn-sm btn-success">
                <i class="fas fa-check"></i> Approve
            </a>
        @else
            <span class="text-muted small">No action needed</span>
        @endif
    </td>
</tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
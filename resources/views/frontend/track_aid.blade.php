@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0"><i class="fas fa-search"></i> Track Your Aid Request</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">Enter the phone number you used when submitting the aid request to check its current status.</p>
                    
                    <form action="{{ route('user.search_aid') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="contact_number" class="form-control" placeholder="e.g., 9801234567" required value="{{ old('contact_number') }}">
                            <button class="btn btn-info text-white" type="submit"><i class="fas fa-search"></i> Check Status</button>
                        </div>
                    </form>

                    <hr>

                    @if(isset($requests))
                        @if($requests->isEmpty())
                            <div class="alert alert-warning text-center">No aid requests found for this phone number.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Resource Needed</th>
                                            <th>Quantity</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($requests as $req)
                                            <tr>
                                                <td>{{ $req->resource_needed }}</td>
                                                <td>{{ $req->quantity }} {{ $req->unit }}</td>
                                                <td>{{ $req->location }}</td>
                                                <td>
    @if($req->status == 'Pending')
        <span class="badge bg-warning text-dark p-2">
            <i class="fas fa-clock"></i> Pending Admin Approval
        </span>
    @elseif($req->status == 'Approved')
        <span class="badge bg-success p-2">
            <i class="fas fa-truck"></i> Approved! Out for Delivery
        </span>
    @elseif($req->status == 'Declined')
        <span class="badge bg-danger p-2">
            <i class="fas fa-ban"></i> Request Declined
        </span>
    @endif
</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
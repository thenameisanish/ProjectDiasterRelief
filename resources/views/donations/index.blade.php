@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Donations History</h2>
        <a href="{{ route('donations.create') }}" class="btn btn-success">Record New Donation</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Donor Name</th>
                        <th>Type</th>
                        <th>Description / Amount</th>
                        <th>Date Recorded</th>
                        <th>Actions</th>
                    </tr>
                </thead>
               <tbody>
                @foreach($donations as $donation)
                    <tr>
                        <td>{{ $donation->donor_name }}</td>
                        <td>
                            @if($donation->type == 'Cash')
                                <span class="badge bg-primary">{{ $donation->type }}</span>
                            @else
                                <span class="badge bg-info text-dark">{{ $donation->type }}</span>
                            @endif
                        </td>
                        <td>{{ $donation->item_description }}</td>
                        <td>{{ $donation->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('donations.edit', $donation->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('donations.destroy', $donation->id) }}" method="POST" style="display:inline;">
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
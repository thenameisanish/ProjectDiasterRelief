@extends('layouts.app')

@section('content')
 <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Infrastructure Damage Assessment</h2>
        <div>
            <a href="{{ route('damages.pdf') }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Download PDF</a>
            <a href="{{ route('damages.create') }}" class="btn btn-secondary">Record New Damage</a>
        </div>
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
                            <th>Infrastructure</th>
                            <th>Quantity</th>
                            <th>Severity</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($damages as $damage)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $damage->infrastructure_type }}</span></td>
                                <td>{{ $damage->quantity }}</td>
                                <td>
                                    @if($damage->severity == 'Minor')
                                        <span class="badge bg-info text-dark">{{ $damage->severity }}</span>
                                    @elseif($damage->severity == 'Major')
                                        <span class="badge bg-warning text-dark">{{ $damage->severity }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ $damage->severity }}</span>
                                    @endif
                                </td>
                                <td>{{ $damage->location }}</td>
                                <td>{{ $damage->description ?? 'N/A' }}</td>
                                <td>
                                    <form action="{{ route('damages.destroy', $damage->id) }}" method="POST" style="display:inline;">
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
@endsection
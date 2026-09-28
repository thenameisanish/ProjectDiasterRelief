@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📰 News & Weather Updates</h2>
        @auth
            <a href="{{ route('weather.create') }}" class="btn btn-info text-white">Add New Report</a>
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($reports as $report)
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <img src="{{ asset('storage/'.$report->image) }}" class="card-img-top" alt="News Image" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $report->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted" style="font-size: 0.8rem;">{{ $report->created_at->format('M d, Y h:i A') }}</h6>
                        <p class="card-text">{{ Str::limit($report->content, 100) }}</p>
                    </div>
                    @auth
                        <div class="card-footer bg-light border-top-0">
                            <form action="{{ route('weather.destroy', $report->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Are you sure you want to delete this news?')">Delete Report</button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
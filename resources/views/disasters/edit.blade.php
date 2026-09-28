@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Update Disaster Status</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('disasters.update', $disaster->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Disaster Type</label>
                            <select name="disaster_type" class="form-select" required>
                                @php $types = ['Flood','Earthquake','Fire','Landslide','Pandemic','Other']; @endphp
                                @foreach($types as $type)
                                    <option value="{{ $type }}" {{ $disaster->disaster_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Update Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Active" {{ $disaster->status == 'Active' ? 'selected' : '' }}>Active (Show on Dashboard)</option>
                                <option value="Contained" {{ $disaster->status == 'Contained' ? 'selected' : '' }}>Contained</option>
                                <option value="Resolved" {{ $disaster->status == 'Resolved' ? 'selected' : '' }}>Resolved (Remove from Dashboard)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" required>{{ $disaster->description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 text-dark">Update Disaster</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
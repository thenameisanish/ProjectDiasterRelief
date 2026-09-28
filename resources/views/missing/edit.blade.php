@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Missing Person</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Note the enctype for file uploads and the PUT method for updates -->
                    <form action="{{ route('missing.update', $person->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $person->name }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Age</label>
                                <input type="number" name="age" min="1" max="95" class="form-control" value="{{ $person->age }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select" required>
                                    <option value="Male" {{ $person->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $person->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ $person->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Last Seen Location</label>
                            <input type="text" name="last_seen_location" class="form-control" value="{{ $person->last_seen_location }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Update Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Missing" {{ $person->status == 'Missing' ? 'selected' : '' }}>Missing</option>
                                <option value="Found Alive" {{ $person->status == 'Found Alive' ? 'selected' : '' }}>Found Alive</option>
                                <option value="Found Dead" {{ $person->status == 'Found Dead' ? 'selected' : '' }}>Found Dead</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Current Photo</label>
                            <div class="mb-2">
                                @if($person->image)
                                    <img src="{{ asset('storage/'.$person->image) }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                                @else
                                    <span class="text-muted">No photo on file.</span>
                                @endif
                            </div>
                            <label class="form-label">Upload New Photo (Optional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Add Missing Person</h4>
                </div>
                <div class="card-body">
                    <!-- Global Error Alert -->
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

                    <form action="{{ route('missing.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Age</label>
                                <input type="number" name="age" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}" required min ="0" max="100">
                                @error('age')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
    <label class="form-label">Person's Photo</label>
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                            <div class="col-md-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                    <option value="">Select...</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Last Seen Location</label>
                            <input type="text" name="last_seen_location" class="form-control @error('last_seen_location') is-invalid @enderror" value="{{ old('last_seen_location') }}" required>
                            @error('last_seen_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="Missing" {{ old('status') == 'Missing' ? 'selected' : '' }}>Missing</option>
                                <option value="Found Alive" {{ old('status') == 'Found Alive' ? 'selected' : '' }}>Found Alive</option>
                                <option value="Found Dead" {{ old('status') == 'Found Dead' ? 'selected' : '' }}>Found Dead</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-warning w-100 text-dark">Save Person</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
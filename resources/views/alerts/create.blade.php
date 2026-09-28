@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Broadcast New Alert</h4>
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

                    <form action="{{ route('alerts.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Alert Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g., Flash Flood Warning" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Severity Level</label>
                            <select name="severity" class="form-select @error('severity') is-invalid @enderror" required>
                                <option value="">Select...</option>
                                <option value="Info" {{ old('severity') == 'Info' ? 'selected' : '' }}>Info (Blue)</option>
                                <option value="Warning" {{ old('severity') == 'Warning' ? 'selected' : '' }}>Warning (Yellow)</option>
                                <option value="Critical" {{ old('severity') == 'Critical' ? 'selected' : '' }}>Critical (Red)</option>
                            </select>
                            @error('severity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alert Message</label>
                            <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="4" placeholder="Write the details of the alert here..." required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger w-100">🚨 Broadcast Alert</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
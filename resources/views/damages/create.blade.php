@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0"><i class="fas fa-broken-building"></i> Record Infrastructure Damage</h4>
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

                    <form action="{{ route('damages.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Infrastructure Type</label>
                                <select name="infrastructure_type" class="form-select" required>
                                    <option value="House">House</option>
                                    <option value="Road">Road</option>
                                    <option value="Bridge">Bridge</option>
                                    <option value="School">School</option>
                                    <option value="Hospital">Hospital</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="quantity" class="form-control" min="1" placeholder="e.g., 50" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Severity</label>
                                <select name="severity" class="form-select" required>
                                    <option value="Minor">Minor</option>
                                    <option value="Major" selected>Major</option>
                                    <option value="Completely Destroyed">Completely Destroyed</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Affected Location</label>
                            <input type="text" name="location" class="form-control" placeholder="e.g., Birtamod-5" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description (Optional)</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Brief details of the damage..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-secondary w-100">Save Damage Report</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
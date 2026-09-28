@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Record Donation</h4>
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

                    <form action="{{ route('donations.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Donor Name</label>
                            <input type="text" name="donor_name" class="form-control @error('donor_name') is-invalid @enderror" value="{{ old('donor_name') }}" required>
                            @error('donor_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                       <div class="row mb-3">
    <div class="col-md-4">
        <label class="form-label">Donation Type</label>
        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
            <option value="">Select...</option>
            <option value="Cash" {{ old('type') == 'Cash' ? 'selected' : '' }}>Cash</option>
            <option value="Item" {{ old('type') == 'Item' ? 'selected' : '' }}>Item (Food, Clothes, etc.)</option>
        </select>
        @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Amount (Rs)</label>
        <input type="number" name="amount" step="0.01" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" placeholder="e.g., 500.00" required>
        @error('amount')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Description</label>
        <input type="text" name="item_description" class="form-control @error('item_description') is-invalid @enderror" value="{{ old('item_description') }}" placeholder="e.g., For food supplies" required>
        @error('item_description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
                        <button type="submit" class="btn btn-success w-100">Save Donation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
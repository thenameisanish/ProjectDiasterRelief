@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Edit Donation</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('donations.update', $donation->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Donor Name</label>
                            <input type="text" name="donor_name" class="form-control" value="{{ $donation->donor_name }}" required>
                        </div>

                       <div class="row mb-3">
    <div class="col-md-4">
        <label class="form-label">Donation Type</label>
        <select name="type" class="form-select" required>
            <option value="Cash" {{ $donation->type == 'Cash' ? 'selected' : '' }}>Cash</option>
            <option value="Item" {{ $donation->type == 'Item' ? 'selected' : '' }}>Item</option>
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Amount ($)</label>
        <input type="number" name="amount" step="0.01" class="form-control" value="{{ $donation->amount }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Description</label>
        <input type="text" name="item_description" class="form-control" value="{{ $donation->item_description }}" required>
    </div>
</div>

                        <button type="submit" class="btn btn-success w-100">Update Donation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
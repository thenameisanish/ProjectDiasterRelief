@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add Relief Material</h4>
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

                    <form action="{{ route('relief.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Material Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
<div class="row mb-3">
    <div class="col-md-4">
        <label class="form-label">Category</label>
        <select name="category" class="form-select @error('category') is-invalid @enderror" required>
            <option value="">Select...</option>
            <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>Food</option>
            <option value="Water" {{ old('category') == 'Water' ? 'selected' : '' }}>Water</option>
            <option value="Medical" {{ old('category') == 'Medical' ? 'selected' : '' }}>Medical</option>
            <option value="Tent" {{ old('category') == 'Tent' ? 'selected' : '' }}>Tent</option>
            <option value="Clothing" {{ old('category') == 'Clothing' ? 'selected' : '' }}>Clothing</option>
            <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
        </select>
        @error('category')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Quantity</label>
        <input type="number" name="quantity" min="1" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" required>
        @error('quantity')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Unit</label>
        <select name="unit" class="form-select @error('unit') is-invalid @enderror" required>
            <option value="">Select...</option>
            <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>Kg</option>
            <option value="bag" {{ old('unit') == 'bag' ? 'selected' : '' }}>Bag</option>
            <option value="piece" {{ old('unit') == 'piece' ? 'selected' : '' }}>Piece</option>
            <option value="bottle" {{ old('unit') == 'bottle' ? 'selected' : '' }}>Bottle</option>
            <option value="box" {{ old('unit') == 'box' ? 'selected' : '' }}>Box</option>
            <option value="litre" {{ old('unit') == 'litre' ? 'selected' : '' }}>Litre</option>
        </select>
        @error('unit')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

                        <button type="submit" class="btn btn-primary w-100">Add Material</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
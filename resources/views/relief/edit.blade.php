@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Relief Material</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('relief.update', $material->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Material Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $material->name }}" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-select" required>
                                    @php $cats = ['Food','Water','Medical','Tent','Clothing','Other']; @endphp
                                    @foreach($cats as $cat)
                                        <option value="{{ $cat }}" {{ $material->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="quantity" min="1" class="form-control" value="{{ $material->quantity }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Unit</label>
                                <select name="unit" class="form-select" required>
                                    @php $units = ['kg','bag','piece','bottle','box','litre']; @endphp
                                    @foreach($units as $u)
                                        <option value="{{ $u }}" {{ $material->unit == $u ? 'selected' : '' }}>{{ $u }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Material</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
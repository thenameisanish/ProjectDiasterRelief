@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0"><i class="fas fa-hands-helping"></i> Request Aid</h4>
                </div>
                <div class="card-body">
                    <!-- Out of Stock Error Message -->
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        </div>
                    @endif

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

                    <form action="{{ route('aid_requests.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Your Name (Optional)</label>
                                <input type="text" name="requester_name" class="form-control" placeholder="Leave blank for Anonymous">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Number</label>
                                <input type="text" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror" placeholder="98XXXXXXXX" required pattern="^(97|98)[0-9]{8}$" title="Phone number must start with 97 or 98 and be 10 digits long.">
                                @error('contact_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> <!-- Closing tag for the first row was missing, added it here -->

                        <div class="mb-3">
                            <label class="form-label">Your Location / Address</label>
                            <input type="text" name="location" class="form-control" placeholder="e.g., Near Birtamod Hospital" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">What do you need?</label>
                                <select name="resource_needed" class="form-select" required>
                                    <option value="">Select Resource...</option>
                                
                                    <option value="Food">Food</option>
                                    <option value="Water">Drinking Water</option>
                                    <option value="Medicine">Medicine</option>
                                    <option value="Blanket">Blankets</option>
                                    <option value="Tent">Tents/Shelter</option>
                                    <option value="Clothing">Clothing</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Qty</label>
                                <input type="number" name="quantity" class="form-control" min="1" placeholder="e.g., 5" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Unit</label>
                                <select name="unit" class="form-select" required>
                                    <option value="kg">Kg</option>
                                    <option value="bag">Bag</option>
                                    <option value="piece">Piece</option>
                                    <option value="bottle">Bottle</option>
                                    <option value="box">Box</option>
                                    <option value="litre">Litre</option>
                                   
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Priority</label>
                                <select name="priority" class="form-select" required>
                                    <option value="High">High</option>
                                    <option value="Medium" selected>Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 text-dark fw-bold">Submit Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
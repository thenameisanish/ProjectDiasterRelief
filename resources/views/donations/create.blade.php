@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-hand-holding-usd"></i> Donate Funds</h4>
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

                    <div class="row">
                        <!-- Left Side: Form -->
                        <div class="col-md-7">
                            <form action="{{ route('donations.store') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label class="form-label">Donor Name</label>
                                    <input type="text" name="donor_name" class="form-control" placeholder="Your Name" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Amount (Rs.)</label>
                                    <input type="number" name="amount" id="amount" class="form-control" min="1" placeholder="Enter amount (e.g., 500)" required oninput="generateQR()">
                                </div>

                                <!-- NEW: Transaction ID Field -->
                                <div class="mb-3">
                                    <label class="form-label">Transaction ID / UTR No.</label>
                                    <input type="text" name="transaction_id" class="form-control" placeholder="Enter reference number from your payment app" required>
                                    <small class="text-muted">Please enter the Transaction ID you received after making the payment.</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Message (Optional)</label>
                                    <input type="text" name="item_description" class="form-control" placeholder="e.g., For food supplies">
                                </div>

                                <button type="submit" class="btn btn-success w-100"><i class="fas fa-check-circle"></i> Submit Donation</button>
                            </form>
                        </div>

                        <!-- Right Side: Live QR Code -->
                        <div class="col-md-5 text-center d-flex flex-column justify-content-center">
                            <h5 class="mb-3">Scan to Pay via QR</h5>
                            <img id="qrCode" src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=upi://pay?pa=relief@upi&pn=DisasterRelief&am=100" alt="QR Code" class="img-fluid border p-2 rounded shadow-sm mx-auto" style="max-width: 200px;">
                            <p class="text-muted small mt-2">QR Code updates automatically as you type the amount.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to generate live QR code -->
<script>
    function generateQR() {
        let amount = document.getElementById('amount').value;
        if (!amount || amount <= 0) {
            amount = 1; // Default to 1 if empty to avoid invalid QR
        }
        
        // Simulated UPI Payment String 
        let upiString = `upi://pay?pa=relief@upi&pn=DisasterRelief&am=${amount}&cu=NPR`;
        
        // Generate QR Code using free API
        let qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(upiString)}`;
        
        document.getElementById('qrCode').src = qrUrl;
    }
</script>
@endsection
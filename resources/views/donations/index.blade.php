@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Donations History </h2>
        <a href="{{ route('donations.exportCsv') }}" class="btn btn-success">
            <i class="fas fa-file-csv"></i> Generate CSV Report
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Donor Name</th>
                            <th>Amount (Rs.)</th>
                            <th>Transaction ID</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <!-- Give the tbody an ID so JS can update it -->
                    <tbody id="donations-tbody">
                        <!-- JavaScript will fill this in -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function loadLiveDonations() {
        fetch('{{ route("api.donations") }}')
            .then(response => response.json())
            .then(data => {
                let tbody = document.getElementById('donations-tbody');
                tbody.innerHTML = ''; // Clear old rows

                data.forEach(donation => {
                    let date = new Date(donation.created_at).toLocaleDateString();
                    let statusBadge = donation.status === 'verified' 
                        ? '<span class="badge bg-success">Verified</span>' 
                        : '<span class="badge bg-warning text-dark">Pending</span>';
                    
                    let actionButton = donation.status === 'pending' 
                        ? `<a href="/donations/${donation.id}/verify" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Verify</a>` 
                        : '<span class="text-muted small">No action</span>';

                    tbody.innerHTML += `
                        <tr>
                            <td>${donation.donor_name}</td>
                            <td class="fw-bold text-success">Rs. ${parseFloat(donation.amount).toFixed(2)}</td>
                            <td><code>${donation.transaction_id || 'N/A'}</code></td>
                            <td>${statusBadge}</td>
                            <td>${date}</td>
                            <td>
                                ${actionButton}
                                <form action="/donations/${donation.id}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error("Error fetching live donations: " + error));
    }

    // Load immediately
    loadLiveDonations();
    // Refresh every 5 seconds
    setInterval(loadLiveDonations, 5000);
</script>
@endsection
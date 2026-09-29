@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-4"><i class="fas fa-newspaper text-primary"></i> News & Weather Updates</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @if($news->isEmpty())
            <div class="col-12">
                <div class="alert alert-secondary text-center">No news or weather updates currently. Stay safe!</div>
            </div>
        @else
            @foreach($news as $report)
                <div class="col-md-4 mb-4">
                    <div class="card shadow h-100">
                        <img src="{{ asset('storage/'.$report->image) }}" class="card-img-top clickable-img" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-img="{{ asset('storage/'.$report->image) }}" style="height: 200px; object-fit: cover; cursor: pointer;">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $report->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted" style="font-size: 0.8rem;">{{ $report->created_at->format('M d, Y h:i A') }}</h6>
                            <p class="card-text">{{ $report->content }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<!-- Full Image Modal (Lightbox) -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body text-center p-0">
                <img src="" id="modalImage" class="img-fluid rounded shadow" style="max-height: 80vh; width: 100%; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<script>
    // Handle Image Modal Click (Lightbox)
    document.addEventListener('DOMContentLoaded', function() {
        var imageModal = document.getElementById('imageModal');
        imageModal.addEventListener('show.bs.modal', function (event) {
            var triggerImage = event.relatedTarget;
            var imgSrc = triggerImage.getAttribute('data-bs-img');
            var modalImage = document.getElementById('modalImage');
            modalImage.src = imgSrc;
        });
    });
</script>
@endsection
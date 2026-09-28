@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Publish Weather / News Report</h4>
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

                    <form action="{{ route('weather.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">News Title</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g., Heavy Rainfall Warning" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Report Details</label>
                            <textarea name="content" class="form-control" rows="4" placeholder="Write the news or weather details here..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                        </div>

                        <button type="submit" class="btn btn-info w-100 text-white">Publish Report</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
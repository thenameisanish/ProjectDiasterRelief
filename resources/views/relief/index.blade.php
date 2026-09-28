@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Relief Materials Inventory</h2>
        <a href="{{ route('relief.create') }}" class="btn btn-primary">Add New Material</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                    <tbody>
                @foreach($materials as $material)
                    <tr>
                        <td>{{ $material->name }}</td>
                        <td><span class="badge bg-info text-dark">{{ $material->category }}</span></td>
                        <td>{{ $material->quantity }}</td>
                        <td>{{ $material->unit }}</td>
                        <td>
                            <a href="{{ route('relief.edit', $material->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('relief.destroy', $material->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
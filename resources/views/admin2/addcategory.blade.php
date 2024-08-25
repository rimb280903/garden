@extends('admin2.dashboard')

@section('content')
    <div class="container">
        <h1>Create Category</h1>
        <form method="POST" action="{{ route('admin2.category.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nom_C" class="form-label">Category Name</label>
                <input type="text" class="form-control @error('nom_C') is-invalid @enderror" id="nom_C" name="nom_C"
                    value="{{ old('nom_C') }}" required>
                @error('nom_C')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description_C" class="form-label">Description</label>
                <textarea class="form-control" id="description_C" name="description_C" rows="3">{{ old('description_C') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="image_C" class="form-label">Image <i class="uil uil-image"></i></label>
                <input type="file" class="form-control @error('image_C') is-invalid @enderror" id="image_C"
                    name="image_C">
                @error('image_C')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary container">Create <i class="uil uil-plus"></i></button>
        </form>
    </div>
@endsection

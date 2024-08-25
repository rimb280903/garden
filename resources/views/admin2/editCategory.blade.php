@extends('admin2.dashboard')
@section('content')
    <div class="container mt-2">
        <form action="{{ route('admin2.category.update', $category->id) }}" method="POST">
            @csrf
            @method('patch')

            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('/assets/images/dynamic/' . $category->image_C) }}" alt="{{ $category->nom_C }}"
                        class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nom_C">Nom</label>
                        <input type="text" name="nom_C" id="nom_C" class="form-control"
                            value="{{ $category->nom_C }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description_C">Description</label>
                        <textarea name="description_C" id="description_C" class="form-control" rows="5" required>{{ $category->description_C }}</textarea>
                    </div>

                    <center> <button type="submit" class="btn btn-primary">Modifier <i
                                class="uil uil-edit-alt"></i></button></center>
                </div>
            </div>
        </form>
    @endsection

@extends('admin2.dashboard')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ajouter Produit') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin2.product.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nom_P" class="form-label">{{ __('Nom Produit') }}</label>
                                <input id="nom_P" type="text"
                                    class="form-control @error('nom_P') is-invalid @enderror" name="nom_P"
                                    value="{{ old('nom_P') }}" required autofocus>
                                @error('nom_P')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description_P" class="form-label">{{ __('Description') }}</label>
                                <textarea id="description_P" class="form-control @error('description_P') is-invalid @enderror" name="description_P"
                                    required>{{ old('description_P') }}</textarea>
                                @error('description_P')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="prix_base" class="form-label">{{ __('Prix Base') }}</label>
                                <input id="prix_base" type="number"
                                    class="form-control @error('prix_base') is-invalid @enderror" name="prix_base"
                                    value="{{ old('prix_base') }}" required>
                                @error('prix_base')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="id_Categorie" class="form-label">{{ __('Catégorie') }}</label>
                                <select id="id_Categorie" class="form-control @error('id_Categorie') is-invalid @enderror"
                                    name="id_Categorie" required>
                                    <option value="">{{ __('Select Category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('id_Categorie') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nom_C }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_Categorie')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @error('id_Categorie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image_path" class="form-label">{{ __('Image') }}</label>
                                <input id="image_path" type="file"
                                    class="form-control  @error('image_path') is-invalid @enderror" name="image_path"
                                    required>
                                @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-grid gap-2 d-flex justify-content-center  ">
                                <button type="submit" class="btn btn-primary">{{ __('Ajouter Produit') }} <i
                                        class="uil uil-plus"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            @endsection

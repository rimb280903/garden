@extends('admin2.dashboard')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ajouter Blog') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin2.blog.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">{{ __('Blog Title') }}</label>
                                <input id="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                    value="{{ old('title') }}" required autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                    required rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                           
                            <div class="form-group my-2">
                                <label for="image_path">Image</label>
                                
                                <input id="image_path" type="file" class="form-control  @error('image_path') is-invalid @enderror"
                                    name="image_path" >
                                @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    
                    
                            <div class="form-group my-2">
                                <label for="tags">Tags</label>
                    
                                <div id="tag-inputs">
                                    
                                        <div class="d-flex tag-row">
                                            <div class="form-group flex-grow-1 mr-2">
                                                <select name="tag_names[]" class="form-control my-1">
                                                    @foreach ($tags as $t)
                                                        <option value="{{ $t->id }}">
                                                            {{ $t->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-danger remove-tag"><i class="uil uil-minus"></i></button>
                                        </div>
                                   
                                </div>
                    
                                <button type="button" class="btn btn-success add-tag"><i class="uil uil-plus"></i> Add Tag</button>
                            </div>
                    
                            <button type="submit" class="btn btn-primary" onclick="dataValidationAlert()">Save</button>
                        </form>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        // Add tag input field
                        $(document).on('click', '.add-tag', function() {
                            var tagInputs = $('#tag-inputs');
                            var tagInput = $(
                                '<div class="d-flex tag-row"><div class="form-group flex-grow-1 mr-2"><select name="tag_names[]" class="form-control my-1">@foreach ($tags as $t)<option value="{{ $t->id }}">{{ $t->name }}</option>@endforeach</select></div><button type="button" class="btn btn-danger remove-tag"><i class="uil uil-minus"></i></button></div>'
                                );
            
                            tagInputs.append(tagInput);
                        });
            
                        // Remove tag input field
                        $(document).on('click', '.remove-tag', function() {
                            $(this).closest('.tag-row').remove();
                        });
                    });
            
                    function dataValidationAlert() {
                            Swal.fire({
                                title: 'Validating your information',
                                icon: 'info',
                                timer: 1000,
                                showConfirmButton: false
                            });
                        }
                </script>
@endsection


           
    
      

    

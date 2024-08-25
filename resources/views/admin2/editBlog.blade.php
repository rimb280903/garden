@extends('admin2.dashboard')
@section('content')
    <form method="POST" action="{{route('admin2.blog.update',$blog->id)}}"  enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $blog->title) }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $blog->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image_path">Image</label>
            @if ($blog->image_path)
                <div>
                    <img src="/assets/images/dynamic/{{ $blog->image_path }}" alt="Blog Image" style="max-height: 200px;">
                </div>
            @endif
            <input id="image_path" type="file" class="form-control  @error('image_path') is-invalid @enderror"
                name="image_path" >
            @error('image_path')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="form-group">
            <label for="tags">Tags</label>

            <div id="tag-inputs">
                @foreach ($blog->tags as $tag)
                    <div class="d-flex tag-row">
                        <div class="form-group flex-grow-1 mr-2">
                            <select name="tag_names[]" class="form-control">
                                @foreach ($tags as $t)
                                    <option value="{{ $t->id }}" {{ $tag->id == $t->id ? 'selected' : '' }}>
                                        {{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-danger remove-tag"><i class="uil uil-minus"></i></button>
                    </div>
                @endforeach
            </div>  

             <center><button type="button" class="btn btn-success add-tag"><i class="uil uil-plus"></i> Add Tag</button></center>
        </div>

       <center> <button type="submit" class="btn btn-primary" onclick="dataValidationAlert()">Save</button></center>
    </form>

    <script>
        $(document).ready(function() {
    // Add tag input field
    $(document).on('click', '.add-tag', function() {
        var tagInputs = $('#tag-inputs');
        var tagInput = $('<div class="d-flex tag-row"><div class="form-group flex-grow-1 mr-2"><select name="tag_names[]" class="form-control"></select></div><button type="button" class="btn btn-danger remove-tag"><i class="uil uil-minus"></i></button></div>');
        var select = tagInput.find('select');

        @foreach ($tags as $t)
            var option = $('<option value="{{ $t->id }}">{{ $t->name }}</option>');
            select.append(option);
        @endforeach

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

@extends('admin2.dashboard')
@section('content')
<center><h2> ADD MULTIPLE TAGS</h2></center>
<form method="POST" action="{{route('admin2.tags.store')}}">
    @csrf
    <div id="tag-inputs">
        <div class="d-flex">
            <div class="form-group flex-grow-1 mr-2">
                <input type="text" name="tag_names[]" class="form-control" placeholder="Enter a tag name">
            </div>
            @error('tag_names.*')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <button type="button" class="btn btn-success add-tag"><i class="uil uil-plus"></i></button>
        </div>
        
    </div>
    <button type="submit" class="btn btn-primary">Done</button>
</form>

<script>
    $(document).ready(function() {
        // Add tag input field
        $(document).on('click', '.add-tag', function() {
            var tagInputs = $('#tag-inputs');
            var tagInput = $('<div class="d-flex"><div class="form-group"></div> </div>');
            var input = $('<input type="text" name="tag_names[]" class="form-control" placeholder="Enter a tag name">');
            var removeButton = $('<button type="button" class="btn btn-danger remove-tag"><i class="uil uil-minus"></i></button>');
    
            tagInput.append(input);
            tagInput.append(removeButton);
            tagInputs.append(tagInput);
        });
    
        // Remove tag input field
        $(document).on('click', '.remove-tag', function() {
            $(this).closest('.d-flex').remove();
        });
    });
    </script>
@endsection
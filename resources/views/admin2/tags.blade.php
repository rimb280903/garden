@extends('admin2.dashboard')
@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mt-2">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    



        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <a href="#" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addtagModal">Add
                    Tag <i class="uil uil-plus"></i></a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <table id="selection-datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#edittagModal{{ $tag->id }}">Edit <i
                                            class="uil uil-edit-alt"></i></a>
                                    <!-- Edit tag Modal -->
                                    <div class="modal fade" id="edittagModal{{ $tag->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="edittagModalLabel{{ $tag->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="edittagModalLabel{{ $tag->id }}">
                                                        Edit tag <i class="uil uil-edit-alt"></i></h5>
                                                    <button type="button" class="rounded-pill" data-bs-dismiss="modal"
                                                        aria-label="Close"><i class="uil uil-multiply"></i></button>


                                                </div>
                                                <form action="{{route('admin.tag.update',$tag->id)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="tag_name">tag Name</label>
                                                            <input type="text" class="form-control" id="tag_name"
                                                                name="name" value="{{ $tag->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close <i
                                                                class="uil uil-times"></i></button>

                                                        <button type="submit" class="btn btn-primary">Save Changes <i
                                                                class="uil uil-save"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Edit tag Modal -->
                                    <form id="delete-form-{{ $tag->id }}"
                                        action="{{route('admin2.tag.delete',$tag->id)}}" method="POST"
                                        class="d-inline align-items-center">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger"
                                            onclick="deleteTag({{ $tag->id }} , '{{$tag->name}}')">Delete tag <i
                                                class="uil uil-multiply"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add tag Modal -->
    <div class="modal fade" id="addtagModal" tabindex="-1" role="dialog" aria-labelledby="addtagModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addtagModal">ADD TAGS <i class="uil uil-plus-circle"></i></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="uil uil-multiply"></i></span>
                    </button>
                </div>
                <form action="{{ route('admin2.tags.store') }}" method="POST">
                    @csrf




                    <div id="tag-inputs">
                        <div class="d-flex">
                            <div class="form-group flex-grow-1 mr-2">
                                <input type="text" name="tag_names[]" class="form-control"
                                    placeholder="Enter a tag name">
                            </div>
                            @error('tag_names.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <button type="button" class="btn btn-success add-tag"><i class="uil uil-plus"></i></button>
                        </div>

                    </div>





                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close <i
                                class="uil uil-multiply"></i></button>
                        <button type="submit" class="btn btn-primary">Add Tag <i class="uil uil-plus"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Add tag input field
            $(document).on('click', '.add-tag', function() {
                var tagInputs = $('#tag-inputs');
                var tagInput = $('<div class="d-flex"><div class="form-group"></div> </div>');
                var input = $(
                    '<input type="text" name="tag_names[]" class="form-control" placeholder="Enter a tag name">'
                );
                var removeButton = $(
                    '<button type="button" class="btn btn-danger remove-tag"><i class="uil uil-minus"></i></button>'
                );

                tagInput.append(input);
                tagInput.append(removeButton);
                tagInputs.append(tagInput);
            });

            // Remove tag input field
            $(document).on('click', '.remove-tag', function() {
                $(this).closest('.d-flex').remove();
            });
        });


        function deleteTag(id,name) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            title: `Are you sure you want to delete tag ${name}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Tag has been deleted.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1000
                }).then(() => {
                    setTimeout(() => {
                        document.getElementById('delete-form-' + id).submit();
                    }, 300);
                });
            }
        });
    }
    </script>
@endsection

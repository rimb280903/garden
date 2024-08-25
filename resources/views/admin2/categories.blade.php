@extends('admin2.dashboard')
@section('content')
    @php
        use Illuminate\Support\Str;
        
    @endphp
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <div class="text-center mt-2">
            <a href="{{ route('admin2.category.add') }}" class="btn btn-success">Add Category <i class="uil uil-plus"></i></a>
        </div>

        <table class="table table-hover  dt-responsive" id="selection-datatable">

            <thead>
                <tr>
                    <th class="border-dark text-center">ID</th>
                    <th class="border-dark text-center">Image</th>
                    <th class="border-dark text-center">Name</th>
                    <th class="border-dark text-center">Description</th>
                    <th class="border-dark text-center">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($categories as $category)
                    <tr>
                        <td class="align-middle fw-bolder">
                            {{ $category->id }}
                        </td>
                        <td class="align-middle" style="cursor: pointer;">
                            <img src="/assets/images/dynamic/{{ $category->image_C }}" alt="{{ $category->nom_C }}"
                                style="max-height: 150px;" class="rounded ">
                        </td>
                        <form method="post" action="{{ route('categoryFilter') }}">
                            @csrf
                            <input type="hidden" name="category" value="{{ $category->id }}">
                            <td class="align-middle fw-bold">
                                <button class="btn fw-bolder">{{ $category->nom_C }}</button>
                            </td>
                        </form>



                        <td class="align-middle" style="cursor: pointer;">
                            @if (strlen($category->description_C) > 70)
                                {{ Str::words($category->description_C, 50, '...') }}

                                <span style="color:blue;" onclick="openModal('{{ $category->id }}')">Read More</span> 
                            @else
                                {{ $category->description_C }}
                            @endif
                        <td class="align-middle">
                            <button onclick="openModal('{{ $category->id }}')"
                                class="btn btn-warning d-inline-block fw-bold">Details <i
                                    class="uil uil-file-info-alt"></i></button>
                            <a href="{{ route('admin2.category', $category->id) }}"
                                class="btn btn-success d-inline-block fw-bold">Edit <i class="uil uil-edit-alt"></i></a>

                            <button onclick="deleteCategory('{{ $category->id }}')"
                                class="btn btn-danger d-inline-block fw-bold">Delete<i class="uil uil-times"></i></button>
                            <form id="delete-form-{{ $category->id }}"
                                action="{{ route('admin2.category.softDelete', $category->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>


                        </td>

                    </tr>
                    <div class="modal fade" id="categorymodel{{ $category->id }}" tabindex="-1"
                        aria-labelledby="categorymodel{{ $category->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        id="productModal{
                                        { $category->id }}Label">
                                        {{ $category->nom_C }}</h5>
                                    <button type="button" class="rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">x</button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6 ">
                                            <img src="{{ asset('/assets/images/dynamic/' . $category->image_C) }}"
                                                alt="{{ $category->nom_C }}" style="width: 100%; height: auto;"
                                                class="rounded-circle" />
                                        </div>
                                        <div class="col-6">
                                            <p
                                                style="font-size: 20px; font-weight: bold; text-align: center; text-decoration: underline">
                                                {{ $category->nom_C }}</p>
                                            <p style="font-size: 16px; text-align: justify;"><strong>Description:</strong>
                                                {{ $category->description_C }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>


    <script>
        function openModal(categoryid) {
            $('#categorymodel' + categoryid).modal('show');
        }

        function deleteCategory(categoryId) {
            Swal.fire({
                title: 'Are you sure you want to delete this category?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + categoryId).submit();
                }
            })
        }
    </script>
@endsection

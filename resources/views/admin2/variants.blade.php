@extends('admin2.dashboard')
@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->has('nom_V'))
            <div class="alert alert-danger">{{ $errors->first('nom_V') }}</div>
        @endif


        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <a href="#" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addVariantModal">Add
                    Variant <i class="uil uil-plus"></i></a>
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
                        @foreach ($variants as $variant)
                            <tr>
                                <td>{{ $variant->id }}</td>
                                <td>{{ $variant->nom_V }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editVariantModal{{ $variant->id }}">Edit <i
                                            class="uil uil-edit-alt"></i></a>
                                    <!-- Edit Variant Modal -->
                                    <div class="modal fade" id="editVariantModal{{ $variant->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editVariantModalLabel{{ $variant->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editVariantModalLabel{{ $variant->id }}">
                                                        Edit Variant <i class="uil uil-edit-alt"></i></h5>
                                                    <button type="button" class="rounded-pill" data-bs-dismiss="modal"
                                                        aria-label="Close"><i class="uil uil-multiply"></i></button>


                                                </div>
                                                <form action="{{ route('admin2.variants.update', $variant->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="variant_name">Variant Name</label>
                                                            <input type="text" class="form-control" id="variant_name"
                                                                name="nom_V" value="{{ $variant->nom_V }}">
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
                                    <!-- End Edit Variant Modal -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Variant Modal -->
    <div class="modal fade" id="addVariantModal" tabindex="-1" role="dialog" aria-labelledby="addVariantModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVariantModalLabel">Add Variant <i class="uil uil-plus-circle"></i></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="uil uil-multiply"></i></span>
                    </button>
                </div>
                <form action="{{ route('admin2.variants.create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="variant_name">Variant Name</label>
                            <input type="text" class="form-control" id="variant_name" name="nom_V">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close <i
                                class="uil uil-multiply"></i></button>
                        <button type="submit" class="btn btn-primary">Add Variant <i class="uil uil-plus"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

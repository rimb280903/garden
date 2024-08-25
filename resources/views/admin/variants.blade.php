@extends('admin.dashboard')
@section('content')
<div class="container mt-4">
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <a href="#" class="btn btn-primary mt-2" data-toggle="modal" data-target="#addVariantModal">Add Variant</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <table class="table table-striped rounded" id="variantsTable">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($variants as $variant)
                        <tr>
                            <td>{{ $variant->id }}</td>
                            <td>{{ $variant->nom_V }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editVariantModal{{ $variant->id }}">Edit</a>
                                <!-- Edit Variant Modal -->
                                <div class="modal fade" id="editVariantModal{{ $variant->id }}" tabindex="-1" role="dialog" aria-labelledby="editVariantModalLabel{{ $variant->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editVariantModalLabel{{ $variant->id }}">Edit Variant</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('admin.variants.update',$variant->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="variant_name">Variant Name</label>
                                                        <input type="text" class="form-control" id="variant_name" name="nom_V" value="{{ $variant->nom_V }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
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
<div class="modal fade" id="addVariantModal" tabindex="-1" role="dialog" aria-labelledby="addVariantModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVariantModalLabel">Add Variant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.variants.create')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="variant_name">Variant Name</label>
                        <input type="text" class="form-control" id="variant_name" name="nom_V">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Variant</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#variantsTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "pageLength": 5 // number of rows to show per page
    });
});
</script>
@endsection

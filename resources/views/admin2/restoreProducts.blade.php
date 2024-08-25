@extends('admin2.dashboard')

@section('content')
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

    <h1 class="mb-3 text-center">ALL DELTED PRODUCTS</h1>

    <table id="selection-datatable" class="table dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th class="border-dark">ID</th>
                <th class="border-dark">Nom Produit</th>
                <th class="border-dark">Categorie</th>
                <th class="border-dark">Prix Base </th>
                <th class="border-dark text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="align-middle border-dark fw-bold">
                        {{ $product->id }}
                    </td>
                    <td class="border-dark">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('/assets/images/dynamic/' . $product->image_path) }}" alt=""
                                style="width: 90px; height: 90px" class="rounded-circle" />

                            <div class="ms-3">
                                <p class="fw-normal mb-0 ml-1">{{ $product->nom_P }}</p>
                            </div>

                        </div>
                    </td>


                    <td class="align-middle border-dark">
                        <a href="{{ route('admin2.category', $product->category->id) }}">{{ $product->category->nom_C }}</a>

                    </td>


                    <td class="align-middle border-dark">
                        <div class="d-flex justify-content-between ">
                            <span class="fs-5 fw-bold">{{ $product->prix_base }} DH</span>
                        </div>
                    </td>


                    <td class="align-middle border-dark text-center">
                        <a href="{{ route('admin2.product.restore', $product->id) }}"
                            class="btn btn-success d-inline align-items-center"
                            onclick="restore(event,{{ $product->id }})">Restore Product <i
                                class="uil uil-edit-alt"></i></a>
                        <form id="delete-form-{{ $product->id }}"
                            action="{{ route('admin2.product.hardDelete', $product->id) }}" method="POST"
                            class="d-inline align-items-center">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="deleteProduct({{ $product->id }})">Hard
                                Delete Product
                                <i class="uil uil-multiply"></i></button>
                        </form>
                    </td>


                </tr>
            @endforeach



            <script>
                function restore(event, id) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Are you sure you want to restore this product?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, restore it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('admin2.product.restore', ':id') }}".replace(':id', id);
                        }
                    });
                }

                function deleteProduct(id) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This product will be deleted permanently!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + id).submit();
                        }

                    });
                }
            </script>

        </tbody>
    </table>
@endsection

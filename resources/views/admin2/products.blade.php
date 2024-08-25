@extends('admin2.dashboard')

@section('content')
    <h1 class="mb-3 text-center">ALL PRODUCTS</h1>

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

    <!-- Rest of the view content here -->
    </div>

    <form method="POST" class="mt-4" action="{{ route('categoryFilter') }}">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">Select a category:</label>
            <select class="form-select" id="category" name="category" onchange="(this.form.submit())">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if ($selected == $category->id) selected @endif>{{ $category->nom_C }}</option>
                @endforeach
            </select>
        </div>
        <div class="text-end">

            <a href="{{ route('admin2.products') }}" class="btn btn-success">Refresh <i class="uil uil-redo"></i></a>
        </div>

    </form>
    <div class="text-center mt-2">
        <a href="{{ route('admin2.product.add') }}" class="btn btn-success">Add Product <i class="uil uil-plus"></i></a>



    </div>


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
                        <a
                            href="{{ route('admin2.category', $product->category->id) }}">{{ $product->category->nom_C }}</a>

                    </td>


                    <td class="align-middle border-dark">
                        <div class="d-flex justify-content-between ">
                            <span class="fs-5 fw-bold">{{ $product->prix_base }} DH</span>
                        </div>
                    </td>


                    <td class="align-middle border-dark text-center">
                        <button type="button" class="btn btn-success" data-bs-toggle="productModal"
                            data-bs-target="#full-width-modal" onclick="openModal('{{ $product->id }}')">Details <i
                                class="uil uil-file-info-alt"></i> </button>
                        <a href="{{ route('admin2.product', $product->id) }}"
                            class="btn   btn-success d-inline align-items-center">Edit Variant <i
                                class="uil uil-edit-alt"></i></i></a>
                        <a href="{{ route('admin2.product.add.variant', $product->id) }}"
                            class="btn   btn-info d-inline align-items-center">Add Variant <i class="uil uil-plus"></i></a>
                        <a href="{{ route('admin2.product.delete.variant', $product->id) }}"
                            class="btn   btn-danger d-inline align-items-center">Delete Variant <i
                                class="uil uil-multiply"></i></a>
                        <form id="delete-form-{{ $product->id }}"
                            action="{{ route('admin2.product.softDelete', $product->id) }}" method="POST"
                            class="d-inline align-items-center">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger"
                                onclick="deleteProduct({{ $product->id }})">Delete Product <i
                                    class="uil uil-multiply"></i></button>
                        </form>

                    </td>

                </tr>

                <div class="modal fade " id="productModal{{ $product->id }}" tabindex="-1"
                    aria-labelledby="productModal{{ $product->id }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="productModal{{ $product->id }}Label"> {{ $product->nom_P }}
                                </h5>
                                <button type="button" class="rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">x</button>


                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6">
                                        <img src="{{ asset('/assets/images/dynamic/' . $product->image_path) }}"
                                            alt="" style="width: 100%; height: auto;" class="rounded" />
                                    </div>
                                    <div class="col-6">
                                        <p><strong>Name:</strong> {{ $product->nom_P }}</p>
                                        <p><strong>Description:</strong> {{ $product->description_P }}</p>
                                        <p><strong>Category:</strong> {{ $product->category->nom_C }}</p>
                                        <p><strong>Price base: </strong> {{ $product->prix_base }} DH</p>
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


            <script>
                function openModal(productId) {
                    $('#productModal' + productId).modal('show');
                }


                function deleteProduct(id) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this product!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Product has been deleted.',
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

        </tbody>
    </table>
@endsection

@extends('admin.dashboard')
@section('content')
@if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

<div class="text-center mt-2">
    <a href="{{route('admin.product.add')}}" class="btn btn-success">Add Product</a>
</div>
<table class="table table-bordered bg-light align-middle mb-0 mt-3 table-hover border-dark rounded" id="productTable">
    <thead class="bg-dark text-white ">
      <tr>
        <th class="border-dark">Nom Produit</th>
        <th class="border-dark">Categorie</th>
        <th class="border-dark">Prix Base </th>
        <th class="border-dark">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
    <tr ondblclick="openModal('{{ $product->id }}')" >
        <td class="border-dark">
            <div class="d-flex align-items-center">
                <img src="{{ asset("/assets/images/dynamic/".$product->image_path) }}" alt="" 
                style="width: 90px; height: 90px" class="rounded-circle" />

                <div class="ms-3">
                    <p class="fw-normal mb-0 ml-1">{{ $product->nom_P }}</p>
                </div>

            </div>
        </td>


        <td class="align-middle border-dark">
             {{ $product->category->nom_C }}
        </td>


        <td class="align-middle border-dark" >
            <div class="d-flex justify-content-between ">
                <span class="fs-5 fw-bold">{{ $product->prix_base }} DH</span>
            </div>
        </td>


        <td class="align-middle border-dark">
            <a href="{{ route('admin.product', $product->id) }}" class="btn btn-sm btn-rounded btn-success d-inline align-items-center">Edit Variant</a>
            <a href="{{ route('admin.product.add.variant', $product->id) }}" class="btn btn-sm btn-rounded btn-info d-inline align-items-center">Add Variant</a>
            <a href="{{route('admin.product.delete.variant' , $product->id)}}" class="btn btn-sm btn-rounded btn-danger d-inline align-items-center">Delete Variant</a>
        </td>
        
    </tr>

    <div class="modal fade " id="productModal{{ $product->id }}" tabindex="-1" aria-labelledby="productModal{{ $product->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModal{{ $product->id }}Label"> {{ $product->nom_P }}</h5>
                    <button type="button" class="rounded-pill" data-bs-dismiss="modal" aria-label="Close">x</button>


                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <img src="{{ asset("/assets/images/dynamic/".$product->image_path) }}" alt="" style="width: 100%; height: auto;" class="rounded" />
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
</script>

    
    
    </tbody>
  </table>
  <script>

  
$(document).ready(function() {
        $('#productTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "pageLength": 4 // number of rows to show per page
        });
    });

      function openModal(productId) {
        $('#productModal' + productId).modal('show');
    }
  </script>
@endsection

  
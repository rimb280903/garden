@extends('admin.dashboard')


@section('content')
@php
                use Illuminate\Support\Str;

@endphp
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="container">
        <div class="text-center mt-2">
            <a href="{{route('admin.category.add')}}" class="btn btn-success">Add Category</a>
    </div>

        <table class="table table-hover table-bordered rounded" style="background-color: #f8f9fa;" id="categoryTable">
            
            <thead class="bg-dark text-white">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($categories as $category)
                <tr ondblclick="openModal('{{ $category->id }}')">
                        <td class="align-middle"  style="cursor: pointer;">
                            <img src="/assets/images/dynamic/{{ $category->image_C }}" alt="{{ $category->nom_C }}" style="max-height: 150px;" class="rounded ">
                        </td>
                        <td class="align-middle"  style="cursor: pointer;">{{ $category->nom_C }}</td>
                        
                        
                        
                        <td class="align-middle"  
                            style="cursor: pointer;">
                            @if (strlen($category->description_C) >70   )
                            {{ Str::words($category->description_C, 50, '...')}}
                            
                            <span style="color:blue;">Read More</span>
                        @else
                            {{ $category->description_C }}
                        @endif
                        <td class="align-middle">
                            <a href="{{route('admin.category',$category->id)}}" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                    </tr>
                    <div class="modal fade" id="categorymodel{{ $category->id }}" tabindex="-1" aria-labelledby="categorymodel{{ $category->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="productModal{{ $category->id }}Label"> {{ $category->nom_C }}</h5>
                                    <button type="button" class="rounded-pill" data-bs-dismiss="modal" aria-label="Close">x</button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6 ">
                                            <img src="{{ asset("/assets/images/dynamic/".$category->image_C) }}" alt="{{ $category->nom_C }}" style="width: 100%; height: auto;" class="rounded-circle" />
                                        </div>
                                        <div class="col-6">
                                            <p style="font-size: 20px; font-weight: bold; text-align: center; text-decoration: underline">{{ $category->nom_C }}</p>
                                            <p style="font-size: 16px; text-align: justify;"><strong>Description:</strong> {{ $category->description_C }}</p>
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

        
    $(document).ready(function() {
        $('#categoryTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "pageLength": 3 // number of rows to show per page
        });
    });
</script>

   
@endsection

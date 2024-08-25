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
            <a href="{{ route('admin2.blog.add') }}" class="btn btn-success">Add Blog <i class="uil uil-plus"></i></a>
        </div>

        <table class="table table-hover  dt-responsive" id="selection-datatable">

            <thead>
                <tr>
                    <th class="border-dark text-center">ID</th>
                    <th class="border-dark text-center">Image</th>
                    <th class="border-dark text-center">Title</th>
                    <th class="border-dark text-center">Description</th>
                    <th class="border-dark text-center">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($blogs as $blog)
                    <tr>
                        <td class="align-middle fw-bolder">
                            {{ $blog->id }}
                        </td>
                        <td class="align-middle" style="cursor: pointer;">
                            <img src="/assets/images/dynamic/{{ $blog->image_path }}" alt="{{ $blog->image_path }}"
                                style="max-height: 150px;" class="rounded ">
                        </td>

                        <td class="align-middle fw-bold">
                            {{ $blog->title }}
                        </td>




                        <td class="align-middle" style="cursor: pointer;">
                            @if (strlen($blog->description) > 70)
                                {{ Str::words($blog->description, 50, '...') }}

                                <span style="color:blue;">Read More</span>
                            @else
                                {{ $blog->description }}
                            @endif
                        <td class="align-middle">
                            <button onclick="openModal('{{ $blog->id }}')"
                                class="btn btn-warning d-inline-block fw-bold">Details <i
                                    class="uil uil-file-info-alt"></i></button>
                            <a href="{{ route('admin2.blog.edit', $blog->id) }}" class="btn btn-success d-inline-block fw-bold">Edit <i
                                    class="uil uil-edit-alt"></i></a>

                            <button onclick="deleteBlog('{{ $blog->id }}')"
                                class="btn btn-danger d-inline-block fw-bold">Delete<i class="uil uil-times"></i></button>
                            <form id="delete-form-{{ $blog->id }}" action="{{route('admin2.blog.delete',$blog->id)}}" 
                                method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>


                        </td>

                    </tr>
                    <div class="modal fade" id="blogmodel{{ $blog->id }}" tabindex="-1"
                        aria-labelledby="blogmodel{{ $blog->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        id="productModal{
                                        { $blog->id }}Label">
                                        {{ $blog->title }}</h5>
                                    <button type="button" class="rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">x</button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6 ">
                                            <img src="{{ asset('/assets/images/dynamic/' . $blog->image_path) }}"
                                                alt="{{ $blog->title }}" style="width: 100%; height: auto;"
                                                class="rounded-circle" />
                                        </div>
                                        <div class="col-6">
                                            <p
                                                style="font-size: 20px; font-weight: bold; text-align: center; text-decoration: underline">
                                                {{ $blog->title }}</p>
                                            <p style="font-size: 16px; text-align: justify;"><strong>Description:</strong>
                                                {{ $blog->description }}</p>
                                            <p style="font-size: 16px; text-align: justify;"><strong>created at:</strong>
                                                {{ $blog->created_at }}</p>
                                            tags
                                            <ul>

                                                @foreach ($blog->tags as $tag)
                                                    <li>{{$tag->name}}</li>
                                                @endforeach
                                            </ul>
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
        function openModal(blogid) {
            $('#blogmodel' + blogid).modal('show');
        }

        function deleteBlog(blogId) {
            Swal.fire({
                title: 'Are you sure you want to delete this blog?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + blogId).submit();
                }
            })
        }
    </script>
@endsection

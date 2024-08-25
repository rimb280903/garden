@extends('admin2.dashboard')

@section('content')
   <center> <h1 class="mb-3">Contact Users</h1></center>


    <table id="selection-datatable" class="table dt-responsive nowrap w-100">
        <thead>



            <tr>
                <th>Id</th>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Telephone</th>
                <th>Date</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>


        <tbody>
            @foreach ($mails as $mail)
                <tr>
                    <td>{{ $mail->id }}</td>
                    <td>{{ $mail->name }}</td>
                    <td>{{ $mail->Lname }}</td>
                    <td><a href="tel:{{ $mail->phone }}" class="mb-1">{{ $mail->phone }}</a></td>
                    <td>{{ $mail->created_at }}</td>
                    <td class="">
                        
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#full-width-modal-{{ $mail->id }}">Details</button>
                        <div id="full-width-modal-{{ $mail->id }}" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-full-width">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="fullWidthModalLabel">Toutes les details</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-hidden="true"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Profile -->
                                        <div class="card bg-primary">
                                            <div class="card-body profile-user-box">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div>
                                                                    <h4 class="mt-1 mb-1 text-white">{{ $mail->name }}
                                                                        {{ $mail->Lname }}</h4>
                                                                    <p class="font-13 text-white-50 fw-bolder"> ID:
                                                                        {{ $mail->id }}
                                                                    </p>

                                                                    <ul class="mb-0 list-inline text-light">
                                                                        <li class="list-inline-item me-3">
                                                                            <h5 class="mb-1 text-white">
                                                                                <a href="tel:{{ $mail->phone }}"
                                                                                    class="mb-1 text-white">{{ $mail->phone }}</a>
                                                                            </h5>
                                                                            <p class="mb-0 font-13 text-white-50 fw-bolder">
                                                                                Telephone
                                                                            </p>
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <h5 class="mb-1 text-white">
                                                                                <a href="mailto:{{ $mail->email }}"
                                                                                    class="mb-1 text-white">{{ $mail->email }}</a>
                                                                            </h5>
                                                                            <p class="mb-0 font-13 text-white-50 fw-bolder">
                                                                                Email</p>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col-->

                                                    <div class="col-sm-4">
                                                        <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                                            <h5 class="mb-1 text-white">{{ $mail->updated_at }}</h5>
                                                            <p class="mb-0 font-13 text-white-50 fw-bolder">Date de Creation
                                                            </p>
                                                        </div>
                                                    </div> <!-- end col-->
                                                </div> <!-- end row -->

                                            </div> <!-- end card-body/ profile-user-box-->
                                        </div>
                                        <!--end profile/ card -->

                                        <!-- Profile -->
                                        <div class="card bg-secondary">
                                            <div class="card-body profile-user-box">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div>
                                                                    <h5 class="mt-1 mb-1 text-black">{{ $mail->message }}
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col-->


                                                </div> <!-- end row -->

                                            </div> <!-- end card-body/ profile-user-box-->
                                        </div>
                                        <!--end profile/ card -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="delete-form-{{ $mail->id }}"
                            action="{{route('admin2.mail.delete',$mail->id)}}" method="POST"
                            class="d-inline align-items-center">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger"
                                onclick="deleteMail({{ $mail->id }})">Delete Mail <i
                                    class="uil uil-multiply"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>

<script>
    function deleteMail(id) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this Mail!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Mail has been deleted.',
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

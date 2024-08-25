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

    <h1 class="mb-3 text-center">ALL DELTED MAILS</h1>

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
                    <td class="">{{ $mail->id }}</td>
                    <td class="">{{ $mail->name }}</td>
                    <td class="">{{ $mail->Lname }}</td>
                    <td class=""><a href="tel:{{ $mail->phone }}" class="mb-1">{{ $mail->phone }}</a></td>
                    <td class="">{{ $mail->created_at }}</td>
                    <td class="">

                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#full-width-modal">Details</button>
                        <div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog"
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
                                                            <h5 class="mb-1 text-white">{{ $mail->deleted_at }}</h5>
                                                            <p class="mb-0 font-13 text-white-50 fw-bolder">Date de
                                                                Suppression
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
                        <a href="{{ route('admin2.mail.restore', $mail->id) }}"
                            class="btn btn-success d-inline align-items-center"
                            onclick="restore(event,{{ $mail->id }})">Restore Mail <i class="uil uil-edit-alt"></i></a>

                        <form id="delete-form-{{ $mail->id }}" action="{{ route('admin2.mail.delete', $mail->id) }}"
                            method="POST" class="d-inline align-items-center">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="deleteMail({{ $mail->id }})"> <i
                                    class="uil uil-multiply"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach




            <script>
                function restore(event, id) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Are you sure you want to restore this Mail?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, restore it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('admin2.mail.restore', ':id') }}".replace(':id', id);
                        }
                    });
                }

                function deleteMail(id) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This Mail will be deleted permanently!',
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

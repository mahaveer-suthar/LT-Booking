@extends('layouts-admin.app')
@section('content')
    <div class="col-lg-12">
        <h4>Add teachers</h4>
        <div class="card">
            <div class="row p-2 m-0">
                <form class="needs-validation" novalidate action="teachers" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group files">
                        <label>Upload Your File </label>
                        <input name="teacher_file" type="file" class="form-control" multiple="">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Upload</button>
                    </div>
                </form>
            </div>
        </div>
        <h4>Teachers</h4>
        <div class="card">
            <div class="row p-2 m-0">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Sr No</th>
                            <th scope="col">Name</th>
                            <th scope="col">E-Mail</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $ind=>$user)
                            <tr>
                                <td scope="row">{{ $ind + 1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td scope="row"><button onclick="deleteUser({{ $user->id }})"
                                        class="btn btn-danger btn-sm">Delete</button></th>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $('#table_id').dataTable({
            "columnDefs": [{
                "width": "8%",
                "targets": 0,
                "className": "text-center"
            }],
            responsive: true,
        });

        function deleteUser(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax('professor/' + id, {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data, status, xhr) {
                            console.log(data);
                            if (data.status == 200) {
                                Swal.fire({
                                    title: 'Deleted Successfully',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.reload()
                                    }
                                })
                            }
                        },
                        error: function(jqXhr, textStatus, errorMessage) {

                        }
                    });

                }
            })
        }
        $(document).ready(function() {
            toastr.options.timeOut = 5000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @endif

            @if (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
            @if (Session::has('worng'))
                toastr.info('Ohh! Somthing Went worng Please try again');
            @endif
        });
    </script>
@endsection

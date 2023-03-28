@extends('layouts-admin.app')
@section('content')
<div class="col-lg-12">
    <h4>New Signup Requests</h4>
    <div class="card">
        <div class="row p-2 m-0">
            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th scope="col">Sr No</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">Assign Role</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $ind=>$user)
                        <tr>
                            <td scope="row">{{ $ind + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td scope="row"><select data-user_id="{{ $user->id }}" class="form-control status">
                                <option value="" disabled selected>select role</option>
                                <option value="2">Teacher</option>
                                <option value="3">Student</option>
                                <option style="color:red" value="0">Reject</option>
                            </select></td>
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
        $('.status').on('change', function() {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You want to change request type",
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Change status'
                        }).then((result) => {
                                if (result.value) {
                                    $("#spinner-div").show();
                                    let user_id=$(this).data("user_id");
                                    $.ajax('{{ route('admin.request.update',"+user_id+") }}', {
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            type: 'PUT',
                                            data: {
                                                "_token": "{{ csrf_token() }}",
                                                "id":user_id,
                                                "status": $(this).find(":selected").val()
                                            },
                                            success: function(data, status, xhr) {
                                                console.log(data);
                                                if (data.status == 200) {
                                                        Swal.fire({
                                                            title: 'Status changed successfully',
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
                                                complete: function() {
                                                        $('#spinner-div').hide();
                                                    },
                                                error: function(jqXhr, textStatus, errorMessage) {

                                                }
                                            });

                                    }
                                })
                        });


        $(document).ready(function() {
            toastr.options.timeOut = 5000;
            @if (Session::has('error'))
                toastr.error('{{Session::get('error')}}');
            @endif

            @if (Session::has('success'))
                toastr.success('{{Session::get('success')}}');
            @endif
            @if (Session::has('worng'))
                toastr.info('Ohh! Somthing Went worng Please try again');
            @endif
        });
    </script>
@endsection
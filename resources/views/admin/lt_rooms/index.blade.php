{{-- @extends('layouts-admin.app')
@section('content')
    <div class="col-lg-12">
        <h4>Create Room</h4>
        <div class="card">
            <div class="row p-2 m-0">
                <form class="needs-validation" novalidate action="lt_room" method="POST">
                    @csrf
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02">Room Name</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="LT-00" required
                            value="{{ old('room_name') }}" name="room_name">
                        @if (Session::has('error'))
                            <div class="invalid-feedback" style="display:inline-flex">
                                This room name is already exist, Please use another name
                            </div>
                        @endif
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Name is required
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Add Room</button>
                    </div>
                </form>
            </div>
        </div>
        <h4>Rooms</h4>
        <div class="card p-2">
            <div class="table-responsive">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th scope="col">Sr No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $ind=>$room)
                            <tr>
                                <td>{{ $ind + 1 }}</td>
                                <td>{{ $room->room_name }}</td>
                                <td><label class="switch">
                                        <input onchange="status_change({{ $room->id }},@if($room->status==1)0 @else 1 @endif)"
                                            class="status" type="checkbox" @if ($room->status == 1) checked @endif>
                                        <span class="slider round"></span>
                                    </label></td>
                                <td scope="row"> <a class="btn btn-info btn-sm"
                                        href="{{ route('admin.lt_room.edit', $room->id) }}">
                                        <i class="align-middle" data-feather="edit"></i> <span
                                            class="align-middle">Edit</span>
                                    </a></td>
                            </tr>
                        @empty
                            <h4>No data found </h4>
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

        function status_change(id, status) {
            Swal.fire({
                title: 'Are you sure want to change status?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    $.ajax('{{route('admin.changeStatus')}}', {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id': id,
                            'status': status
                        },
                        success: function(data, status, xhr) {
                            console.log(data);
                            if (data.status == 200) {
                                Swal.fire({
                                    title: 'Status Changed Successfully',
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
                toastr.error('Ohh! Room is Exist use another name');
            @endif

            @if (Session::has('success'))
                toastr.success('Room Added Successfully');
            @endif

            @if (Session::has('worng'))
                toastr.info('Ohh! Somthing Went worng Please try again');
            @endif
        });
    </script>
@endsection --}}

@extends('layouts.app')
@section('content')
    <h4>Available LTs</h4>
    <p>The following LT's are available for you to book in your selected date & timeslot</p>
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th scope="col">Sr No</th>
                <th scope="col">LT Number</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index=>$lt_room)
            <tr>
                <td >{{$index+1}}</td>
                <td >{{$lt_room->room_name}}</td>
                <td><a onclick="applyRequest({{$lt_room->id}})" class="fxt-btn btn-sm px-4">Apply now</a></td>
            </tr>
                @endforeach
        </tbody>
    </table>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable({
                // order: [
                //         [0, 'asc']
                //     ],
            });
        });


        function applyRequest(lt_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to  send request ",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Send Request'
            }).then((result) => {
                if (result.value) {
                    $.ajax('@if (auth()->user()->role==3){{route('student.applyRequest')}} @else {{route('teacher.applyRequest')}} @endif ', {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "lt_id":lt_id,
                            'date':"{{$user_data->date}}",
                            'timeslots_id':"{{$user_data->time}}"
                        },
                        success: function(data, status, xhr) {
                            console.log(data);
                            if (data.status == 200) {
                                Swal.fire({
                                    title: data.msg,
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
    </script>
@endsection

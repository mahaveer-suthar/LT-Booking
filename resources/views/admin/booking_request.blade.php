@extends('layouts-admin.app')
@section('content')
    <style>
        .badge {
            font-size: 100% !important;
            font-weight: 400 !important;
        }

        .badge-pill {
            padding-right: 1.2em !important;
            padding-left: 1.2em !important;
            border-radius: 2rem !important;
        }
    </style>
    <div class="text-center">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <h3>Booking request</h3>
    <div class="card">
        <div class="row p-2 m-0">
            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th>Requste By</th>
                        <th scope="col">LT Number</th>
                        <th scope="col">Booking Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $ind=> $book)
                        <tr>
                            <td scope="row">{{ date('d M Y', strtotime($book->date)) }}</td>
                            <td>{{ date('g:i A', strtotime(App\Models\Timeslots::find($book->timeslots_id)->start_time)) }}
                                -
                                {{ date('g:i A', strtotime(App\Models\Timeslots::find($book->timeslots_id)->end_time)) }}
                            </td>
                            <td>{{ App\Models\User::find($book->user_id)->name }}</td>
                            <td scope="row">{{ App\Models\Lt_rooms::find($book->lt_id)->room_name }}</td>
                            <td>
                                @switch($book->status)
                                    @case('approved')
                                        <span class="badge badge-pill badge-success">Approved</span>
                                    @break

                                    @case('reject')
                                        <span class="badge badge-pill badge-danger">Rejected</span>
                                    @break

                                    @default
                                        <select data-booking_id="{{ $book->id }}" class="form-control status">
                                            <option value="0" disabled selected>Pending</option>
                                            <option value="1">Approve</option>
                                            <option value="2">Reject</option>
                                        </select>
                                @endswitch
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
    @section('jquery')
        <script>
            $(document).ready(function() {
                $('#table_id').DataTable({
                    order: [
                        [0, 'desc']
                    ],
                    'columnDefs': [{
                        "targets": [0, 1, 2, 3, 4], // your case first column
                        "className": "text-center",
                    }]
                });
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
                                    $.ajax('{{ route('admin.changeRequestStatus') }}', {
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            type: 'POST',
                                            data: {
                                                "_token": "{{ csrf_token() }}",
                                                "id": $(this).data("booking_id"),
                                                "status": $(this).find(":selected").val()
                                            },
                                            success: function(data, status, xhr) {
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
        </script>
    @endsection

@extends('layouts.app')
@section('content')
    <h4>
        Available LTs</h4>
    <p>The following LT's are available for you to book in your selected date & timeslot</p>
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">LT Number</th>
                <th scope="col">Booking Status</th>
                <th scope="col">Cancel request</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $rec)
                <tr>
                    <td scope="row">{{ date('d M Y', strtotime($rec->date)) }}</th>
                    <td>{{ date('g:i A', strtotime(App\Models\Timeslots::find($rec->timeslots_id)->start_time)) }} To
                        {{ date('g:i A', strtotime(App\Models\Timeslots::find($rec->timeslots_id)->end_time)) }}</td>
                    <td scope="row">{{ App\Models\Lt_rooms::find($rec->lt_id)->room_name }}</td>
                    <td>
                        @switch($rec->status)
                            @case('pending')
                                <span class="badge badge-info">In Process</span>
                            @break

                            @case('approved')
                                <span class="badge  badge-success">Approved</span>
                            @break

                            @case('reject')
                                <span class="badge  badge-danger">Rejected</span>
                            @case('cancel')
                                <span class="badge badge-warning">Cancelled</span>
                            @break
                            @default
                                <span class="badge btn-danger btn-sm px-4">Not found</span>
                            @break
                        @endswitch
                    </td>
                    <td>
                        @if ($rec->status !== 'cancel')
                        <button class="btn btn-danger btn-sm" onclick="applyRequest({{$rec->id}})">cancel</button>
                            
                        @endif
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    @endsection
    @section('jquery')
        <script>
            $(document).ready(function() {
                $('#table_id').DataTable({
                    "order": [
                        [0, "desc"]
                    ], //or asc 
                    "columnDefs": [{
                        "targets": 0,
                        "type": "date-eu"
                    }],
                });
            });
            function applyRequest(lt_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to cancel request",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes Cancel !'
            }).then((result) => {
                if (result.value) {
                    $.ajax('{{route('cancelRequest')}}', {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id":lt_id,
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

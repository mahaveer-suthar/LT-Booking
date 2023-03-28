@extends('layouts.app')
@section('content')
    <h4>Available LTs</h4>
    <p>The following LT's are available for you to book in your selected date & timeslot</p>
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">LT Number</th>
                <th scope="col">Booking Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $rec)
            <tr>
                <td scope="row">{{date('d M Y', strtotime($rec->date))}}</th>
                <td>{{date('g:i A',strtotime(App\Models\Timeslots::find($rec->timeslots_id)->start_time))}} To {{date('g:i A',strtotime(App\Models\Timeslots::find($rec->timeslots_id)->end_time))}}</td>
                <td scope="row">{{App\Models\Lt_rooms::find($rec->lt_id)->room_name}}</td>
                <td>@switch( $rec->status )
                    @case( "pending" )
                        <span  class="badge badge-pill badge-warning">In Process</span >
                    @break
                    @case( "approved" )
                    <span class="badge badge-pill badge-success">Approved</span>
                    @break
                    @case( "reject" )
                    <span class="badge badge-pill badge-danger">Rejected</span>
                    @break
                    @default
                    <span class="badge btn-danger btn-sm px-4">Not found</span>
                    @break
                @endswitch</td>
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
                "order": [[ 0, "desc" ]], //or asc 
                "columnDefs" : [{"targets":0, "type":"date-eu"}],
        });
        });
    </script>
@endsection

@extends('layouts-admin.app')
@section('content')
    <h4>Timetable</h4>
    <div class="card">
        <div class="row p-2 m-0">
            <form class="needs-validation" novalidate action="{{ route('admin.upload') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-row mb-2">
                    <label for="formFileMultiple" class="form-label">Upload File</label>
                    <input class="form-control" type="file" id="formFileMultiple" multiple name="excel_file" />
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Sumbit</button>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="card">
        <div class="row p-2 m-0">
            <form class="needs-validation" novalidate action="professor" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom04" class="form-label">Batch</label>
                        <select class="form-select" id="validationCustom04" required>
                            <option selected disabled value="">Choose...</option>
                            <option>...</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select batch
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom04" class="form-label">Branch</label>
                        <select class="form-select" id="validationCustom04" required>
                            <option selected disabled value="">Choose...</option>
                            <option>...</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select branch
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom04" class="form-label">Day</label>
                        <select class="form-select" id="validationCustom04" required>
                            <option selected disabled value="">Choose...</option>
                            <option>...</option>
                        </select>
                        <div class="invalid-feedback">
                            please select day
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Sumbit</button>
                </div>
            </form>
        </div>
    </div> --}}

    <div class="card p-2">
        <div style="display: flex; justify-content: space-between;">
            <p style="color: red">Start date -: {{date('d M Y', strtotime($date->start_date))}}</p>
            <p style="color: red">End date -: {{date('d M Y', strtotime($date->end_date))}}</p>
        </div>
        <div class="table-responsive">
            <table id="table_id" cellspacing="0" width="100%"class="display">
                <thead>
                    <tr>
                        {{-- <th scope="col">Sr No</th> --}}
                        <th scope="col">Day</th>
                        <th style="width: 160px;" scope="col">Timeslots</th>
                        <th scope="col">Room</th>
                        <th scope="col">Course</th>
                        <th scope="col">Branch</th>
                        <th scope="col">Batch</th>
                        <th scope="col">Teacher</th>
                        <th scope="col">Designation</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data)
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$item->day}}</td>
                            {{-- <td>{{$item->day}}</td> --}}
                            <td>{{ date('g:i A', strtotime(App\Models\Timeslots::find($item->timeslots_id)->start_time)) }}
                                -
                                {{ date('g:i A', strtotime(App\Models\Timeslots::find($item->timeslots_id)->end_time)) }}</td>
                            <td>{{ App\Models\Lt_rooms::find($item->lt_id)->room_name }}</td>
                            <td>{{$item->course}}</td>
                            <td>{{$item->branch}}</td>
                            <td>{{$item->batch}}</td>
                            <td>{{$item->teacher_name}}</td>
                            <td>{{$item->designation}}</td>
                        </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 5000;
            @if (Session::has('success'))
                toastr.success('Timetable Imported Successfully');
            @endif
            @if (Session::has('worng'))
                toastr.info('Ohh! Somthing Went worng Please try again');
            @endif
            // $('#table_id').dataTable({
            //     "columnDefs": [{
            //         "width": "8%",
            //         "targets": 0,
            //         "className": "text-center"
            //     }],
            //     responsive: true,
            // });

        });
    </script>
    <script>
        $(document).ready(function() {
            // Setup - add a text input to each header cell
            $('#table_id thead th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" class="form-control"  placeholder="' + title + '" />');
            });

            // DataTable
            var table = $('#table_id').DataTable({"ordering": false});

            // Apply the search
            table.columns().every(function() {
                var that = this;

                $('input', this.header()).on('keypress change', function(e) {
                    var keycode = e.which;
                    //launch search action only when enter is pressed
                    if (keycode == '13') {
                        console.log('enter key pressed !')
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    }

                });
            });
        });
    </script>
@endsection

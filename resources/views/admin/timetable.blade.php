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
                @if ($data)
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-danger" type="button" onclick="deleteUser({{ $date->id }})">Reset
                            Timetable</button>
                    </div>
                @else
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Sumbit</button>
                    </div>
                @endif
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
            @if (isset($date))
                <p style="color: red">Start date -: {{ date('d M Y', strtotime($date->start_date)) }}</p>
                <p style="color: red">End date -: {{ date('d M Y', strtotime($date->end_date)) }}</p>
            @endif
        </div>
        <div class="table-responsive">
            <table id="table_id" cellspacing="0" width="100%"class="display">
                <thead>
                    <tr>
                        <th>Day<span></span></th>
                        <th>Timeslots<span></span></th>
                        <th>Room<span></span></th>
                        <th>Course<span></span></th>
                        <th>Branch<span></span></th>
                        <th>Batch<span></span></th>
                        <th>Teacher<span></span></th>
                        <th>Designation<span></span></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data)
                        @foreach ($data->timetable as $item)
                            <tr>
                                <td>{{ $item->day }}</td>
                                <td>
                                    {{ date('g:i A', strtotime(App\Models\Timeslots::find($item->timeslots_id)->start_time)) }}
                                    To
                                    {{ date('g:i A', strtotime(App\Models\Timeslots::find($item->timeslots_id)->end_time)) }}
                                </td>
                                <td>{{ App\Models\Lt_rooms::find($item->lt_id)->room_name }}</td>
                                <td>{{ $item->course }}</td>
                                <td>{{ $item->branch }}</td>
                                <td>{{ $item->batch }}</td>
                                <td>{{ $item->teacher_name }}</td>
                                <td>{{ $item->designation }}</td>
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
            //for datatable and filter
            var oTable = $('#table_id').DataTable({
                "columnDefs": [{
                        "width": "10%",
                        "targets": [2, 3, 4]
                    },
                    {
                        "width": "15%",
                        "targets": [1]
                    }
                ],
                "ordering": false,
                fixedHeader: {
                    header: false,
                    footer: false
                },
                pagingType: "full_numbers",
                bSort: true,
                "order": [
                    [0, "asc"]
                ],
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select style="padding-left: .2rem" class="form-select form-select-sm"><option value=""></option></select>'
                            )
                            .appendTo($(column.header()).find('span').empty())
                            .on({
                                'change': function() {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                },
                                'click': function(e) {
                                    // stop click event bubbling
                                    e.stopPropagation();
                                }
                            });

                        column.data().unique().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                }

            });

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
                    $.ajax('reset/' + id, {
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
    </script>
@endsection

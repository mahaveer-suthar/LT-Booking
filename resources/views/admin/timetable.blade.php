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
        });
    </script>

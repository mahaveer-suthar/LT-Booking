{{-- @extends('layouts-admin.app')
@section('content')
<h4>Update Room Details</h4>
    <div class="card">
        <div class="row p-2 m-0">
            <form class="needs-validation" novalidate action="{{ route('admin.lt_room.update', $room->id) }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="col-md-4 mb-3">
                    <label for="validationCustom02">Room Name</label>
                    <input type="text" class="form-control" id="validationCustom02" placeholder="LT-00" required
                        value="{{ $room->room_name }}" name="room_name">
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
                    <button class="btn btn-info" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <a href="{{route('admin.lt_room.index')}}" class="btn btn-success" type="submit">Back</a>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 5000;
            @if (Session::has('error'))
                toastr.error('{{Session::get('error')}}');
            @endif

            @if (Session::has('success'))
                toastr.success('{{Session::get('success')}}');
            @endif

            @if (Session::has('worng'))
                toastr.info('{{Session::get('worng')}}');
            @endif
        });
    </script>
@endsection --}}

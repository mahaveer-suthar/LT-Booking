@extends('layouts.app')
@section('content')
    <h2>Book an LT</h2>
    <h2>Select date and time</h2>
    <div class="fxt-form">
        <form method="POST" action="booking">
            @csrf
            <div class="form-group">
                <div class="fxt-transformY-50 fxt-transition-delay-1">
                    <input type="text" id="date" class="form-control" name="date" placeholder="dd-mm-yyyy"
                        required="required" autocomplete="on">
                    <i toggle="#calendar" class="fa fa-fw fa-calendar toggle-calendar field-icon"></i>
                </div>
                @if ($errors->has('time'))
                    <div class="invalid-feedback" style="display: flex">
                        This filed is require
                    </div>
                @endif
            </div>
            <div class="form-group">
                <div class="fxt-transformY-50 fxt-transition-delay-2">
                    <select required name="time" id="validationCustom01" class="form-control form-select">
                        <option selected value="" disabled>Chose timeslots</option>
                        {{-- @forelse ($time as $slots)
                            <option value="{{ $slots->id }}">
                                {{ Carbon\Carbon::parse($slots['start_time'])->format('H:i') }} To
                                {{ Carbon\Carbon::parse($slots['end_time'])->format('H:i') }}</option> 
                        @empty
                            <option value="">Slots not availeble</option>
                        @endforelse --}}
                    </select>
                    @if ($errors->has('time'))
                        <div class="invalid-feedback" style="display: flex">
                            This filed is require
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="fxt-transformY-50 fxt-transition-delay-4">
                    <button type="submit" class="fxt-btn-fill btn-lg">Sumbit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('jquery')
    <script>
        $(function() {
            $("#date").datepicker();
        });
        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif
        @if (Session::has('worng'))
            toastr.info('Ohh! Somthing Went worng Please try again');
        @endif
    </script>

    <script type="text/javascript">
        $(function() {
            $("#date").change(function() {
                var timeslots = "{{ $time }}";
                var selDate = new Date(this.value);
                var option = '';
                $('#validationCustom01').html('');
                if (selDate.getDay() == 2 || selDate.getDay() ==
                    4) { 
                    @foreach ($short_time as $slots)
                        $('<option/>').val('{{ $slots->id }}').html(
                            '{{ Carbon\Carbon::parse($slots['start_time'])->format('h:i A') }} To {{ Carbon\Carbon::parse($slots['end_time'])->format('h:i A') }}'
                            ).appendTo('#validationCustom01');
                    @endforeach
                } else{
                    $('#validationCustom01').empty();
                @foreach ($time as $slots)
                    $('<option/>').val('{{ $slots->id }}').html(
                        '{{ Carbon\Carbon::parse($slots['start_time'])->format('h:i A') }} To {{ Carbon\Carbon::parse($slots['end_time'])->format('h:i A') }}'
                        ).appendTo('#validationCustom01');
                @endforeach
                }
            })
        });
    </script>
@endsection

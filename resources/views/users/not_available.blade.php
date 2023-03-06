@extends('layouts.app')
@section('content')
<div class="container mt-0">
    <h1>Available LTs</h1>
    <h6>The following LT's are available for you to book in your selected date & timeslot</h6>
    <div class="row justify-content-center">
        <div class="fxt-header">

            <h4>Sorry, No LT's are available in your selected timeframe.
                Please try changing the timeslot and/or the date
            </h4>
        </div>
        <button class="fxt-btn btn-lg">Choose another date and time</button>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
    <style>
        .fxt-btn-fill:disabled {
            background-color: gray;
            color: #fff;
            cursor: not-allowed;
            /* You may need to adjust this based on your design */
        }

        .fxt-btn-fill:hover:disabled {
            background-color: gray;
            color: #fff;
            cursor: not-allowed;
            /* You may need to adjust this based on your design */
        }
    </style>
    <h2>Book an LT</h2>
    {{-- <h2>Select date and time</h2> --}}
    <div class="fxt-form">
        <form id="checkAvailebleLT" method="POST" action="booking">
            @csrf
            <div class="form-group">
                <label for="">Select Date</label>

                <div class="fxt-transformY-50 fxt-transition-delay-1">
                    <input type="text" id="date" class="form-control" name="date" placeholder="Select Date"
                        required="required" autocomplete="on">
                </div>
            </div>
            <div class="form-group">
                <label for="">Time Range</label>
                <div class="fxt-transformY-50 fxt-transition-delay-2 d-flex">
                    <div class="w-50 mr-1">
                        <input type="text" id="fromTime" class="form-control " name="fromTime"
                            placeholder="Start Time (e.g., 09:00 AM)" required="required" autocomplete="on">
                    </div>
                    <div class="w-50">
                        <input type="text" id="toTime" class="form-control " name="toTime"
                            placeholder="End Time (e.g., 06:00 PM)" required="required" autocomplete="on">
                    </div>
                </div>
            </div>
            {{-- <div class="form-group">
                <div class="fxt-transformY-50 fxt-transition-delay-2">
                    <select required name="time" id="validationCustom01" class="form-control form-select">
                        <option selected value="" disabled>Chose timeslots</option>
                    </select>
                    @if ($errors->has('time'))
                        <div class="invalid-feedback" style="display: flex">
                            This filed is require
                        </div>
                    @endif
                </div>
            </div> --}}
            <div class="form-group">
                <div class="fxt-transformY-50 fxt-transition-delay-4">
                    <button id="submitBtn" type="submit" class="fxt-btn-fill btn-lg" disabled >Sumbit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            // Add validation rules to your form
            $("#checkAvailebleLT").validate({
                rules: {
                    date: {
                        required: true,
                        // Add additional rules if needed
                    },
                    fromTime: {
                        required: true,
                        // Add additional rules if needed
                    },
                    toTime: {
                        required: true,
                        // Add additional rules if needed
                    },
                },
                messages: {
                    date: {
                        required: "Please select a date",
                        // Add additional messages if needed
                    },
                    fromTime: {
                        required: "Please enter the start time",
                        // Add additional messages if needed
                    },
                    toTime: {
                        required: "Please enter the end time",
                        // Add additional messages if needed
                    },
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    // Display error messages in a div with class 'invalid-feedback'
                    error.addClass("invalid-feedback");
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    // Highlight the form element with an error
                    $(element).addClass("is-invalid").removeClass("is-valid");

                },
                unhighlight: function(element, errorClass, validClass) {
                    // Unhighlight the form element with no error
                    $(element).removeClass("is-invalid").addClass("is-valid");
                },
            });
            // Trigger enableDisableSubmitButton on keyup event for relevant inputs
            $("#fromTime, #toTime").on("input change", function() {
                enableDisableSubmitButton();
            });

            // Function to enable/disable the submit button based on form validity
            function enableDisableSubmitButton() {
                if ($("#checkAvailebleLT").valid()) {
                    // If the form is valid, enable the submit button
                    $("#submitBtn").prop("disabled", false);
                } else {
                    // If the form is invalid, disable the submit button
                    $("#submitBtn").prop("disabled", true);
                }
            }
        });
        const fromTimeInput = document.getElementById('fromTime');
        const toTimeInput = document.getElementById('toTime');
        const dateInput = document.getElementById('date');
        const defaultTime = "08:00";
        flatpickr(dateInput, {
            dateFormat: "d-m-Y",
            minDate: "today",
        });

        flatpickr(fromTimeInput, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K", // 12-hour time format with AM/PM
            minDate: "today",
            maxDate: "today",
            minTime: "08:00", // Set the minimum time to 8:00 AM
            maxTime: "22:00", // Set the maximum time to 10:00 PM
            enableSeconds: false, // Disable seconds input
            clickOpens: true,
            minuteIncrement: 30,
            defaultDate: defaultTime,
            readOnly: true,
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    const roundedTime = roundToNearest30(selectedDates[0]);
                    toTimeInput.value = instance.formatDate(roundedTime, "h:i K");
                    // Update the minimum time for the "To" time input based on the selected "From" time
                    if (dateStr !== "") {
                        // Use the Date object to parse the time string and set it for today
                        const selectedTime = new Date(`${new Date().toDateString()} ${dateStr}`);

                        instance.config.minDate = selectedTime;
                        toTimeInput._flatpickr.set("minDate", selectedTime);

                        // Calculate end time by adding 1 hour to the start time
                        const endTime = new Date(selectedTime);
                        endTime.setHours(endTime.getHours() + 1);

                        toTimeInput._flatpickr.set("minTime", endTime);

                        // Set the minimum date for the "To" time input to the selected time plus 1 hour
                        const minDateForToInput = new Date(selectedTime);
                        minDateForToInput.setHours(minDateForToInput.getHours() + 1);

                        toTimeInput._flatpickr.set("minDate", minDateForToInput);
                        enableDisableSubmitButton();
                    }
                }
            }
        });

        flatpickr(toTimeInput, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K", // 12-hour time format with AM/PM
            minDate: "today",
            maxDate: "today",
            minTime: "08:00", // Set the minimum time to 8:00 AM
            maxTime: "22:00", // Set the maximum time to 10:00 PM
            enableSeconds: false, // Disable seconds input
            clickOpens: true,
            minuteIncrement: 30,
            defaultDate: defaultTime,
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    const roundedTime = roundToNearest30(selectedDates[0]);
                    toTimeInput.value = instance.formatDate(roundedTime, "h:i K");
                    // Update the maximum time for the "From" time input based on the selected "To" time
                    if (dateStr !== "") {
                        // Use the Date object to parse the time string and set it for today
                        const selectedTime = new Date(`${new Date().toDateString()} ${dateStr}`);

                        instance.config.maxDate = selectedTime;
                        fromTimeInput._flatpickr.set("maxDate", selectedTime);

                        // Calculate start time by subtracting 1 hour from the end time
                        const startTime = new Date(selectedTime);
                        startTime.setHours(startTime.getHours() - 1);

                        fromTimeInput._flatpickr.set("maxTime", startTime);
                        // enableDisableSubmitButton();
                    }
                }
            }
        });

        function roundToNearest30(date) {
            // Custom function to round minutes to the nearest 30
            const minutes = date.getMinutes();
            const roundedMinutes = Math.round(minutes / 30) * 30;
            date.setMinutes(roundedMinutes);
            return date;
        }
    </script>
@endsection
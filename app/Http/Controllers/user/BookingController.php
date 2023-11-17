<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\NotifyMail;
use App\Models\Booking;
use App\Models\Lt_rooms;
use App\Models\Timeslots;
use App\Models\Timetable;
use App\Models\Timetablesource;
use App\Models\User;
use App\Notifications\Admininfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Jobs\EmailJob;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $time_0 = Timeslots::where('is_active', null)->orWhere('is_active', "0")->get();
        $time_1 = Timeslots::where('is_active', null)->orWhere('is_active', "1")->get();
        return view('students.create_booking', compact('time_0', 'time_1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $validated = Validator::make(
            $request->all(),
            [
                'date' => ['required'],
                // 'time' => ['required']
            ]
        );
        //Check the validation
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated);
        }

        $expire_date = Timetablesource::where('is_active', "1")->first();
        $today = Carbon::today()->format('Y-m-d');
        if (isset($expire_date)) {
            if ($expire_date->end_date <= $today) {
                return view('students.timetableExpire');
            }
        }

        //new code for show lt 

        $inputDate = Carbon::create($request->date)->format('Y-m-d');
        $input_day = Carbon::create($request->date)->format('l');

        $fromTime = Carbon::createFromFormat('h:i A', $request->fromTime)->format('H:i:s');
        $toTime = Carbon::createFromFormat('h:i A', $request->toTime)->format('H:i:s');
        // return $input_day;

        // search data in booking data
        $existingBookings = Booking::where('date', $inputDate)
            ->where(function ($query) use ($fromTime, $toTime) {
                $query->where(function ($q) use ($fromTime, $toTime) {
                    $q->whereTime('start_time', '<=', $fromTime)
                        ->whereTime('end_time', '>', $fromTime);
                })->orWhere(function ($q) use ($fromTime, $toTime) {
                    $q->whereTime('start_time', '<', $toTime)
                        ->whereTime('end_time', '>=', $toTime);
                })->orWhere(function ($q) use ($fromTime, $toTime) {
                    $q->whereTime('start_time', '>=', $fromTime)
                        ->whereTime('end_time', '<=', $toTime);
                });
            })
            ->whereNotIn('status', ['reject', 'cancel'])
            ->get()
            ->groupBy('lt_id')
            ->toArray();


        $timetable = Timetable::where('day', $input_day)
            ->where(function ($query) use ($fromTime, $toTime) {
                $query->where(function ($q) use ($fromTime, $toTime) {
                    $q->whereTime('start_time', '<=', $fromTime)
                        ->whereTime('end_time', '>', $fromTime);
                })->orWhere(function ($q) use ($fromTime, $toTime) {
                    $q->whereTime('start_time', '<', $toTime)
                        ->whereTime('end_time', '>=', $toTime);
                })->orWhere(function ($q) use ($fromTime, $toTime) {
                    $q->whereTime('start_time', '>=', $fromTime)
                        ->whereTime('end_time', '<=', $toTime);
                });
            })
            ->get()
            ->groupBy('lt_id')
            ->toArray();

        $BookedAndTimetableData = array_merge(array_keys($existingBookings), array_keys($timetable));

        $data = Lt_rooms::whereNotIn('id', $BookedAndTimetableData)->get();
        if ($data->isEmpty()) {
            return view('students.not_available');
        }
        return view('students.availableLts', compact('data', 'inputDate', 'fromTime', 'toTime'));


        // $input_day = Carbon::createFromFormat('m/d/Y', $request->date)->format('l');
        // $data = Booking::where('date', '=', date('Y-m-d', strtotime($request->date)))->Where('timeslots_id', '=', $request->time)->whereNotIn('status', ['reject', 'cancel'])->get()->groupBy('lt_id')->toArray();
        // // get time table data
        // $timetable = Timetable::where('day', $input_day)->where('timeslots_id', $request->time)->get()->groupBy('lt_id')->toArray();
        // // set in array all lt id find in timetable and booking table
        // $lt_id = array();
        // foreach (array_keys($data) as $key => $value) {
        //     array_push($lt_id, $value);
        // }
        // foreach (array_keys($timetable) as $key => $value) {
        //     array_push($lt_id, $value);
        // }
        // $data = Lt_rooms::whereNotIn('id', $lt_id)->get();
        // // check data
        // if ($data->isEmpty()) {
        //     return view('users.not_available');
        // }
        // $user_data = $request;
        return view('students.availableLts', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Booking::where('user_id', $id)->get();
        return view('students.booking_status', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function applyRequest(Request $request)
    {
        // Extract common data
        $requestData = [
            'date' => date('Y-m-d', strtotime($request->date)),
            'user_id' => Auth::user()->id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'lt_id' => $request->lt_id,
        ];

        // Check if booking with the same date, lt_id, and overlapping time range exists
        $existingBooking = Booking::where('lt_id', $requestData['lt_id'])
            ->where('date', $requestData['date'])
            ->where(function ($query) use ($requestData) {
                $query->where(function ($q) use ($requestData) {
                    $q->where('start_time', '<', $requestData['end_time'])
                        ->where('end_time', '>', $requestData['start_time']);
                })
                    ->orWhere(function ($q) use ($requestData) {
                        $q->where('start_time', '>', $requestData['start_time'])
                            ->where('start_time', '<', $requestData['end_time']);
                    });
            })
            ->whereNotIn('status',['pending','reject'])->first();

        if ($existingBooking) {
            return response()->json(['status' => 400, 'msg' => 'Oops! This LT room is booked. Please choose another LT room.']);
        }

        // Create booking based on user role
        if (auth()->user()->role == 2) {
            $requestData['status'] = 'approved';
            $book = Booking::create($requestData);

            if ($book) {
                $user = auth()->user();
                dispatch(new EmailJob($user, $book, 'Approval'));
                return response()->json(['status' => 200, 'msg' => 'Booking successfully done!']);
            }
        } else {
            $book = Booking::create($requestData);

            if ($book) {
                $admin = User::where('role', 5)->first();
                $admin->notify(new Admininfo($book));
                return response()->json(['status' => 200, 'msg' => 'Success! Your booking request has been sent and is awaiting approval.']);
            }
        }
    }
}

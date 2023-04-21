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
        $validated = Validator::make(
            $request->all(),
            [
                'date' => ['required'],
                'time' => ['required']
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
        $input_day = Carbon::createFromFormat('m/d/Y', $request->date)->format('l');
        $data = Booking::where('date', '=', date('Y-m-d', strtotime($request->date)))->Where('timeslots_id', '=', $request->time)->where('status', '!=', 'reject')->get()->groupBy('lt_id')->toArray();
        // get time table data
        $timetable = Timetable::where('day', $input_day)->where('timeslots_id', $request->time)->get()->groupBy('lt_id')->toArray();
        // set in array all lt id find in timetable and booking table
        $lt_id = array();
        foreach (array_keys($data) as $key => $value) {
            array_push($lt_id, $value);
        }
        foreach (array_keys($timetable) as $key => $value) {
            array_push($lt_id, $value);
        }
        $data = Lt_rooms::whereNotIn('id', $lt_id)->get();
        // check data
        if ($data->isEmpty()) {
            return view('users.not_available');
        }
        $user_data = $request;
        return view('students.availableLts', compact('data', 'user_data'));
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
        if (auth()->user()->role == 2) {
            $book = Booking::create([
                'date' => date('Y-m-d', strtotime($request->date)),
                'user_id' => Auth::user()->id,
                'timeslots_id' => $request->timeslots_id,
                'lt_id' => $request->lt_id,
                'status' => 'approved'
            ]);
            if ($book) {
                $user = auth()->user();

                dispatch(new EmailJob($user, $book, 'Approval'));
            }
        } else {
            $book = Booking::create([
                'date' => date('Y-m-d', strtotime($request->date)),
                'user_id' => Auth::user()->id,
                'timeslots_id' => $request->timeslots_id,
                'lt_id' => $request->lt_id
            ]);
            if ($book) {
                $admin = User::where('role', 5)->first();
                $admin->notify(new Admininfo($book));
                return response()->json(['status' => 200, 'msg' => 'Request sent successfully']);
            }
        }
        return response()->json(['status' => 200, 'msg' => 'Booking successfully done']);
    }
}

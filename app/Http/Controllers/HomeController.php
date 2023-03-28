<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\User;
use App\Jobs\EmailJob;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userHome()
    {
        return view('users.index');
    }
    public function teacherHome()
    {
        return view('students.home');
    }
    public function studentHome()
    {
        return view('students.home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {     
        $bookings = Booking::orderBy('id', 'desc')->get();
        return view('admin.booking_request', compact('bookings'));
    }





    // use for approve||reject  req
    public function changeStatus(Request $request)
    {
        $booking=Booking::find($request->id);
        $user=User::find($booking->user_id);
        if ($request->status == 1) {
            $bookings = Booking::find($request->id)->update(['status' => 'approved']);
            if ($bookings) {
                dispatch(new EmailJob($user,$booking,'Approval'));
                return response()->json(['status' => 200, 'msg' => 'Approve done']);
            }
        }
        if ($request->status==2) {
            $bookings = Booking::find($request->id)->update(['status' => 'reject']);
            if ($bookings) {
                dispatch(new EmailJob($user,$booking,'Reject'));
                return response()->json(['status' => 200, 'msg' => 'Reject done']);
            }
        }
    }
}

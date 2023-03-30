<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\User;
use App\Jobs\EmailJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        
        if (auth()->user()->pw_change==null) {
            return view('pw_change');
        }
        return view('students.home');
    }
    public function studentHome()
    {
        if (auth()->user()->pw_change==null) {
            return view('pw_change');
        }
        return view('students.home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $user=User::where('role',3)->get()->groupBy('id')->toArray();
        $bookings = Booking::whereIn('user_id',array_keys($user))->orderBy('id', 'desc')->get();
        return view('admin.booking_request', compact('bookings'));
    }


    //when user first time login change password for teacher and students

    public function pw_change(Request $request)
    {
        $validated = Validator::make(
            $request->all(),
            [
                'password' => ['required'],
                'password-confirm' => ['required']
            ]
        );
        //Check the validation
        if ($validated->fails()) {
            return redirect()->back()->with('error', 'Ohh! Please check your password');
        }
        $user=User::find(auth()->user()->id)->update(['password'=>Hash::make($request->password111),'pw_change'=>Carbon::now()]);
        if (auth()->user()->role == 2) {
            return redirect()->route('teacher.home');
        }
        return redirect()->route('student.home');
    }


    // use for approve||reject  req
    public function changeStatus(Request $request)
    {
        $booking = Booking::find($request->id);
        $user = User::find($booking->user_id);
        if ($request->status == 1) {
            $bookings = Booking::find($request->id)->update(['status' => 'approved']);
            if ($bookings) {
                dispatch(new EmailJob($user, $booking, 'Approval'));
                return response()->json(['status' => 200, 'msg' => 'Approve done']);
            }
        }
        if ($request->status == 2) {
            $bookings = Booking::find($request->id)->update(['status' => 'reject']);
            if ($bookings) {
                dispatch(new EmailJob($user, $booking, 'Reject'));
                return response()->json(['status' => 200, 'msg' => 'Reject done']);
            }
        }
    }
}

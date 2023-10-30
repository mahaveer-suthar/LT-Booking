<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\User;
use App\Jobs\EmailJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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

        if (auth()->user()->pw_change == null) {
            return view('pw_change');
        }
        return view('students.home');
    }
    public function studentHome()
    {
        if (auth()->user()->pw_change == null) {
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
        $user = User::where('role', 3)->get()->groupBy('id')->toArray();
        $bookings = Booking::whereIn('user_id', array_keys($user))->orderBy('id', 'desc')->get();
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
        $user = User::find(auth()->user()->id)->update(['password' => Hash::make($request->password), 'pw_change' => Carbon::now()]);
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


    public function downloadFile($filename)
    {
        // Get the file path from your storage or public directory
        $filePath = storage_path('app/public/' . $filename); // You can change the path as needed

        // Check if the file exists
        if (!Storage::exists($filePath)) {
            abort(404);
        }

        // You can add additional logic here to control access if needed

        // Generate a response to download the file
        return new BinaryFileResponse($filePath);
    }

    public function showChangeForm()
    {
        return view('pw_change');
    }

    public function change(Request $request)
    {
        // return $request;
        $request->validate(
            [
                'password' => 'required|string|min:8|confirmed',
                // 'password_confirmation' => 'required|string|min:8',
            ],
            $customMessages = [
                'password.required' => 'The new password is required.',
                'password.string' => 'The new password must be a string.',
                'password.min' => 'The new password must be at least :min characters.',
                'password.confirmed' => 'The new password confirmation does not match.',
            ]
        );

        // Update the password and set the "password_changed_at" timestamp
        $request->user()->update([
            'password' => Hash::make($request->password),
            'pw_change' => now(),
        ]);

        switch (Auth::user()->role) {
            case 1:
                return redirect()->route('admin.home')->with('success', 'Password changed successfully.');

                break;
            case 2:
                return redirect()->route('teacher.home')->with('success', 'Password changed successfully.');

                break;
            case 3:
                return redirect()->route('student.home')->with('success', 'Password changed successfully.');

                break;
            case 4:
                return redirect()->route('user.home')->with('success', 'Password changed successfully.');

            case 5:
                return redirect()->route('dean.home')->with('success', 'Password changed successfully.');
                break;
            default:
                return redirect('/dashboard')->with('success', 'Password changed successfully.'); //if user doesn't have any role

        }
    }
    public function cancelReq(Request $request)
    {
        $booking = Booking::find($request->id);
        $user=User::find(Auth::user()->id);
        if ($booking) {
            $booking->update(['status' => 'cancel']);
            dispatch(new EmailJob($user, $booking, 'Request cancelled'));
        }
        return response()->json(['status' => 200, 'msg' => 'Cancelled successfully']);

    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\RequestApprovelJob;
use App\Mail\NotifyMail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\RequestApprovel;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users=User::where('role',4)->get();
        return view('admin.requests',compact('users'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $user=User::find($request->id);
        if ($request->status == 3) {
            $update = User::find($request->id)->update(['status' => 'approved','role'=>3]);
            if ($update) {
                dispatch(new RequestApprovelJob($user,'Approved for Student'));;
                return response()->json(['status' => 200, 'msg' => 'Approve done']);
            }
        }
        if ($request->status == 2) {
            $update = User::find($request->id)->update(['status' => 'approved','role'=>2]);
            if ($update) {
                dispatch(new RequestApprovelJob(User::find($request->id),'Approved for teacher'));
                return response()->json(['status' => 200, 'msg' => 'Approve done']);
            }
        }
        if ($request->status==0) {
            $update = User::find($request->id)->update(['role' => 0,'status' => 'reject']);
            if ($update) {
                // dispatch(new RequestApprovelJob(User::find($request->id),'Rejected by admin'));
                User::find($request->id)->delete();
                return response()->json(['status' => 200, 'msg' => 'Reject done']);
            }
        }
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
}
